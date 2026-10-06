<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class WidenDescriptionColumnsToText extends Migration
{
    /**
     * Run the migrations.
     *
     * Same problem as infos.description: varchar(1000) rejects longer
     * text with "Data too long" (a 500 in the admin). Raw SQL because
     * doctrine/dbal is not installed. Nullability is kept as it was.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `activites` MODIFY `description` TEXT NOT NULL');
        DB::statement('ALTER TABLE `page_autismes` MODIFY `description` TEXT NULL');
        DB::statement('ALTER TABLE `projets` MODIFY `description` TEXT NULL');
        DB::statement('ALTER TABLE `aboutuses` MODIFY `description` TEXT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `activites` MODIFY `description` VARCHAR(1000) NOT NULL');
        DB::statement('ALTER TABLE `page_autismes` MODIFY `description` VARCHAR(1000) NULL');
        DB::statement('ALTER TABLE `projets` MODIFY `description` VARCHAR(1000) NULL');
        DB::statement('ALTER TABLE `aboutuses` MODIFY `description` VARCHAR(1000) NULL');
    }
}
