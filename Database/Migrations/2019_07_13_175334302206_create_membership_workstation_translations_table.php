<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipWorkstationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership__workstation_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->integer('workstation_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['workstation_id', 'locale'],'membership__workstation_trans_locale_unique\'');
            $table->foreign('workstation_id','membership__workstation_trans_workstation')->references('id')->on('membership__workstations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership__workstation_translations', function (Blueprint $table) {
            $table->dropForeign('membership__workstation_trans_workstation');
        });
        Schema::dropIfExists('membership__workstation_translations');
    }
}
