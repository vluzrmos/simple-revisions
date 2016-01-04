<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRevisionsTable extends Migration
{
    protected $table;

    public function __construct()
    {
        $this->connection = config('revisions.connection');

        $this->table = config('revisions.table', 'revisions');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
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
        Schema::drop($this->table);
    }
}
