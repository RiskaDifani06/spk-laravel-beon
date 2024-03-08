<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    \App\Models\User::factory()->create([
      'name' => 'Admin',
      'last_name' => 'SPK',
      'email' => 'admin@example.com',
      'email_verified_at' => now(),
      'password' => 'password',
      'remember_token' => \Illuminate\Support\Str::random(10),
    ]);

    $this->call([
      AlternatifSeeder::class,
      KriteriaSeeder::class,
    ]);
  }
}
