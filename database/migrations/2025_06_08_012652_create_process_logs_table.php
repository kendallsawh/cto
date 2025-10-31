<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('process_instance_id')->constrained()->onDelete('cascade');
    $table->foreignId('step_id')->constrained('process_steps')->onDelete('cascade');
    $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->text('note')->nullable();
    $table->json('metadata')->nullable();
    $table->timestamp('completed_at')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_logs');
    }
}
