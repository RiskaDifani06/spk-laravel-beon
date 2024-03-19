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
    Schema::create('alternative_values', function (Blueprint $table) {
      $table->id();
      $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('restrict');
      $table->foreignId('subkriteria_id')->constrained('sub_kriteria')->onDelete('restrict');
      $table->integer('value');
      $table->timestamps();
    });
  }
  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('alternative_values');
  }
};