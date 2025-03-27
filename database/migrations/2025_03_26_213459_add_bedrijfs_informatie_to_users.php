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
        Schema::table('users', function (Blueprint $table) {
            $table->string('bedrijfsnaam')->nullable()->after('email');
            $table->string('branche')->nullable()->after('bedrijfsnaam');
            $table->text('omschrijving')->nullable()->after('branche');
            $table->string('kvk')->nullable()->after('omschrijving');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
