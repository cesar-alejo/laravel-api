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
        Schema::create('office_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('office_id');
            $table->boolean('is_default')->default(false);
            $table->string('sign_mech')->nullable();
            $table->string('sign_elec')->nullable();
            $table->char('libre', 1)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('offices')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'office_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_user');
    }
};
