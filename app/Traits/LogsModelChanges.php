<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ModelChangesLog;

trait LogsModelChanges
{
    /**
     * Setup the model event listeners.
     *
     * This method registers the model event listeners for created, updated and deleted
     * events. When a model is created, updated or deleted, the `logChange` method is
     * called. This method will log the change in the `model_changes_logs` table.
     *
     * @return void
     */
    public static function bootLogsModelChanges()
    {
        static::created(function ($model) {
            $model->logChange('create');
        });

        static::updated(function ($model) {
            $model->logChange('update');
        });

        static::deleted(function ($model) {
            $model->logChange('delete');
        });
    }

    /**
     * Log changes made to the model.
     *
     * This method logs the changes made to the model in the `model_changes_logs` table.
     * It records the type of action (create, update, delete), the previous and changed
     * data, and the user responsible for the change. Additionally, it can log optional
     * fields such as the IP address and user agent of the user making the change if
     * configured to do so.
     * To enable options, update the `model_logger` config file.
     *
     * This code snippet is a method called logChange that logs changes made to a model
     * instance in a table called model_changes_logs. It takes a parameter $action which
     * represents the type of action performed on the model (create, update, delete).
     * The method first determines the previous and changed data based on the action type.
     * If the action is 'update', it gets the original data using getOriginal() and encodes
     * it as JSON. If the action is 'delete', it sets the previous data to null.
     * For other actions, it gets the dirty data using getDirty() and encodes it as JSON.
     * The method then retrieves the user ID using Auth::id(). It creates an array $logData
     * with the model type, model ID, action, previous data, changed data, user ID, and the current timestamp.
     * The method also checks if the model_logger configuration is enabled for logging
     * IP address and user agent. If enabled, it adds the IP address and user agent to the $logData array.
     * Finally, the method creates a new record in the model_changes_logs table using
     * the $logData array and the ModelChangesLog::create() method.
     *
     * @param string $action The type of action performed on the model ('create', 'update', 'delete').
     * @return void
     */
    protected function logChange(string $action)
    {
        $previousData = $action === 'update' ? json_encode($this->getOriginal()) : null;
        $changedData = $action === 'delete' ? null : json_encode($this->getDirty());
        $userId = Auth::id();

        $logData = [
            'model_type' => get_class($this),
            'model_id' => $this->getKey(),
            'action' => $action,
            'previous_data' => $previousData,
            'changed_data' => $changedData,
            'user_id' => $userId,
            'created_at' => now(),
        ];

        // Optional fields: IP Address and User Agent
        if (config('model_logger.log_ip_address')) {
            $logData['ip_address'] = request()->ip();
        }

        if (config('model_logger.log_user_agent')) {
            $logData['user_agent'] = request()->userAgent();
        }

        ModelChangesLog::create($logData);
    }
}
