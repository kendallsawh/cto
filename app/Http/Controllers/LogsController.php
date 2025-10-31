<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelChangesLog;
use App\Models\User;

class LogsController extends Controller
{

    /**
     * Display all logs.
     *
     * This method retrieves all logs of model instance changes.
     * The logs are sorted by the created_at timestamp in descending order
     * and paginated. The result is passed to the 'logs.all_logs' view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allLogs = ModelChangesLog::orderBy('created_at', 'desc')->paginate(15);
        return view('logs.all_logs', compact('allLogs'));
    }


    /**
     * Display all deleted logs.
     *
     * This method retrieves all logs of deleted model instances.
     * The logs are sorted by the created_at timestamp in descending order
     * and paginated. The result is passed to the 'logs.deleted_logs' view.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {
        $deletedLogs = ModelChangesLog::where('action', 'delete')->orderBy('created_at', 'desc')->paginate(15);
        return view('logs.deleted_logs', compact('deletedLogs'));
    }


    /**
     * Display all update logs.
     *
     * This method will display all logs of updated model instances.
     * The logs are sorted by the created_at timestamp in descending order.
     *
     * @return \Illuminate\Http\Response
     */
    public function updated()
    {
        $updateLogs = ModelChangesLog::where('action', 'update')->orderBy('created_at', 'desc')->paginate(15);
        return view('logs.restore_update_logs', compact('updateLogs'));
    }


    /**
     * Restore a deleted model instance.
     *
     * @param int $logId The ID of the log entry to restore
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreDeleted($logId)
    {
        $logEntry = ModelChangesLog::findOrFail($logId);

        if ($logEntry->action !== 'delete') {
            return redirect()->back()->with('error', 'Invalid log entry for restoration');
        }

        // Get model details
        $modelClass = $logEntry->model_type;
        $modelData = json_decode($logEntry->previous_data, true);

        // Restore the deleted model instance
        $model = new $modelClass();
        $model->fill($modelData);
        $model->save();

        return redirect()->route('logs.deleted')->with('success', 'Deleted record restored successfully');
    }


    /**
     * Restore a model instance to its previous state.
     *
     * @param int $logId The ID of the log entry to restore
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreUpdate($logId)
    {
        $logEntry = ModelChangesLog::findOrFail($logId);

        if ($logEntry->action !== 'update') {
            return redirect()->back()->with('error', 'Invalid log entry for restoration');
        }

        // Get model details
        $modelClass = $logEntry->model_type;
        $model = $modelClass::findOrFail($logEntry->model_id);
        $previousData = json_decode($logEntry->previous_data, true);

        // Restore the previous state of the model
        $model->update($previousData);

        return redirect()->route('logs.updated')->with('success', 'Record restored to previous state successfully');
    }

    public function logsByUser($userId)
    {
        $user = User::findOrFail($userId);
        $logs = ModelChangesLog::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(15);

        return view('logs.user_logs', compact('user', 'logs'));
    }

    // Search logs by user name
    public function searchLogs(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $user = User::where('name', 'LIKE', "%{$request->username}%")->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $logs = ModelChangesLog::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);

        return view('logs.user_logs', compact('user', 'logs'));
    }
}
