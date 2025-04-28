<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade'); // Linking to the 'items' table
            $table->integer('quantity')->default(0); // Stock quantity
            $table->decimal('unit_cost', 10, 2)->default(0.00); // Cost per unit
            $table->decimal('total_cost', 10, 2)->virtualAs('quantity * unit_cost'); // Virtual column to compute total cost (quantity * unit_cost)
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
