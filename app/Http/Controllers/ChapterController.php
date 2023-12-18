<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\Guide;
use Illuminate\Support\Facades\Gate;

class ChapterController extends Controller
{
    public function show(Guide $guide, Chapter $chapter)
    {
        Gate::authorize('show-guide', [$this->userPermission, $guide]);
        return view('chapter.show', compact('chapter', 'guide'));
    }
}
