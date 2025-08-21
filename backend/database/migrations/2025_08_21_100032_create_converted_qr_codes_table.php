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

        Schema::create('converted_qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('filename')->nullable(); // nom du fichier si sauvegardé
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('converted_qr_codes');
    }
};
