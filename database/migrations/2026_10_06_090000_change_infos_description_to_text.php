<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeInfosDescriptionToText extends Migration
{
    /**
     * Run the migrations.
     *
     * News articles longer than 1000 characters were rejected by MySQL
     * ("Data too long for column 'description'"), surfacing as a 500 when
     * the admin saved a news item. Raw SQL: doctrine/dbal is not installed,
     * which Blueprint::change() would require.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `infos` MODIFY `description` TEXT NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `infos` MODIFY `description` VARCHAR(1000) NOT NULL');
    }
}
