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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->string('thumbnail',255)->nullable();
            $table->tinyInteger('jenis_id');
            $table->string('ip_address',25)->nullable();
            $table->string('id_anydesk',25)->nullable();
            $table->tinyInteger('unit_id');
            $table->enum('kondisi',['bagus','rusak','perbaiki']);
            $table->string('spesifikasi',255)->nullable();
            $table->string('keterangan',100)->nullable();
            $table->tinyInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
