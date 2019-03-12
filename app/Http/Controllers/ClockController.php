<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 17/02/19
 * Time: 3:49
 */

namespace App\Http\Controllers;

use App\Http\Requests\Changelog\ListChangelog;
use App\Log;
use App\User;
use Illuminate\Http\Request;

/**
 * Class ChangelogController.
 *
 * @package App\Http\Controllers\Tenant\Web
 */
class ClockController extends Controller
{
    /**
     * Index.
     *
     * @param ListChangelog $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        dd('hola');
        return view('clock.index');
    }
}
