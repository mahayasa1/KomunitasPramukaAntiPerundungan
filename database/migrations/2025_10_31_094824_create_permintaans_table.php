<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('telp');
            $table->string('judul');
            $table->text('isi');
            $table->string('asal')->nullable();
            $table->string('instansi');
            $table->string('lampiran')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->boolean('is_secret')->default(false);
            $table->enum('status', ['pending', 'verification', 'follow-up', 'feedback',  'finish'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permintaans');
    }
};
