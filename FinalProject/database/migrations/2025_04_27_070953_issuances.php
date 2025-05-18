<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('issuances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade'); // Foreign key to the items table
            $table->string('office'); // Office where the item was issued
            $table->integer('qty_issued')->unsigned(); // Quantity of items issued
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('issuances');
    }
};
