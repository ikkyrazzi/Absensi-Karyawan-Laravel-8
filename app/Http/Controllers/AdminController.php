<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    const TITLE = 'Admin';
    const URL = 'admin.admins.';
    const FOLDER = 'admin.admin.';

    public function index()
    {
        $title = self::TITLE;
        $subtitle = 'Daftar Data';
        $url = self::URL;
        $folder = 'app';

        $admins = Admin::latest()->get();
        $users = User::latest()->get();

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url', 'admins', 'folder', 'users'));
    }

    public function create()
    {
        $title = self::TITLE;
        $subtitle = 'Tambah Data';
        $url = self::URL;

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url'));
    }

    public function store(StoreAdminRequest $request)
    {
        // $input = $request->all();

        Admin::createUserAndAdmin($request);

        return redirect()->route(self::URL . 'index');
    }

    public function edit($id)
    {
        $admins = Admin::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Edit Data';
        $url = self::URL;

        return view(self::FOLDER . 'edit', compact('title', 'subtitle', 'url', 'admins'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $admins = Admin::findOrFail($id);

        // $input = $request->all();
        $admins->updateUserAndAdmin($request);
        // $admins->update($input);

        return redirect()->route(self::URL . 'index');
    }

    public function destroy($id)
    {
        $admins = Admin::findOrFail($id);

        $admins->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully');
    }

    public function show($id)
    {
        $admins = Admin::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Detail Admin';
        $url = self::URL;

        return view(self::FOLDER . 'show', compact('title', 'subtitle', 'url', 'admins'));
    }
}
