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
        Schema::table('categories', function (Blueprint $table) {
            // 'status' column no data type badli ne string karvano ane default value set karvani.
            $table->string('status')->default('Inactive')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Jo migration ne revert karvi hoy to column no type paacho badli nakhvano.
            // Note: Aa data loss kari shake chhe.
            $table->boolean('status')->default(0)->change();
        });
    }
};
