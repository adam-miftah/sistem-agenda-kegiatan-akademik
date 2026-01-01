<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pemilik agenda
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date'); // Tanggal kegiatan
            $table->time('time')->nullable(); // Jam kegiatan
            $table->string('location')->nullable();
            $table->string('category'); // Rapat, Kuliah, Seminar, dll
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
}

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};