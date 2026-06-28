    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB; // Import DB facade

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::table('projets', function (Blueprint $table) {
                // Add the new JSON column, allowing it to be nullable initially
                $table->json('structured_description')->nullable()->after('description');
            });

            // Backfill existing records: wrap legacy description into the new structured format
            $projets = DB::table('projets')->get();
            foreach ($projets as $projet) {
                $newStructure = [
                    'sections' => []
                ];

                // Convert old simple description to new structure
                if (!empty($projet->description)) {
                    $newStructure['sections'][] = [
                        'id' => uniqid('paragraph_', true), // Unique ID for the block
                        'type' => 'paragraph',
                        'content' => $projet->description
                    ];
                }

                DB::table('projets')
                    ->where('id', $projet->id)
                    ->update(['structured_description' => json_encode($newStructure, JSON_UNESCAPED_UNICODE)]);
            }
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('projets', function (Blueprint $table) {
                $table->dropColumn('structured_description');
            });
        }
    };
