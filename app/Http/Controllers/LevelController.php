<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;

class LevelController extends Controller
{
    public function  index() {
        
        $level = LevelModel::all();
        return view('level.index', ['data' => $level]);
        }
    
        public function create(): View
        {
            return view('level.create');
        }
    
        public function store(StoreLevelRequest $request):RedirectResponse{
            $validated = $request->validate();
            $validated = $request->safe()->only(['level_kode', 'level_nama']);
            $validated = $request->safe()->except(['level_kode', 'level_nama']);
            
            return redirect('/level');
        }
    }

