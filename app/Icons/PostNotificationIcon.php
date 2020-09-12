<?php


namespace App\Icons;

use Piscibus\Notifly\Notifications\Icon;

class PostNotificationIcon extends Icon
{
    /**
     * Get notification icon attributes
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'width' => 0,
            'height' => 0,
            'uri' => null,
        ];
    }
}
