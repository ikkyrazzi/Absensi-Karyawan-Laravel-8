<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    const TITLE = 'Karyawan';
    const URL = 'admin.karyawans.';
    const FOLDER = 'admin.karyawan.';

    public function index()
    {
        $title = self::TITLE;
        $subtitle = 'Daftar Data';
        $url = self::URL;
        $folder = 'app';

        $karyawans = Karyawan::latest()->get();
        $users = User::latest()->get();

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url', 'karyawans', 'folder', 'users'));
    }

    public function create()
    {
        $title = self::TITLE;
        $subtitle = 'Tambah Data';
        $url = self::URL;

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url'));
    }

    public function store(StoreKaryawanRequest $request)
    {
        // $input = $request->all();

        Karyawan::createUserAndKaryawan($request);

        return redirect()->route(self::URL . 'index');
    }

    public function edit($id)
    {
        $karyawans = Karyawan::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Edit Data';
        $url = self::URL;

        return view(self::FOLDER . 'edit', compact('title', 'subtitle', 'url', 'karyawans'));
    }

    public function update(UpdateKaryawanRequest $request, $id)
    {
        $karyawans = Karyawan::findOrFail($id);

        // $input = $request->all();
        $karyawans->updateUserAndKaryawan($request);
        // $karyawans->update($input);

        return redirect()->route(self::URL . 'index');
    }

    public function destroy($id)
    {
        $karyawans = Karyawan::findOrFail($id);

        $karyawans->delete();

        return redirect()->route('admin.karyawans.index')->with('success', 'Karyawan deleted successfully');
    }

    public function show($id)
    {
        $karyawans = Karyawan::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Detail Karyawan';
        $url = self::URL;

        return view(self::FOLDER . 'show', compact('title', 'subtitle', 'url', 'karyawans'));
    }
}
