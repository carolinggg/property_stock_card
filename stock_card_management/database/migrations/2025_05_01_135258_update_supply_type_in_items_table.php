<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            if (Schema::hasColumn('items', 'supply_type')) {
                $table->dropColumn('supply_type');
            }
        });

        Schema::table('items', function (Blueprint $table) {
            $table->enum('supply_type', ['Office Supply', 'Medical Supply', 'Janitorial Supply'])->after('item_description');
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('supply_type');
        });
    }
};
