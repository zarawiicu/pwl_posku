<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BarangModel;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;


class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title'=> 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem',
        ];

        $activeMenu = 'barang'; //fungsi eloquent menampilkan data menggunakan pagination
        $barang = BarangModel::all(); // Mengambil semua isi tabel
        $kategori = KategoriModel::all();
        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,
        'barang' => $barang, 'kategori'=>$kategori]);
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create()
    {
        $breadcrumb = (object) [
            'title'=> 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Barang Baru',
        ];

        $activeMenu = 'barang'; //fungsi eloquent menampilkan data menggunakan pagination
        $kategori = KategoriModel::all();
        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,'kategori'=>$kategori]);
    }

    /**
    * Store a newly created resource in storage.
    */

    // Ambil data barang dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $barang= BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama','harga_beli', 'harga_jual')->with('kategori');

        //filter data barang berdasarkan kategori_id
        if ($request->kategori_id) {
            $barang = $barang->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barang)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi

        $btn = '<a href="'.url('/barang/show/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'.url('/barang/'.$barang->barang_id.'/destroy').'">'. csrf_field() .
        method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Apakah Anda yakin menghapus data dengan Id = ' .$barang->barang_id. ' ini?\');">Hapus</button></form>';

        return $btn;
    })

    ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    ->make(true);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'kategori_id' => 'required|exists:m_kategori,id',
            'barang_kode' => 'required',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
        ]);

        //fungsi eloquent untuk menambah data
        BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('barang.index')->with('success', 'barang Berhasil Ditambahkan');
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id, BarangModel $barang)
    {
        $barang = BarangModel::with('kategori')->find($id); // Mengambil semua isi tabel
        $breadcrumb = (object) [
            'title'=> 'Detail barang',
            'list' => ['Home', 'barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem',
        ];

        $activeMenu = 'barang'; //fungsi eloquent menampilkan data menggunakan pagination
        return view('barang.show', ['barang' => $barang,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }
    /**
    * Show the form for editing the specified resource.
    */

    public function edit(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();
        $breadcrumb = (object) [
            'title'=> 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang',
        ];

        $activeMenu = 'barang'; //fungsi eloquent menampilkan data menggunakan pagination

        return view('barang.edit', ['barang' => $barang, 'kategori'=>$kategori,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:m_kategori,id',
            'barang_kode' => 'required',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        BarangModel::find($id)->update([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('barang.index')->with('success', 'Data Berhasil Diupdate');
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $check= BarangModel::findOrFail($id);
        if (!$check) {
            return redirect()->route('barang.index')->with('error', 'Data barang Tidak Ditemukan');
        }

        try
        {
            BarangModel::destroy($id); //Hapus Data
            return redirect()->route('barang.index')->with('success', 'Data barang Berhasil Dihapus');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            // Jika terjasi error saat menghapus data maka akan kembali
            return redirect()->route('barang.index')->with('error', 'Data barang Gagal Dihapus');
        }

    }
}
