<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_settings_table.php

public function up()
{
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('theme_preference')->default('light');  // Tema: light/dark
        $table->string('language_preference')->default('en');   // Bahasa: en/id
        $table->boolean('email_notifications')->default(true);  // Pengaturan notifikasi
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
