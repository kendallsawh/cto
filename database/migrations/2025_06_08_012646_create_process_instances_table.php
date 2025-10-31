<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_instances', function (Blueprint $table) {
    $table->id();
    $table->foreignId('process_flow_id')->constrained()->onDelete('cascade');
    $table->string('model_type');
    $table->unsignedBigInteger('model_id');
    $table->foreignId('current_step_id')->nullable()->constrained('process_steps')->nullOnDelete();
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
        Schema::dropIfExists('process_instances');
    }
}
