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

    public function getCreatedAtFormattedAtribute()
    {

        return optional($this->created_at)->format('h:i:sA d-m-Y');

    }
    public function getCreatedAtHumanAtribute()
    {
        Carbon::setLocale(config('app.locale'));
        return optional($this->created_at)->diffForHumans(Carbon::now());

    }
    public function getCreatedAtTimestampAtribute()
    {

        return optional($this->created_at)->timestamp;

    }
    public function getUpdatedAtFormattedAtribute()
    {

        return optional($this->updated_at)->format('h:i:sA d-m-Y');

    }
    public function getUpdatedAtHumanAtribute()
    {
        Carbon::setLocale(config('app.locale'));
        return optional($this->updated_at)->diffForHumans(Carbon::now());

    }
    public function getUpdatedAtTimestampAtribute()
    {

        return optional($this->updated_at)->timestamp;

    }

}