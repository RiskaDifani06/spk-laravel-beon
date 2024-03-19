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
    Schema::create('hasil_penilaian', function (Blueprint $table) {
      $table->id();
      $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
      $table->double('hasil_penilaian');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('hasil_penilaian');
  }
};