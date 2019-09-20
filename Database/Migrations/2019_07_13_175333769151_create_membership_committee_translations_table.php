<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipCommitteeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership__committee_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->integer('committee_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['committee_id', 'locale']);
            $table->foreign('committee_id')->references('id')->on('membership__committees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership__committee_translations', function (Blueprint $table) {
            $table->dropForeign(['committee_id']);
        });
        Schema::dropIfExists('membership__committee_translations');
    }
}
