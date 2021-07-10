<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Helper\Table;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_id')->after('id');
            $table->string('user_name')->after('name');
            $table->string('adress_street')->after('email');
            $table->string('adress_suite')->after('email');
            $table->string('adress_city')->after('email');
            $table->string('addres_zipcode')->after('email');
            $table->string('adress_geo_lat')->after('email');
            $table->string('adress_geo_lng')->after('email');
            $table->string('phone')->after('email');
            $table->string('website')->after('email');
            $table->string('company_name')->after('email');
            $table->string('company_catchPhrase')->after('email');
            $table->string('company_bs')->after('email');
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
            $table->dropColumn('user_id');
            $table->dropColumn('user_name');
            $table->dropColumn('adress_street');
            $table->dropColumn('adress_suite');
            $table->dropColumn('adress_city');
            $table->dropColumn('addres_zipcode');
            $table->dropColumn('adress_geo_lat');
            $table->dropColumn('adress_geo_lng');
            $table->dropColumn('phone');
            $table->dropColumn('website');
            $table->dropColumn('company_name');
            $table->dropColumn('company_catchPhrase');
            $table->dropColumn('company_bs');
        });
    }
}
