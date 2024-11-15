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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->foreignId('animal_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('animal_breed_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('price_ttc');
            $table->integer('price_ht');
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
