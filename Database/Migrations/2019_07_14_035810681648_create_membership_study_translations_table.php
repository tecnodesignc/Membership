<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipStudyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership__study_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('study_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['study_id', 'locale']);
            $table->foreign('study_id')->references('id')->on('membership__studies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership__study_translations', function (Blueprint $table) {
            $table->dropForeign(['study_id']);
        });
        Schema::dropIfExists('membership__study_translations');
    }
}
