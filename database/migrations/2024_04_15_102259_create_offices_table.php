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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('headquarters_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('administrative_units_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->smallInteger('code')->unique();
            $table->string('name', 100)->unique();
            $table->string('floor', 2)->nullable();
            $table->char('level', 1)->default('D'); // D: Dirección, S: SubDirección, O: Oficina, G: Grupo
            $table->boolean('status')->default(true);
            $table->string('username', 15);
            $table->string('details', 256)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
