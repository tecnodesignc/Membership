<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipCongregationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership__congregation_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('slug');
            $table->text('descrition')->nullable();
            $table->integer('congregation_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['congregation_id', 'locale']);
            $table->foreign('congregation_id')->references('id')->on('membership__congregations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership__congregation_translations', function (Blueprint $table) {
            $table->dropForeign(['congregation_id']);
        });
        Schema::dropIfExists('membership__congregation_translations');
    }
}
