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
        Schema::create('file_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained()
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('ttr_id');
            $table->string('details', 250)->nullable();
            $table->timestamp('created_at', 4)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_histories');
    }
};
