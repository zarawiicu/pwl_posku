<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class KategoriController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title'=> 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar Kategori yang terdaftar dalam sistem',
        ];

        $activeMenu = 'kategori'; //fungsi eloquent menampilkan data menggunakan pagination
        $kategori = KategoriModel::all();// Mengambil semua isi tabel

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,
        'kategori' => $kategori]);
    }

    public function create(): View
    {
        $breadcrumb = (object) [
            'title'=> 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Kategori Baru',
        ];

        $activeMenu = 'kategori'; //fungsi eloquent menampilkan data menggunakan pagination
        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);

    }

    //LIST
    public function list(Request $request)
    {
        $kategoris = kategoriModel::select('id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategoris)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi

        $btn = '<a href="'.url('/kategori/show/' . $kategori->id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/kategori/' . $kategori->id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'.url('/kategori/'.$kategori->id.'/destroy').'">'. csrf_field() .
        method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Apakah Anda yakin menghapus data dengan Id = ' .$kategori->id. ' ini?\');">Hapus</button></form>';

        return $btn;
    })
    ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    ->make(true);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100',
        ]);

        //fungsi eloquent untuk menambah data
        kategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Ditambahkan');
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id, kategoriModel $kategori)
    {
        $kategori = kategoriModel::find($id); // Mengambil semua isi tabel
        $breadcrumb = (object) [
            'title'=> 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem',
        ];

        $activeMenu = 'kategori'; //fungsi eloquent menampilkan data menggunakan pagination
        return view('kategori.show', ['kategori' => $kategori,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }
    /**
    * Show the form for editing the specified resource.
    */

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);
        $breadcrumb = (object) [
            'title'=> 'Edit kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kategori',
        ];

        $activeMenu = 'kategori'; //fungsi eloquent menampilkan data menggunakan pagination

        return view('kategori.edit', ['kategori' => $kategori,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,' . $id . ',id',
            'kategori_nama' => 'required|string|max:100',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        kategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('kategori.index')->with('success', 'Data Berhasil Diupdate');
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $check= kategoriModel::findOrFail($id);
        if (!$check) {
            return redirect()->route('kategori.index')->with('error', 'Data kategori Tidak Ditemukan');
        }

        try
        {
            kategoriModel::destroy($id); //Hapus Data
            return redirect()->route('kategori.index')->with('success', 'Data kategori Berhasil Dihapus');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            // Jika terjasi error saat menghapus data maka akan kembali
            return redirect()->route('kategori.index')->with('error', 'Data kategori Gagal Dihapus');
        }

    }
}
