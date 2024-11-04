<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\stokModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;


class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title'=> 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem',
        ];

        $activeMenu = 'stok'; //fungsi eloquent menampilkan data menggunakan pagination
        $stok =StokModel::all(); // Mengambil semua isi tabel
        $barang = BarangModel::all();
        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,
        'stok' => $stok, 'barang'=>$barang]);
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create()
    {
        $breadcrumb = (object) [
            'title'=> 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok Baru',
        ];

        $activeMenu = 'stok'; //fungsi eloquent menampilkan data menggunakan pagination
        $barang = BarangModel::all();
        $user = UserModel::all();
        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,'barang'=>$barang, 'user'=> $user]);
    }

    /**
    * Store a newly created resource in storage.
    */

    // Ambil data stok dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $stok=StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal','stok_jumlah')->with(['barang','users'])->get();

        //filter data stok berdasarkan stok_id
        if ($request->barang_id) {
            $stok = $stok->where('barang_id', $request->barang_id);
        }

        return DataTables::of($stok)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi

        $btn = '<a href="'.url('/stok/show/' . $stok->stok_id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'.url('/stok/'.$stok->stok_id.'/destroy').'">'. csrf_field() .
        method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Apakah Anda yakin menghapus data dengan Id = ' .$stok->stok_id. ' ini?\');">Hapus</button></form>';

        return $btn;
    })

    ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    ->make(true);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'barang_id' => 'required|exists:m_barang,barang_id',
            'user_id' => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required',
            'stok_jumlah' => 'required',
        ]);

        //fungsi eloquent untuk menambah data
       StokModel::create([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
        ]);

        return redirect()->route('stok.index')->with('success', 'stok Berhasil Ditambahkan');
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id,StokModel $stok)
    {
        $stok =StokModel::with(['barang','users'])->find($id); // Mengambil semua isi tabel
        $breadcrumb = (object) [
            'title'=> 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem',
        ];

        $activeMenu = 'stok'; //fungsi eloquent menampilkan data menggunakan pagination
        return view('stok.show', ['stok' => $stok,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }
    /**
    * Show the form for editing the specified resource.
    */

    public function edit(string $id)
    {
        $stok =StokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();
        $breadcrumb = (object) [
            'title'=> 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok',
        ];

        $activeMenu = 'stok'; //fungsi eloquent menampilkan data menggunakan pagination

        return view('stok.edit', ['stok' => $stok, 'user'=>$user, 'barang'=>$barang,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:m_barang,barang_id',
            'user_id' => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required',
            'stok_jumlah' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
       StokModel::find($id)->update([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
        ]);
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('stok.index')->with('success', 'Data Berhasil Diupdate');
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy($id)
    {
        $check=StokModel::findOrFail($id);
        if (!$check) {
            return redirect()->route('stok.index')->with('error', 'Data stok Tidak Ditemukan');
        }

        try
        {
           StokModel::destroy($id); //Hapus Data
            return redirect()->route('stok.index')->with('success', 'Data stok Berhasil Dihapus');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            // Jika terjasi error saat menghapus data maka akan kembali
            return redirect()->route('stok.index')->with('error', 'Data stok Gagal Dihapus');
        }

    }
}
