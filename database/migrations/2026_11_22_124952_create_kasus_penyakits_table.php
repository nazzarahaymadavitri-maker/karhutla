<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kasus_penyakits', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyakit');
            $table->string('ikon');
            $table->string('warna_hex');
            $table->string('badge_bg');
            $table->string('badge_text');
            $table->integer('jun');
            $table->integer('jul');
            $table->integer('agu');
            $table->integer('sep');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus_penyakits');
    }
};