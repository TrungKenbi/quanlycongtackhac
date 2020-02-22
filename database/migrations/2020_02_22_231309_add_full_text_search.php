<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFullTextSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_works', function (Blueprint $table) {
            DB::statement('ALTER TABLE `other_works` ADD FULLTEXT `name` (`name`)');
            //DB::statement('ALTER TABLE `other_works` ENGINE = MyISAM'); // đánh index theo kiểu MyISam ngoài ra còn có kiểu InnoDB nếu không có dòng này cũng được mysql sẽ mặc định là index kiểu MyISAM nhé
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('otherworks', function (Blueprint $table) {
            DB::statement('ALTER TABLE `other_works` DROP INDEX name');
        });
    }
}
