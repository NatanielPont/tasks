<?php
namespace App\Http\Controllers;
/**
 * Class ChatController.
 *
 * @package App\Http\Controllers\Tenant\Web
 */
class GameController extends Controller
{
    /**
     * Index.
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('game.index' );
    }
}
