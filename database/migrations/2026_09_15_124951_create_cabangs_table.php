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
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id(); // Ini otomatis menjadi Primary Key (id_cabang)
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_hp', 20); // Dibatasi 20 karakter agar efisien
            
            // Status menggunakan enum agar isiannya pasti antara aktif/nonaktif
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            
            $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabangs');
    }
};
