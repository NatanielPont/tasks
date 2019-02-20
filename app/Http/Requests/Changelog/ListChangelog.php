<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 17/02/19
 * Time: 3:53
 */

namespace App\Http\Requests\Changelog;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
/**
 * Class ListChangelog.
 *
 * @package App\Http\Requests
 */
class ListChangelog extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('changelog.list');
//        dd('hola');
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
