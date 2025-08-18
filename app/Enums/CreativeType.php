<?php

namespace App\Enums;

enum CreativeType: string
{
    case EXPENDABLE_VIDEO = 'Expendable Video';
    case VIDEO_CANVAS = 'Video Canvas';
    case SCRATCH = 'Scratch';
    case CAROUSEL = 'Carousel';
    public function getLabel():string
    {
        return match($this) {
            self::EXPENDABLE_VIDEO => 'Expendable Video',
            self::VIDEO_CANVAS => 'Video Canvas',
            self::SCRATCH => 'Scratch',
            self::CAROUSEL => 'Carousel',
        };
    }
}

?>