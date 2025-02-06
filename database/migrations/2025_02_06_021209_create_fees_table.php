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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->boolean('has_reg_fee')->default(false);
            $table->decimal('reg_fee', 8, 2)->nullable();
            $table->boolean('has_penalty_fee')->default(false);
            $table->decimal('penalty_fee', 8, 2)->nullable();
            $table->boolean('has_expenses')->default(false);
            $table->decimal('expenses', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
