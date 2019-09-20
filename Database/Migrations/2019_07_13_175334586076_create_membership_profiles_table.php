<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership__profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('doc_type')->default(0);
            $table->string('identification')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->text('birthplace')->nullable();
            $table->integer('study_id')->default(0);
            $table->integer('profession_id')->default(0);
            $table->integer('civil_status')->default(0);
            $table->integer('spouse_id')->nullable();
            $table->timestamp('baptism_date')->nullable();
            $table->integer('minister_id')->nullable();
            $table->timestamp('holy_spirit_date')->nullable();
            $table->unique('identification');
            $table->foreign('profession_id')->references('id')->on('membership__professions')->onDelete('restrict');
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
        Schema::dropIfExists('membership__profiles');
    }
}
