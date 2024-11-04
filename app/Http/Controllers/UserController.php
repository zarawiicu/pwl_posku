<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title'=> 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar User yang terdaftar dalam sistem',
        ];

        $activeMenu = 'user'; //fungsi eloquent menampilkan data menggunakan pagination
        $useri = UserModel::all(); // Mengambil semua isi tabel
        $levels = LevelModel::all();
        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,
        'useri' => $useri, 'levels'=> $levels]);
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create()
    {
        $breadcrumb = (object) [
            'title'=> 'Tambah User User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah User Baru',
        ];

        $activeMenu = 'user'; //fungsi eloquent menampilkan data menggunakan pagination
        $levels = LevelModel::all();
        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu,'levels'=> $levels]);
    }

    /**
    * Store a newly created resource in storage.
    */

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');

        //filter data user berdasarkan level_id
        if ($request->level_id) {
            $users = $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($user) { // menambahkan kolom aksi

        $btn = '<a href="'.url('/user/show/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'.url('/user/'.$user->user_id.'/destroy').'">'. csrf_field() .
        method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Apakah Anda yakin menghapus data dengan Id = ' .$user->user_id. ' ini?\');">Hapus</button></form>';

        return $btn;
    })

    ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    ->make(true);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|exists:m_level,level_id',
        ]);

        //fungsi eloquent untuk menambah data
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
        ]);

        return redirect()->route('user.index')->with('success', 'user Berhasil Ditambahkan');
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id, UserModel $useri)
    {
        $useri = UserModel::with('level')->find($id); // Mengambil semua isi tabel
        $breadcrumb = (object) [
            'title'=> 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Daftar User yang terdaftar dalam sistem',
        ];

        $activeMenu = 'user'; //fungsi eloquent menampilkan data menggunakan pagination
        return view('user.show', ['useri' => $useri,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }
    /**
    * Show the form for editing the specified resource.
    */

    public function edit(string $id)
    {
        $useri = UserModel::find($id);
        $levels = LevelModel::all();
        $breadcrumb = (object) [
            'title'=> 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User',
        ];

        $activeMenu = 'user'; //fungsi eloquent menampilkan data menggunakan pagination

        return view('user.edit', ['useri' => $useri, 'levels'=> $levels,'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu'=> $activeMenu]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|exists:m_level,level_id',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? Hash::make($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id,
        ]);
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('user.index')->with('success', 'Data Berhasil Diupdate');
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $check= UserModel::findOrFail($id);
        if (!$check) {
            return redirect()->route('user.index')->with('error', 'Data User Tidak Ditemukan');
        }

        try
        {
            UserModel::destroy($id); //Hapus Data
            return redirect()->route('user.index')->with('success', 'Data User Berhasil Dihapus');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            // Jika terjasi error saat menghapus data maka akan kembali
            return redirect()->route('user.index')->with('error', 'Data User Gagal Dihapus');
        }

    }
}
