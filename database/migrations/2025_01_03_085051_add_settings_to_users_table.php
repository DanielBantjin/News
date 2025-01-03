<?php

// Migrasi: 2025_01_03_085051_add_settings_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsToUsersTable extends Migration
{
    /**
     * Menjalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom tema jika belum ada
            if (!Schema::hasColumn('users', 'theme')) {
                $table->enum('theme', ['light', 'dark'])->default('light');
            }

            // Menambahkan kolom bahasa jika belum ada
            if (!Schema::hasColumn('users', 'language_preference')) {
                $table->string('language_preference', 255)->default('id');
            }

            // Menambahkan kolom kata sandi jika belum ada
            if (!Schema::hasColumn('users', 'password')) {
                $table->string('password')->nullable();
            }
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['theme', 'language_preference', 'password']);
        });
    }
}
