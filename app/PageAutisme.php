<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageAutisme extends Model
{
    protected $fillable = [
        'titre', 'description', 'page_image', 'structured_description'
    ];

    protected $casts = [
        'structured_description' => 'array',
    ];

    /**
     * Append a computed structured description to the model's array/json form.
     */
    protected $appends = ['structured_description_data']; // Renamed to avoid conflict with cast attribute

    /**
     * Returns a structured description object.
     * Uses structured_description when present; falls back to legacy description wrapped as a single section.
     * Now supports the enhanced block-based structure.
     *
     * @return array
     */
    public function getStructuredDescriptionDataAttribute() // Renamed accessor
    {
        $structuredData = $this->attributes['structured_description'] ?? null;

        if (!empty($structuredData)) {
            // Laravel's casting already decodes it, so $structuredData is already an array
            if (is_array($structuredData) && isset($structuredData['sections']) && is_array($structuredData['sections'])) {
                return $structuredData;
            }
            // If it's old structured_description format (e.g., a simple string or an array not matching new structure), convert it
            return $this->convertOldStructureToNew($structuredData);
        }

        // Fallback for very old data or if structured_description is empty
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
     * @param array|string $oldStructure
     * @return array
     */
    private function convertOldStructureToNew($oldStructure)
    {
        // If it's a simple string, wrap it as a paragraph
        if (is_string($oldStructure)) {
            return [
                'sections' => [
                    [
                        'id' => uniqid('paragraph_', true),
                        'type' => 'paragraph',
                        'content' => $oldStructure
                    ]
                ]
            ];
        }

        // If it's an array but not in the new 'sections' format, try to convert
        $newStructure = ['sections' => []];

        // This part assumes $oldStructure is an array, potentially from an older structured format
        if (is_array($oldStructure) && isset($oldStructure['sections'])) {
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
        } else if (is_array($oldStructure) && !empty($oldStructure)) {
            // If it's an array but doesn't have 'sections', treat it as a single paragraph or similar
            // This is a generic fallback, might need more specific logic depending on old data
            $newStructure['sections'][] = [
                'id' => uniqid('paragraph_', true),
                'type' => 'paragraph',
                'content' => json_encode($oldStructure) // Encode array to string for content
            ];
        }


        return $newStructure;
    }
}
