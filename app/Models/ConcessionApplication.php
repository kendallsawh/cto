<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Example queries:
 *
 * // Apps I own, submitted or under review:
 * // ConcessionApplication::ownedBy($user)
 * //   ->withStatusCode(['submitted','under_review'])
 * //   ->with('status','items')
 * //   ->latest('submitted_at')
 * //   ->get();
 *
 * // Pending queue for reviewers:
 * // ConcessionApplication::withStatusCode(['submitted'])
 * //   ->with(['user','applicant','status'])
 * //   ->paginate(20);
 */
class ConcessionApplication extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'applicant_type',
        'applicant_id',
        'concession_status_id',
        'reference_no',
        'submitted_at',
        'decision_at',
        'notes',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'decision_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function applicant(): MorphTo
    {
        return $this->morphTo();
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ConcessionStatus::class, 'concession_status_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ConcessionApplicationItem::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(ConcessionApproval::class);
    }

    public function getTotalRequestedAmountAttribute(): float
    {
        return $this->items->sum(fn (ConcessionApplicationItem $item) => (float) $item->quantity * (float) $item->unit_value);
    }

    public function scopeOwnedBy(Builder $query, User $user): Builder
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeWithStatusCode(Builder $query, string|array $codes): Builder
    {
        $codes = is_array($codes) ? $codes : [$codes];

        return $query->whereHas('status', fn (Builder $sub) => $sub->whereIn('code', $codes));
    }

    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where(function (Builder $subQuery) use ($term) {
            $subQuery->where('reference_no', 'like', "%{$term}%")
                ->orWhereHasMorph('applicant', [Company::class, Individual::class], function (Builder $applicantQuery) use ($term) {
                    $applicantQuery->where('name', 'like', "%{$term}%");
                });
        });
    }

    protected static function booted(): void
    {
        static::creating(function (ConcessionApplication $application): void {
            if (empty($application->reference_no)) {
                $application->reference_no = self::generateReference();
            }

            if (empty($application->concession_status_id)) {
                $application->concession_status_id = self::getStatusIdByCode('pending');
            }
        });

        static::saving(function (ConcessionApplication $application): void {
            if ($application->isDirty('concession_status_id')) {
                $statusCode = self::getStatusCodeById($application->concession_status_id);

                if ($statusCode === 'submitted' && empty($application->submitted_at)) {
                    $application->submitted_at = now();
                }

                if (in_array($statusCode, ['approved', 'rejected', 'cancelled'], true) && empty($application->decision_at)) {
                    $application->decision_at = now();
                }
            }
        });
    }

    protected static function generateReference(): string
    {
        $year = now()->format('Y');
        $random = str_pad((string) random_int(1, 999999), 6, '0', STR_PAD_LEFT);

        return "CON-{$year}-{$random}";
    }

    protected static function getStatusIdByCode(string $code): ?int
    {
        return ConcessionStatus::where('code', $code)->value('id');
    }

    protected static function getStatusCodeById(?int $id): ?string
    {
        if (! $id) {
            return null;
        }

        return ConcessionStatus::where('id', $id)->value('code');
    }
}
