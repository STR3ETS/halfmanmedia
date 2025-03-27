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
        Schema::table('offertes', function (Blueprint $table) {
            $table->string('bedrijfsnaam')->nullable();
            $table->text('bedrijfsomschrijving')->nullable();
            $table->string('kvk')->nullable();
            $table->string('vestigingsadres')->nullable();
            $table->text('doel')->nullable();
            $table->string('doelgroep')->nullable();
            $table->text('extra_wensen')->nullable();
            $table->integer('budget')->nullable();
            $table->text('verwachting')->nullable();
            $table->boolean('flexibel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offertes', function (Blueprint $table) {
            //
        });
    }
};
