<?php

namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    /**
     * Generate the path for the media item.
     *
     * @param Media $media
     * @return string
     */
    public function getPath(Media $media): string
    {
        return md5($media->id . config('app.key')) . '/';
    }

    /**
     * Generate the path for the media item conversions.
     *
     * @param Media $media
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return md5($media->id . config('app.key')) . '/conversions/';
    }

    /**
     * Generate the path for the media item responsive images.
     *
     * @param Media $media
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return md5($media->id . config('app.key')) . '/responsive-images/';
    }
}
