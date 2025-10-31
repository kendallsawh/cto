<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_conditions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('process_step_id')->constrained()->onDelete('cascade');
    $table->string('type'); // e.g., class name or enum (e.g., 'CheckBudget', 'UserHasRole')
    $table->json('parameters')->nullable(); // dynamic JSON-based params
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
        Schema::dropIfExists('process_conditions');
    }
}
