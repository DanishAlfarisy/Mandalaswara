<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('opini', function (Blueprint $table) {
            $table->id('id_opini');
            $table->string('judul_opini');
            $table->string('slug');
            $table->text('isi');
            $table->timestamp('tanggal_publish')->nullable();
            $table->foreignId('id_user')
                ->constrained('users', 'id_user') // <-- gunakan kolom id_user
                ->onDelete('cascade');
            $table->integer('total_view')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opini');
    }
};