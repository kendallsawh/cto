<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('concession_application_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concession_application_id')->constrained()->cascadeOnDelete();
            $table->foreignId('item_id')->nullable()->constrained('items');
            $table->string('item_name');
            $table->string('category')->nullable();
            $table->text('specification')->nullable();
            $table->foreignId('unit_id')->constrained('measurement_units')->restrictOnDelete();
            $table->string('unit_name_snapshot')->nullable();
            $table->string('unit_symbol_snapshot')->nullable();
            $table->decimal('quantity', 12, 2);
            $table->decimal('unit_value', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('item_id');
            $table->index('unit_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concession_application_items');
    }
};
