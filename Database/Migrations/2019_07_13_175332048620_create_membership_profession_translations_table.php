<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipProfessionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership__profession_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->integer('profession_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['profession_id', 'locale']);
            $table->foreign('profession_id')->references('id')->on('membership__professions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership__profession_translations', function (Blueprint $table) {
            $table->dropForeign(['profession_id']);
        });
        Schema::dropIfExists('membership__profession_translations');
    }
}
