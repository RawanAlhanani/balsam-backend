<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeStaticPageImagesNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE aboutuses MODIFY about_image VARCHAR(255) NULL');
        DB::statement('ALTER TABLE page_autismes MODIFY page_image VARCHAR(255) NULL');
        DB::statement('ALTER TABLE projets MODIFY projet_image VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE aboutuses MODIFY about_image VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE page_autismes MODIFY page_image VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE projets MODIFY projet_image VARCHAR(255) NOT NULL');
    }
}
