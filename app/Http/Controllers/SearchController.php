<?php

namespace App\Http\Controllers;


use App\Http\Requests\SearchRequest;
use App\Models\Chapter;
use App\Services\Program\SearchService;

class SearchController extends Controller
{
    public function index(SearchRequest $request, SearchService $service)
    {
        if ($q = $request->q) {
            $chapters = Chapter::select('chapters.*', 'guides.sort')
                ->join('guides', 'guides.id', '=', 'chapters.guide_id')
                ->when($this->userPermission === '1',
                    function ($query) {
                        $query->where([['guides.approved', 1], ['guides.public', 1]])
                            ->where('guides.deleted_at', null);
                    })
                ->where(function ($query) use ($q) {
                    $q = addslashes($q);
                    $query->where('chapters.title', 'LIKE', '%' . $q . '%')
                        ->orWhere('chapters.text', 'LIKE', '%' . $q . '%');
                })
                ->with(['guide' => function ($query) {
                    $query->withTrashed();
                }])
                ->orderBy('sort')
                ->paginate(10)
                ->appends(request()->except('page'));
            $results = [];
            if ($chapters->total() > 0) {
                foreach ($chapters as $chapter) {
                    $results[$chapter->id] = [
                        'guideTitle' => $chapter->guide->title,
                        'guideId' => $chapter->guide->id,
                        'chapterTitle' => mb_stripos($chapter->title, $q, 0, 'utf-8') !== false
                            ? $service->matchText($q, $chapter->title)
                            : $chapter->title,
                        'chapterText' => mb_stripos($chapter->text, $q, 0, 'utf-8') !== false
                            ? $service->matchText($q, $chapter->text)
                            : ''
                    ];
                }
            }
            return view('pages.search', compact('q', 'chapters', 'results'));
        } else {
            return redirect()->route('home');
        }
    }
}
