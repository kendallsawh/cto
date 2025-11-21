<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('concession_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concession_application_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reviewer_id')->constrained('users')->restrictOnDelete();
            $table->string('action');
            $table->text('comment')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('concession_application_id');
            $table->index('reviewer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concession_approvals');
    }
};
