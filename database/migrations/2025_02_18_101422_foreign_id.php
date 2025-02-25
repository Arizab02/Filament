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
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('class_id')->references('id')->on('kelas')->onDelete('set null');
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('set null');
            $table->foreign('program_stage_id')->references('id')->on('program__stages')->onDelete('set null');
        });
        
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('set null');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        Schema::table('financial__records', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        Schema::table('assessments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
        });
        Schema::table('news', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('departements', function (Blueprint $table) {
            $table->foreign('leader_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deputy_id')->references('id')->on('users')->onDelete('set null');
        });
        Schema::table('attachment__santris', function (Blueprint $table) {
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('attachment_id')->references('id')->on('attachments')->onDelete('set null');
        });
        Schema::table('santri__families', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
            $table->dropForeign(['user_id']);
        });

        Schema::table('assessments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['subject_id']);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('departements', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropForeign(['deputy_id']);
        });
    }
};
