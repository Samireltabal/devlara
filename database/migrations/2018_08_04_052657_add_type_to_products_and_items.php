<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToProductsAndItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('products', function($table) {
            $table->char('type',100)->after('barcode');
            });
        Schema::table('items', function($table) {
            $table->char('type',100)->after('quantity');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('products', function($table) {
            $table->dropColumn('type');
        });
        Schema::table('items', function($table) {
            $table->dropColumn('type');
        });
    }
}
