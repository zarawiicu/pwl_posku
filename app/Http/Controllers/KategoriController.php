<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    public function index() {
        return view('kategori.index');
    }

    public function create(): View
    {
        return view('kategori.create');
    }

    public function store(StorePostRequest $request):RedirectResponse{
        $validated = $request->validate();
        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);
        
        return redirect('/kategori');
    }

}
