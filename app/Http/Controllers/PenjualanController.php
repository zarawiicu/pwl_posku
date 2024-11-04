<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenjualanModel;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;



class PenjualanController extends Controller
{
   public function index()
    {
        $breadcrumb = (object) [
            'title'=> 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem',
        ];

        $activeMenu = 'penjualan'; //fungsi eloquent menampilkan data menggunakan pagination
        $penjualan = PenjualanModel::all(); // Mengambil semua isi tabel
        $user = UserModel::all();
        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,
        'penjualan' => $penjualan, 'user'=>$user]);
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create()
    {
        $breadcrumb = (object) [
            'title'=> 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah penjualan Baru',
        ];

        $activeMenu = 'penjualan'; //fungsi eloquent menampilkan data menggunakan pagination
        $user = UserModel::all();
        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,'user'=>$user]);
    }

    /**
    * Store a newly created resource in storage.
    */

    // Ambil data penjualan dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $penjualans= PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode','tanggal')->with('users');

        //filter data penjualan berdasarkan user_id
        if ($request->user_id) {
            $penjualan = $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi

        $btn = '<a href="'.url('/penjualan/show/' . $penjualan->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/penjualan/' . $penjualan->penjualan_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'.url('/penjualan/'.$penjualan->penjualan_id.'/destroy').'">'. csrf_field() .
        method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Apakah Anda yakin menghapus data dengan Id = ' .$penjualan->penjualan_id. ' ini?\');">Hapus</button></form>';

        return $btn;
    })

    ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    ->make(true);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required',
            'penjualan_kode' => 'required',
            'tanggal' => 'required',
        ]);

        //fungsi eloquent untuk menambah data
        PenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('penjualan.index')->with('success', 'penjualan Berhasil Ditambahkan');
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id, PenjualanModel $penjualan)
    {
        $penjualan = PenjualanModel::with('users')->find($id); // Mengambil semua isi tabel
        $breadcrumb = (object) [
            'title'=> 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem',
        ];

        $activeMenu = 'penjualan'; //fungsi eloquent menampilkan data menggunakan pagination
        return view('penjualan.show', ['penjualan' => $penjualan,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }
    /**
    * Show the form for editing the specified resource.
    */

    public function edit(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::all();
        $breadcrumb = (object) [
            'title'=> 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit penjualan',
        ];

        $activeMenu = 'penjualan'; //fungsi eloquent menampilkan data menggunakan pagination

        return view('penjualan.edit', ['penjualan' => $penjualan, 'user'=>$user,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required',
            'penjualan_kode' => 'required',
            'tanggal' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        PenjualanModel::find($id)->update([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'tanggal' => $request->tanggal,
        ]);
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('penjualan.index')->with('success', 'Data Berhasil Diupdate');
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
{
    $check = PenjualanModel::find($id);
    // Hapus data yang terkait di tabel anak (t_penjualan_detail)
    \DB::table('t_penjualan_detail')->where('penjualan_id', $id)->delete();

    // Setelah data di tabel anak dihapus, baru hapus data di tabel induk (t_penjualan)
    PenjualanModel::destroy($id);
    return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus.');

}

}
