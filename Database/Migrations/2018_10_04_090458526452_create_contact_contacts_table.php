<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contact__contacts',
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('salutation');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('company_name');
                $table->string('email');
                $table->string('phone');
                $table->string('designation');
                $table->string('department');
                $table->string('type');
                $table->string('gstin');
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
        Schema::dropIfExists('contact__contacts');
    }
}
