<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_actions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('process_step_id')->constrained()->onDelete('cascade');
    $table->string('type'); // e.g., class name or enum (e.g., 'SendNotification', 'UpdateStatus')
    $table->json('parameters')->nullable(); // dynamic JSON-based config
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
        Schema::dropIfExists('process_actions');
    }
}
