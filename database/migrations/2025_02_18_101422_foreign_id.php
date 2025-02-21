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
        Schema::table('rapot__santris', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('class_id')->references('id')->on('kelas');
            $table->foreign('departement_id')->references('id')->on('departements');
            $table->foreign('program_stage_id')->references('id')->on('program__stages');
        });
        
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('activity_id')->references('id')->on('activities');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('financial__records', function (Blueprint $table) {
            $table->foreign('accounting_id')->references('id')->on('users');
        });
        Schema::table('assessments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
        Schema::table('news', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('users');
        });

        Schema::table('departements', function (Blueprint $table) {
            $table->foreign('leader_id')->references('id')->on('users');
            $table->foreign('deputy_id')->references('id')->on('users');
        });
        Schema::table('attachment__santris', function (Blueprint $table) {
            $table->foreign('santri_id')->references('id')->on('users');
            $table->foreign('attachment_id')->references('id')->on('attachments');
        });
        Schema::table('santri__families', function (Blueprint $table) {
            $table->foreign('santri_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key dari tabel child terlebih dahulu
        Schema::table('attachment__santris', function (Blueprint $table) {
            $table->dropForeign(['attachment_id']);
        });

        Schema::table('rapot__santris', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropForeign(['departement_id']);
            $table->dropForeign(['program_stage_id']);
        });
        
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['activity_id']);
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('financial__records', function (Blueprint $table) {
            $table->dropForeign(['accounting_id']);
        });

        Schema::table('assessments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['subject_id']);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::table('departements', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropForeign(['deputy_id']);
        });
    }
};
