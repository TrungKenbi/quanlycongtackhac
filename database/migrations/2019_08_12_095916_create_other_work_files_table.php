<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherWorkFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_work_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('other_work_id')->unsigned();
            $table->foreign('other_work_id')->references('id')->on('other_works')->onDelete('cascade');
            $table->string('filename');
            $table->string('display_name')->default('');
            $table->string('type', 10)->default('photo');
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
        Schema::dropIfExists('other_work_files');
    }
}
