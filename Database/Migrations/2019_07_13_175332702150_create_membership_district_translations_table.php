<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipDistrictTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership__district_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();

            $table->integer('district_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['district_id', 'locale']);
            $table->foreign('district_id')->references('id')->on('membership__districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership__district_translations', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
        });
        Schema::dropIfExists('membership__district_translations');
    }
}
