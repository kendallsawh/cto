<?php
// database/migrations/2025_09_15_000000_create_notification_logs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('doc_type_id');
            $table->string('document_ref')->nullable(); // e.g., storage path or URL
            $table->string('channel')->default('mail'); // mail|…
            $table->string('status')->default('queued'); // queued|sent|failed
            $table->text('error')->nullable();
            $table->timestamps();

            $table->unique(['user_id','doc_type_id','document_ref','channel'], 'uniq_user_doc_channel');
            $table->index(['doc_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
