<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactContactAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contact__contactaddresses',
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('contactId')->unsigned();
                $table->string('type');
                $table->string('name');
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->string('state');
                $table->string('zip_code')->nullable();
                $table->string('coutry');
                $table->string('fax')->nullable();
                $table->string('billingphone');
                $table->foreign('contactId')->references('id')->on('contact__contacts')->onDelete('cascade');
                // Your fields
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact__contactaddresses');
    }
}
