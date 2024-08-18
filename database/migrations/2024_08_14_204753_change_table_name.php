<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // change user_childrens to wish_lists
        Schema::rename('user_childrens', 'wish_lists');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // change wish_lists to user_childrens
        Schema::rename('wish_lists', 'user_childrens');
    }
}
