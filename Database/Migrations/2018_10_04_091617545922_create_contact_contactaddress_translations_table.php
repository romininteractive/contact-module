<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactContactAddressTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact__contactaddress_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('contact_address_id')->unsigned();
            $table->string('locale')->index();
            // $table->unique(['contact_address_id', 'locale']);
            $table->foreign('contact_address_id')->references('id')->on('contact__contactaddresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact__contactaddress_translations', function (Blueprint $table) {
            $table->dropForeign(['contact_address_id']);
        });
        Schema::dropIfExists('contact__contactaddress_translations');
    }
}
