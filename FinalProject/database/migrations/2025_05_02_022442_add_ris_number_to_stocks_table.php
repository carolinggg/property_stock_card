<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('stocks', function (Blueprint $table) {
        $table->string('ris_number')->nullable()->after('reference');
    });
}

public function down()
{
    Schema::table('stocks', function (Blueprint $table) {
        $table->dropColumn('ris_number');
    });
}

};
