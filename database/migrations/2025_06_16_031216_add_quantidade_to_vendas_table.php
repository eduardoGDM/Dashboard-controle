<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantidadeToVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->integer('quantidade')->default(1);
        });
    }

    public function down()
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->dropColumn('quantidade');
        });
    }

}
