<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactContactTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contact__contact_translations',
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                // Your translatable fields

                $table->integer('contact_id')->unsigned();
                $table->string('locale')->index();
                $table->unique(['contact_id', 'locale']);
                $table->foreign('contact_id')->references('id')->on('contact__contacts')->onDelete('cascade');
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
        Schema::table(
            'contact__contact_translations',
            function (Blueprint $table) {
                $table->dropForeign(['contact_id']);
            }
        );
        Schema::dropIfExists('contact__contact_translations');
    }
}
