<?php

namespace App\Traits;

use App\Models\Guide;

trait GetPrograms
{
    public function getPrograms()
    {
        return $this->userPermission > 1
            ? Guide::withTrashed()->with('chapters')->orderBy('sort')->get()
            : Guide::with('chapters')->orderBy('sort')->get();
    }
}
