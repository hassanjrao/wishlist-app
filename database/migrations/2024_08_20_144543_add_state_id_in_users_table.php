<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateIdInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('state');

            $table->foreignId('state_id')->nullable()->after('email_verified_at')->constrained('states')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

                $table->dropForeign(['state_id']);
                $table->dropColumn('state_id');

                $table->string('state')->nullable()->after('email_verified_at');
        });
    }
}
