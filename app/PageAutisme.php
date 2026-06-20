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
     * The `main` field uses the `titre` as requested.
     *
     * @return array
     */
    public function getStructuredDescriptionAttribute()
    {
        if (!empty($this->description_json) && is_array($this->description_json)) {
            return $this->description_json;
        }

        return [
            'main' => $this->titre ?? null,
            'sections' => [
                [
                    'subtitle' => '',
                    'text' => $this->description ?? ''
                ]
            ]
        ];
    }
}
