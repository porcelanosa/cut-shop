<?php
declare(strict_types=1);

namespace App\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FakerImageProvider extends Base
{
    public function loremflickr(string $dir = '', int $width = 500, int $height = 500, $theme = ''): string
    {
         $name = $dir . '/' . Str::random(6) . '.jpg';

         $url = 'https://loremflickr.com/' . $width . '/' . $height . '/';

         if($theme) {
             $url .= $theme . '/';
         }

         Storage::put($name, file_get_contents($url));

         return '/storage/'. $name;
    }
}
