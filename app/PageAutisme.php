<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageAutisme extends Model
{
    protected $fillable = [
        'titre', 'description', 'page_image', 'description_json'
    ];

    protected $casts = [
        'description_json' => 'array',
    ];

    /**
     * Append a computed structured description to the model's array/json form.
     */
    protected $appends = ['structured_description'];

    /**
     * Returns a structured description object.
     * Uses `description_json` when present; falls back to legacy `description` wrapped as a single section.
     * Now supports the enhanced block-based structure.
     *
     * @return array
     */
    public function getStructuredDescriptionAttribute()
    {
        if (!empty($this->description_json) && is_array($this->description_json)) {
            // Check if it's the new enhanced structure
            if (isset($this->description_json['sections']) && is_array($this->description_json['sections'])) {
                return $this->description_json;
            }
            
            // Handle old structure and convert to new format
            return $this->convertOldStructureToNew($this->description_json);
        }

        // Fallback for very old data
        return [
            'sections' => [
                [
                    'id' => uniqid('paragraph_', true),
                    'type' => 'paragraph',
                    'content' => $this->description ?? ''
                ]
            ]
        ];
    }

    /**
     * Convert old JSON structure to new enhanced structure
     *
     * @param array $oldStructure
     * @return array
     */
    private function convertOldStructureToNew($oldStructure)
    {
        $newStructure = ['sections' => []];
        
        if (isset($oldStructure['sections'])) {
            foreach ($oldStructure['sections'] as $section) {
                if (!empty($section['subtitle'])) {
                    $newStructure['sections'][] = [
                        'id' => uniqid('heading_', true),
                        'type' => 'heading',
                        'level' => 3,
                        'content' => $section['subtitle']
                    ];
                }
                
                if (!empty($section['text'])) {
                    $newStructure['sections'][] = [
                        'id' => uniqid('paragraph_', true),
                        'type' => 'paragraph',
                        'content' => $section['text']
                    ];
                }
            }
        }
        
        return $newStructure;
    }
}
