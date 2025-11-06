<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('national_id', 191)->nullable()->unique();
            $table->string('passport', 191)->nullable()->unique();
            $table->string('tt_biz_id', 191)->nullable();
            $table->string('address_lot_apt', 191)->nullable();
            $table->string('address_street', 191);
            $table->string('address_town', 191);
            $table->string('contact_business', 191);
            $table->string('contact_mobile', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individuals');
    }
};
