<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplyFromToStocksTable extends Migration
{
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            // Add the new columns to the 'stocks' table
            $table->string('reference')->nullable();
            $table->integer('receipt_qty')->nullable();
            $table->integer('no_of_days_consume')->nullable();
            $table->string('unit')->nullable();
            $table->enum('supply_from', ['purchased', 'received'])->default('purchased');
        });
    }

    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            // Remove the added columns
            $table->dropColumn([
                'reference',
                'receipt_qty',
                'no_of_days_consume',
                'unit',
                'supply_from',
            ]);
        });
    }
}
