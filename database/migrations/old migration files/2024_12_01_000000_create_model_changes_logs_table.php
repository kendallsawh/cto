<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelChangesLogsTable extends Migration
{
    public function up()
    {
        Schema::create('model_changes_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model_type'); // E.g., App\Models\Customer
            $table->unsignedBigInteger('model_id'); // ID of the model instance
            $table->enum('action', ['create', 'update', 'delete']);
            $table->json('previous_data')->nullable(); // Previous state of the model
            $table->json('changed_data')->nullable(); // Changed data
            $table->unsignedBigInteger('user_id')->nullable(); // User who made the change
            $table->boolean('restorable')->default(true); // Whether the change can be restored
            $table->string('ip_address')->nullable(); // IP address of the user making the change
            $table->string('user_agent')->nullable(); // User agent string of the user making the change
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_changes_logs');
    }
}
