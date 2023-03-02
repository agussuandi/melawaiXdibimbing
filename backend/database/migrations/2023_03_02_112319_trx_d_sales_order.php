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
        // Schema::create('trx_d_sales_order', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('invoice', 16)->unique();
        //     $table->integer('receipt_id');
        //     $table->integer('receipt_id');
        //     $table->dateTime('craeted_at');
        //     $table->dateTime('updated_at');
        //     $table->index(['id', 'invoice', 'receipt_id', 'date']);
        //     $table->foreign('receipt_id')->references('id')->on('m_customer_receipts');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('trx_h_sales_order');
    }
};
