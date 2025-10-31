<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Ensure you import the User model
/**
 * This class provides a way to log changes made to other models in the application,
 * including the model type, model ID, action, previous data, changed data, user ID,
 * and whether the model is restorable. The created_at field is automatically set
 * when a new log entry is created. The ip_address and user_agent fields are optional
 * and can be enabled if IP logging and User Agent logging are enabled in the application.
 */
class ModelChangesLog extends Model
{
    protected $table = 'model_changes_logs';

    protected $fillable = [
        'model_type',
        'model_id',
        'action',
        'previous_data',
        'changed_data',
        'user_id',
        'restorable',
        'created_at',
        'ip_address', // Optional if IP logging is enabled
        'user_agent', // Optional if User Agent logging is enabled
    ];

    public $timestamps = false;

    // Define the user relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
