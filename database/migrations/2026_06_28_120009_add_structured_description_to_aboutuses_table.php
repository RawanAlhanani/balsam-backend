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
            Schema::table('aboutuses', function (Blueprint $table) {
                // Add the new JSON column, allowing it to be nullable initially
                $table->json('structured_description')->nullable()->after('description');
            });

            // Backfill existing records: wrap legacy description into the new structured format
            // This assumes 'titre' is the main subject and 'description' is a single paragraph
            $abouts = DB::table('aboutuses')->get();
            foreach ($abouts as $about) {
                $structured = [
                    'sections' => [
                        [
                            'id' => 'legacy-paragraph-' . $about->id, // Unique ID for the block
                            'type' => 'paragraph',
                            'content' => isset($about->description) ? $about->description : ''
                        ]
                    ]
                ];

                DB::table('aboutuses')
                    ->where('id', $about->id)
                    ->update(['structured_description' => json_encode($structured, JSON_UNESCAPED_UNICODE)]);
            }
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('aboutuses', function (Blueprint $table) {
                $table->dropColumn('structured_description');
            });
        }
    };
