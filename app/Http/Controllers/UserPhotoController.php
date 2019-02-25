<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 17/02/19
 * Time: 1:45
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Request;

class UserPhotoController extends Controller
{
    /**
     * Show user photo.
     *
     * @param Request $request
     * @param $tenant
     * @param User $user
     * @return
     */
    public function show(Request $request, $tenant, User $user)
    {
//        dd('hola');
        if (! $user->photo || ! Storage::disk('local')->exists($user->photo)) {
            return response()->file(public_path(User::DEFAULT_PHOTO_PATH));
        }
        return response()->file(Storage::disk('local')->path($user->photo));
    }
    /**
     * Download.
     *
     * @param Request $request
     * @param $tenant
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, $tenant, User $user)
    {
        if (! $user->photo || ! Storage::disk('local')->exists($user->photo)) {
            return response()->download(Storage::disk('local')->path(
                $this->basePath($tenant,User::DEFAULT_PHOTO_PATH)));
        }
        return response()->download(Storage::disk('local')->path($user->photo));
    }
    /**
     * Tenant base path
     *
     * @param $tenant
     * @param $path
     * @return string
     */
    protected function basePath($tenant , $path)
    {
        return $tenant. '/' . $path;
    }
}
