<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $userPermission;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            //todo выпилить после тестирования
            if ($perm = $request->base19) {
                session()->put('testPermission', $perm);
                session()->put('permissionsSpo.19', $perm);
            } elseif ($perm = session()->get('testPermission')) {
                session()->put('permissionsSpo.19', $perm);
            }
            $this->userPermission = \session('permissionsSpo')['19'];
            View::share('userPermission', $this->userPermission);
            $guides = $this->userPermission > 1
                ? Guide::withTrashed()->with('chapters')->orderBy('sort')->get()
                : Guide::with('chapters')->orderBy('sort')->get();
            View::share('guides', $guides);

            return $next($request);
        });
    }
}
