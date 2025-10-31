<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialYear;
use App\Models\PsipDetail;
use App\Models\Division;
use App\Models\Status;
use App\Models\PsipScreeningBrief;
use App\Models\PsipPsNote;
use App\Models\DocTypeDivision;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LogsModelChanges;

class PsipName extends Model
{
    use HasFactory, SoftDeletes, LogsModelChanges;
    protected $fillable = ['psip_name','code','description','division_id','groups_id','updated_by','created_by','status_id','cancelled_by'];
    /**
     * The division that this PSIP belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    /**
     * The group that this PSIP belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'groups_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    /**
     * Get all the activities for this PSIP
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'psip_name_id', 'id')->orderBy('activity_order','ASC');
    }

    public function activitiesForCurrentYear()
    {
        $financial_year_record = FinancialYear::first();
        $year = $financial_year_record ? $financial_year_record->year : now()->year;

        return $this->hasMany(Activity::class, 'psip_name_id', 'id')
                    ->where('financial_year', $year);
    }


    /*public function screeningBrief()
    {
        return $this->hasMany('App\Models\PsipScreeningBrief', 'psip_names_id', 'id');
    }*/

    /**
     * The status that this PSIP belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    /**
     * Get all the psip draft estimates for this PSIP
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function psipDraftEstimates()
    {
        return $this->hasMany('App\Models\PsipDraftEstimate', 'psip_names_id', 'id');
    }

    /**
     * Get the PSIP Detail for the current financial year.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function psipDetailForCurrentYear()
    {
        $financial_year_record = FinancialYear::first();
        $year = $financial_year_record ? $financial_year_record->year : now()->year;

        // Do not use ->first() here
        return $this->hasOne(PsipDetail::class)->where('financial_year', $year);
    }


    /**
     * Get all the psip details for this PSIP except the current financial year
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function psipDetailsExceptCurrentYear()
    {
        $year = FinancialYear::first()->year; // Retrieve the year from the FinancialYear model
        return $this->hasMany(PsipDetail::class)->where('financial_year', '<>', $year);
    }

    /**
     * This function retrieves the most recent PSIP detail record for a PSIP,
     * excluding the current financial year, and returns it as a collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function psipDetailsLast()
    {
        $year = FinancialYear::first()->year; // Retrieve the year from the FinancialYear model
        return $this->hasMany(PsipDetail::class)->where('financial_year', '<>', $year)->orderBy('financial_year','desc')->get();
    }

    public function psipDetails()
    {

        return $this->hasMany(PsipDetail::class);
    }

    public function docTypeDivisions()
    {
        return $this->hasMany(DocTypeDivision::class, 'psip_id');
    }
    /*screening brief functions*/

    /**
     * Get the most recently created PsipScreeningBrief for this PSIP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mostRecentScreeningBrief()
    {
        return $this->hasOne(PsipScreeningBrief::class, 'psip_names_id', 'id')->latest();
    }

    /**
     * Get all the screening briefs for this PSIP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function screeningBriefs()
    {
        return $this->hasMany(PsipScreeningBrief::class, 'psip_names_id', 'id');
    }

    /**
     * Get all the screening briefs for this PSIP, including soft deleted records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function screeningBriefsWithTrashed()
    {
        return $this->hasMany(PsipScreeningBrief::class, 'psip_names_id', 'id')->withTrashed();
    }
    /*ps note functions*/

    /**
     * Get the most recently created PsipPsNote for this PSIP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mostRecentPsNote()
    {
    // Assuming 'created_at' or 'id' for ordering, adjust as necessary
        return $this->hasOne(PsipPsNote::class, 'psip_names_id', 'id')->latest();
    }
    /**
     * Get all the ps notes for this PSIP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function psNotes()
    {
        return $this->hasMany(PsipPsNote::class, 'psip_names_id', 'id');
    }
    /**
     * Get all the ps notes for this PSIP, including soft deleted records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function psNotesWithTrashed()
    {
        return $this->hasMany(PsipPsNote::class, 'psip_names_id', 'id')->withTrashed();
    }

    /*achievement report functions*/
    public function mostRecentAchievementReport()
    {
    // Assuming 'created_at' or 'id' for ordering, adjust as necessary
        return $this->hasOne(PsipAchievementReport::class, 'psip_names_id', 'id')->latest();
    }
    public function achievementReports()
    {
        return $this->hasMany(PsipAchievementReport::class, 'psip_names_id', 'id');
    }
    public function achievementReportWithTrashed()
    {
        return $this->hasMany(PsipAchievementReport::class, 'psip_names_id', 'id')->withTrashed();
    }

    //-------new code for mof listing----------------
    // Retrieves the PSIP detail record for the specified financial year
    public function psipDetailForYear($year)
    {
        return $this->psipDetails()->where('financial_year', $year)->first();
    }

    // Accessor for the previous financial year
    public function getPsipDetailForPreviousYearAttribute()
    {
        $currentYear = \App\Models\FinancialYear::first()->year;
        $previousYear = $currentYear - 1;
        return $this->psipDetailForYear($previousYear);
    }

    // Accessor for two years prior
    public function getPsipDetailForTwoYearsPriorAttribute()
    {
        $currentYear = \App\Models\FinancialYear::first()->year;
        $twoYearsPrior = $currentYear - 2;
        return $this->psipDetailForYear($twoYearsPrior);
    }



}
