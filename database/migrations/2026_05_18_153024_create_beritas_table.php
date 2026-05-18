<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi');
            $table->timestamp('tanggal_publish')->nullable();
            $table->string('gambar_thumbnail', 255)->nullable();
            $table->foreignId('id_user')
                ->constrained('users', 'id_user') // <-- gunakan kolom id_user
                ->onDelete('cascade');

            $table->foreignId('id_kategori')
                ->constrained('kategori', 'id_kategori') // pastikan sesuai primary key kategori
                ->onDelete('cascade');
            $table->integer('jumlah_view')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
