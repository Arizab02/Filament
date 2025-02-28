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
            $table->string('id')->primary();
            $table->string('name');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->date('date_of_birth');
            $table->string('phone', 20);
            $table->text('address');
            $table->integer('generation');
            $table->string('entry_date');
            $table->string('graduate_date')->nullable();
            $table->string('status_graduate')->nullable();
            $table->unsignedBigInteger('class_id')->constrained('classes')->nullable();
            $table->enum('role', ['Santri', 'Ustadz', 'Staff', 'Pengurus'])->nullable();
            $table->unsignedBigInteger('departement_id')->nullable();
            $table->unsignedBigInteger('program_stage_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
            //$table->foreignId('user_id')->nullable()->index();
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
