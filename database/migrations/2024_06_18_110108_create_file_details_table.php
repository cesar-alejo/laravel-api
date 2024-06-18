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
        Schema::create('file_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained()
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->index()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('name', 150)->nullable();
            $table->string('mime_type', 150)->nullable();
            $table->string('extension', 5)->nullable();
            $table->integer('size')->nullable();
            $table->string('path', 100);
            $table->string('disk', 100)->nullable();
            $table->string('libre', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_details');
    }
};
