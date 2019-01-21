<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 22/11/18
 * Time: 20:14
 */

namespace App\Traits;


use Carbon\Carbon;

trait FormattedDates
{

    public function getCreatedAtFormattedAttribute()
    {
        return optional($this->created_at)->format('h:i:sA d-m-Y');
    }
    public function getCreatedAtTimestampAttribute()
    {
        return optional($this->created_at)->timestamp;
    }
    public function getCreatedAtHumanAttribute()
    {
        Carbon::setLocale(config('app.locale'));
        return optional($this->created_at)->diffForHumans(Carbon::now());
    }
    public function getUpdatedAtFormattedAttribute()
    {
        return optional($this->updated_at)->format('h:i:sA d-m-Y');
    }
    public function getUpdatedAtHumanAttribute()
    {
        Carbon::setLocale(config('app.locale'));
        return optional($this->updated_at)->diffForHumans(Carbon::now());
    }
    public function getUpdatedAtTimestampAttribute()
    {
        return optional($this->updated_at)->timestamp;
    }

}
