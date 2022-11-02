<?php

namespace App\Helpers;

use Carbon\Carbon;

class Custom
{
    public static function formatDate(string $locale, string $date): string
    {
        Carbon::setLocale($locale);
        $date = Carbon::create($date);

        switch ($locale) {
            case 'ca':
                $date_str = $date->month;
                if (in_array($date->month, [4, 8, 10]))
                    $date_str = $date->isoFormat('D [d\']MMMM [de] YYYY');
                else
                    $date_str = $date->isoFormat('D [de] MMMM [de] YYYY');
                break;
            case 'es':
                $date_str = $date->isoFormat('D [de] MMMM [de] YYYY');
                break;
        }

        return $date_str;
    }
}
