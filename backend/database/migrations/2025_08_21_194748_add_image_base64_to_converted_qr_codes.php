<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        Schema::table('converted_qr_codes', function (Blueprint $table) {
            $table->longText('image_base64')->after('text'); // ou after('filename') si tu as filename
        });
    }

    public function down(): void
    {
        Schema::table('converted_qr_codes', function (Blueprint $table) {
            $table->dropColumn('image_base64');
        });
    }
};
