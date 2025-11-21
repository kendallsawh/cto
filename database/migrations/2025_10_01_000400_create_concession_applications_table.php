<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('concession_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('applicant_type');
            $table->unsignedBigInteger('applicant_id');
            $table->foreignId('concession_status_id')->constrained('concession_statuses')->restrictOnDelete();
            $table->string('reference_no')->unique();
            $table->dateTime('submitted_at')->nullable()->index();
            $table->dateTime('decision_at')->nullable()->index();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['applicant_type', 'applicant_id']);
            $table->index('concession_status_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concession_applications');
    }
};
