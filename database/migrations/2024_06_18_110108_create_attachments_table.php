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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('attachable_type'); //Nombre clase del modelo al que pertenece el anexo
            $table->unsignedBigInteger('attachable_id'); //ID del modelo específico
            $table->foreignId('user_id')->index()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('file_type', 5)->nullable(); //tipo de archivo (ej. 'pdf', 'jpg', 'doc').
            $table->unsignedBigInteger('file_size')->nullable();
            $table->string('mime_type', 150)->nullable();
            $table->string('file_path', 100);
            $table->string('file_name', 150);
            $table->string('disk', 10)->nullable();
            $table->string('libre', 1)->nullable();
            $table->timestamps();

            $table->index(['attachable_type', 'attachable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
