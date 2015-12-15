<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->increments('id');

            $table->longText('data')->nullable();

            $table->string('event')->nullable();

            $table->unsignedInteger('user_id')->nullable();

            $table->unsignedInteger('revisionable_id');
            $table->string('revisionable_type', 2048);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('revisions');
    }
}
