<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EnhanceAutismeDescriptionJsonStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, let's migrate existing data to the new structure
        $pages = DB::table('page_autismes')->get();
        
        foreach ($pages as $page) {
            $newStructure = [
                'sections' => []
            ];
            
            // If we have existing JSON data, convert it
            if ($page->description_json) {
                $existingJson = json_decode($page->description_json, true);
                
                if (isset($existingJson['sections'])) {
                    foreach ($existingJson['sections'] as $section) {
                        $newSection = [
                            'id' => uniqid('section_', true),
                            'type' => 'paragraph',
                            'content' => $section['text'] ?? ''
                        ];
                        
                        if (!empty($section['subtitle'])) {
                            // Add heading before paragraph
                            $headingSection = [
                                'id' => uniqid('heading_', true),
                                'type' => 'heading',
                                'level' => 3,
                                'content' => $section['subtitle']
                            ];
                            $newStructure['sections'][] = $headingSection;
                        }
                        
                        $newStructure['sections'][] = $newSection;
                    }
                }
            } else {
                // Convert old simple description to new structure
                if (!empty($page->description)) {
                    $newStructure['sections'][] = [
                        'id' => uniqid('paragraph_', true),
                        'type' => 'paragraph',
                        'content' => $page->description
                    ];
                }
            }
            
            // Update the record with new structure
            DB::table('page_autismes')
                ->where('id', $page->id)
                ->update([
                    'description_json' => json_encode($newStructure, JSON_UNESCAPED_UNICODE)
                ]);
        }
        
        // Optional: You can drop the old description column if you want to clean up
        // Schema::table('page_autismes', function (Blueprint $table) {
        //     $table->dropColumn('description');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert to old structure
        $pages = DB::table('page_autismes')->get();
        
        foreach ($pages as $page) {
            $oldStructure = [
                'main' => $page->titre,
                'sections' => []
            ];
            
            if ($page->description_json) {
                $existingJson = json_decode($page->description_json, true);
                
                if (isset($existingJson['sections'])) {
                    foreach ($existingJson['sections'] as $section) {
                        $oldSection = [
                            'subtitle' => '',
                            'text' => ''
                        ];
                        
                        if ($section['type'] === 'heading') {
                            $oldSection['subtitle'] = $section['content'];
                        } else {
                            $oldSection['text'] = $section['content'];
                        }
                        
                        $oldStructure['sections'][] = $oldSection;
                    }
                }
            }
            
            DB::table('page_autismes')
                ->where('id', $page->id)
                ->update([
                    'description_json' => json_encode($oldStructure, JSON_UNESCAPED_UNICODE)
                ]);
        }
    }
}
