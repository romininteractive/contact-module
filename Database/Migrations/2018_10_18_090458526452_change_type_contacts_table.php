<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeTypeContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact__contacts', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('designation')->nullable()->change();
            $table->string('department')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('gstin')->nullable()->change();
        });
        Schema::table('contact__contactaddresses', function (Blueprint $table) {
            $table->string('city')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->string('zip_code')->nullable()->change();
            $table->dropColumn('coutry');
            $table->string('country')->nullable()->after('zip_code');
            $table->string('fax')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumn('user_type');
    }
}
