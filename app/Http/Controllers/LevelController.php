<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index():View {
        $breadcrumb = (object) [
            'title'=> 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem',
        ];

        $activeMenu = 'level'; //fungsi eloquent menampilkan data menggunakan pagination
        $level = LevelModel::all(); // Mengambil semua isi tabel

        return view('level.index', ['level' => $level, 'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,]);
    }

    public function create(): View
    {
        $breadcrumb = (object) [
            'title'=> 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Level Baru',
        ];

        $activeMenu = 'level'; //fungsi eloquent menampilkan data menggunakan pagination
        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);

    }

    //LIST
    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($levels)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($level) { // menambahkan kolom aksi

        $btn = '<a href="'.url('/level/show/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'.url('/level/'.$level->level_id.'/destroy').'">'. csrf_field() .
        method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Apakah Anda yakin menghapus data dengan Id = ' .$level->level_id. ' ini?\');">Hapus</button></form>';

        return $btn;
    })
    ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    ->make(true);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        //fungsi eloquent untuk menambah data
        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect()->route('level.index')->with('success', 'level Berhasil Ditambahkan');
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id, LevelModel $level)
    {
        $level = LevelModel::find($id); // Mengambil semua isi tabel
        $breadcrumb = (object) [
            'title'=> 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem',
        ];

        $activeMenu = 'level'; //fungsi eloquent menampilkan data menggunakan pagination
        return view('level.show', ['level' => $level,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }
    /**
    * Show the form for editing the specified resource.
    */

  public function edit(string $id)
    {
        $level = LevelModel::where($id)->get();
        $breadcrumb = (object) [
            'title'=> 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit level',
        ];

        $activeMenu = 'level'; //fungsi eloquent menampilkan data menggunakan pagination

        return view('level.edit', ['level' => $level,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('level.index')->with('success', 'Data Berhasil Diupdate');
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $check= LevelModel::findOrFail($id);
        if (!$check) {
            return redirect()->route('level.index')->with('error', 'Data level Tidak Ditemukan');
        }

        try
        {
            LevelModel::destroy($id); //Hapus Data
            return redirect()->route('level.index')->with('success', 'Data level Berhasil Dihapus');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            // Jika terjasi error saat menghapus data maka akan kembali
            return redirect()->route('level.index')->with('error', 'Data level Gagal Dihapus');
        }

    }
}

