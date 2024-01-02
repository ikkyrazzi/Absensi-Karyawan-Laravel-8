<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Karyawan;

class HomeController extends Controller
{
    public function index()
    {
        // $timezone = 'Asia/Makassar'; 
        // $date = new DateTime('now', new DateTimeZone($timezone)); 
        // $tanggal = $date->format('Y-m-d');

        // Check the user's role
        $user = auth()->user();

        if ($user->level === 'admin') {
            $adminCount = Admin::count();
            return view('admin.dashboard', compact('adminCount'));
        } elseif ($user->level === 'karyawan') {
            $karyawanCount = Karyawan::count();
            return view('karyawan.dashboard', compact('karyawanCount'));
        } else {
            // Handle other roles or unexpected scenarios
            abort(403, 'Unauthorized');
        }
    }
}
