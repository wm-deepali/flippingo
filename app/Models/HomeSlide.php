<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;

    /**
     * Mass-assignable fields
     */
    protected $fillable = [
        'title',
        'highlight',
        'features',
        'slider_for',
        // Media
        'media_type',   // image | video
        'video_type',   // upload | youtube | vimeo | external
        'media_path',   // storage path or external URL

        // Buttons
        'btn1_text',
        'btn1_icon',
        'btn1_link',
        'btn2_text',
        'btn2_icon',
        'btn2_link',

        // Meta
        'sort_order',
        'is_active',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    /* -------------------------------------------------
     | Helper methods (optional but recommended)
     -------------------------------------------------*/

    public function isImage(): bool
    {
        return $this->media_type === 'image';
    }

    public function isVideo(): bool
    {
        return $this->media_type === 'video';
    }

    public function isUploadedVideo(): bool
    {
        return $this->isVideo() && $this->video_type === 'upload';
    }

    public function isExternalVideo(): bool
    {
        return $this->isVideo() && in_array($this->video_type, ['youtube', 'vimeo', 'external']);
    }
}
