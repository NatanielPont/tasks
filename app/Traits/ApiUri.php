<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 22/11/18
 * Time: 20:14
 */

namespace App\Traits;


use Illuminate\Support\Str;
/**
 * Class ApiURI.
 *
 * @package App\Models\Traits
 */
trait ApiURI
{
    /**
     * formatted_created_at_date attribute.
     *
     * @return mixed
     */
    public function getApiURIAttribute()
    {
        return strtolower(Str::snake(Str::plural(class_basename($this))));
    }
}
