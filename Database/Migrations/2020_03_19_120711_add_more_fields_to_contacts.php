<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsToContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact__contacts', function (Blueprint $table) {
            $table->string('landline1')->nullable();
            $table->string('landline2')->nullable();
            $table->string('mobile1')->nullable();
            $table->string('mobile2')->nullable();

            $table->text('remarks')->nullable();
            $table->text('bank_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact__contacts', function (Blueprint $table) {
            $table->dropColumn('landline1', 'landline2', 'mobile1', 'mobile2', 'remarks', 'bank_details');
        });
    }
}
