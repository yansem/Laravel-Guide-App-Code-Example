<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Support\Facades\Gate;

class LogController extends Controller
{
    public function index()
    {
        Gate::authorize('edit-program', $this->userPermission);
        $logs = Log::with('operation.table', 'itemable')->get();
        return view('pages.logs', compact('logs'));
    }
}
