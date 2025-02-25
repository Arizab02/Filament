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
        Schema::create('financial__records', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->enum('category', ['Pemasukan', 'Pengeluaran']);
            $table->text('description');
            $table->enum('transaction_type', ['Deposit', 'Withdrawal']);
            $table->decimal('amount', 10, 2);
            $table->dateTime('transaction_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial__records');
    }
};
