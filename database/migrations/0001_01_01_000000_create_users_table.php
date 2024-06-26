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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('type_ident', 3)->default('CC');
            $table->string('ident', 15)->unique();
            $table->string('name', 100);
            $table->string('username', 15)->unique();
            $table->string('email', 50)->unique();
            $table->string('email_1', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('phone_1', 50)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->date('date_birth')->nullable();
            $table->char('libre', 1)->nullable();
            $table->char('libre_1', 1)->nullable();
            $table->char('rol', 1)->default('U'); //R,A,U
            $table->smallInteger('status')->default(1);
            $table->char('auth')->default('LDAP'); //PWS,LDAP,365[TOKEN],OTP
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
