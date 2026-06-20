<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDescriptionJsonToPageAutismesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_autismes', function (Blueprint $table) {
            // Add a new JSON column to store structured description
            $table->json('description_json')->nullable()->after('description');
        });

        // Backfill existing records: use `titre` as the main subject and wrap legacy description
        $pages = DB::table('page_autismes')->get();
        foreach ($pages as $p) {
            $structured = [
                'main' => isset($p->titre) ? $p->titre : null,
                'sections' => [
                    [
                        'subtitle' => '',
                        'text' => isset($p->description) ? $p->description : ''
                    ]
                ]
            ];

            DB::table('page_autismes')
                ->where('id', $p->id)
                ->update(['description_json' => json_encode($structured, JSON_UNESCAPED_UNICODE)]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_autismes', function (Blueprint $table) {
            $table->dropColumn('description_json');
        });
    }
}
