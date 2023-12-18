<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuideStoreRequest;
use App\Http\Requests\GuideUpdateRequest;
use App\Models\Guide;
use App\Services\Program\ChapterService;
use App\Services\Program\GuideFilesService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GuideController extends Controller
{
    public function show(Guide $guide)
    {
        Gate::authorize('show-guide', [$this->userPermission, $guide]);
        $guide = $guide->load(['files']);
        return view('guide.show', compact('guide'));
    }

    public function create()
    {
        Gate::authorize('edit-guide', $this->userPermission);
        return view('guide.create');
    }

    public function store(GuideStoreRequest $request, ChapterService $chapterService, GuideFilesService $guideFilesService)
    {
        Gate::authorize('edit-guide', $this->userPermission);
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $guide = Guide::create($data);
            libxml_use_internal_errors(true);
            $file = $request->file('file');
            list($titles, $texts) = $chapterService->parseHTML($file, $guide->id);
            $chapterService->store($titles, $texts, $guide->id);
            $guideFilesService->store($file, $guide->id);
            foreach (libxml_get_errors() as $error) {
                throw new \Exception(__('An error was found in the file on the :line line.', ['line' => $error->line]));
            }
            libxml_clear_errors();
            DB::commit();
            return redirect()->route('guide.show', $guide->id)->with('success', __('Guide added'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('guide.create')->with('error', $exception->getMessage())->withInput();
        }
    }

    public function edit(Guide $guide)
    {
        Gate::authorize('edit-guide', $this->userPermission);
        return view('guide.edit', compact('guide'));
    }

    public function update(GuideUpdateRequest $request, Guide $guide, ChapterService $chapterService, GuideFilesService $guideFilesService)
    {
        Gate::authorize('edit-guide', $this->userPermission);
        $data = $request->validated();
        if ($guide->approved) $data['approved'] = false;

        try {
            DB::beginTransaction();
            $guide->update($data);
            if ($request->hasFile('file')) {
                libxml_use_internal_errors(true);
                $file = $request->file('file');
                list($titles, $texts) = $chapterService->parseHTML($file, $guide->id);
                $chapterService->update($titles, $texts, $guide->id);
                $guideFilesService->store($file, $guide->id);
                foreach (libxml_get_errors() as $error) {
                    throw new \Exception(__('An error was found in the file on the :line line.', ['line' => $error->line]));
                }
                libxml_clear_errors();
            }
            DB::commit();
            return redirect()->route('guide.show', $guide->id)->with('success', __('The guide has been updated'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('guide.edit', $guide->id)->with('error', $exception->getMessage())->withInput();
        }
    }

    public function destroy(Guide $guide)
    {
        Gate::authorize('edit-guide', $this->userPermission);
        $guide->delete();
        return redirect()->route('guide.show', $guide->id)->with('success', __('The guide is hidden'));
    }

    public function restore(Guide $guide)
    {
        Gate::authorize('edit-guide', $this->userPermission);
        $guide->restore();
        return redirect()->route('guide.show', $guide->id)->with('success', __('Guide restored'));
    }

    public function approval(Guide $guide)
    {
        Gate::authorize('edit-guide', $this->userPermission);
        $guide->update(['approved' => true]);
        return redirect()->route('guide.show', $guide->id)->with('success', __('Changes confirmed'));
    }
}
