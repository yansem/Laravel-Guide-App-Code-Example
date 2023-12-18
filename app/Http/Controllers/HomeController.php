<?php

namespace App\Http\Controllers;

use App\Models\Guide;

/**
 * Description of HomeController
 *
 * @author dgluh
 */
class HomeController extends Controller
{
    public function index()
    {
        $guide = $this->userPermission > 1
            ? Guide::withTrashed()->orderBy('sort')->first()
            : Guide::where([['public', true], ['approved', true]])->orderBy('sort')->first();

        return $guide
            ? redirect()->route('guide.show', $guide->id)
            : view('pages.welcome');
    }
}
