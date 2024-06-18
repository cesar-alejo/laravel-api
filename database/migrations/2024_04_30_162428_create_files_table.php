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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->index()->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('libre', 1)->nullable();
            $table->string('name', 150);
            //$table->string('file_name', 150)->nullable();
            //$table->string('mime_type', 150)->nullable();
            //$table->string('extension', 5)->nullable();
            //$table->integer('size')->nullable();
            //$table->string('path', 100);
            //$table->string('disk', 100)->nullable();
            //$table->string('libre_1', 1)->nullable();
            $table->smallInteger('estado')->default(1);
            $table->timestamp('expiration');
            $table->text('details')->nullable();
            $table->timestamps();
        });

        Schema::create('file_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->index();
            $table->string('details', 250)->nullable();
            $table->string('username', 15)->nullable();
            $table->timestamp('created_at', 4)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
        Schema::dropIfExists('file_history');
    }
};
