<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKarwayanAbsenRequest;
use App\Http\Requests\UpdateKarwayanAbsenRequest;
use App\Models\Karyawan;
use App\Models\KaryawanAbsen;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class KaryawanAbsenController extends Controller
{
    const TITLE = 'Absen Karyawan';
    const URL = 'admin.absens.';
    const FOLDER = 'admin.absen.';

    public function index()
    {
        $title = self::TITLE;
        $subtitle = 'Daftar Data';
        $url = self::URL;
        $folder = 'absen';

        $karyawanAbsens = KaryawanAbsen::with('karyawan.user')->latest()->get();
        $karyawans = Karyawan::latest()->get();
        $users = User::latest()->get();

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url', 'karyawanAbsens', 'folder', 'karyawans', 'users'));
    }

    public function indexKaryawan()
    {
        $subtitle = 'Daftar Data';

        $userId = auth()->id();

        $karyawanAbsens = KaryawanAbsen::with('karyawan.user')
            ->whereHas('karyawan.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            })
            ->latest()
            ->get();

        $karyawans = Karyawan::latest()->get();
        $users = User::latest()->get();

        return view('karyawan.absen.index', compact('subtitle', 'karyawanAbsens', 'karyawans', 'users'));
    }

    public function create()
    {
        $title = self::TITLE;
        $subtitle = 'Tambah Data';
        $url = self::URL;

        return view('karyawan.absen.index', compact('title', 'subtitle', 'url'));
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'action' => 'required|in:absen_masuk,absen_izin,absen_tidak_masuk,absen_pulang',
        ]);

        // Set kolom 'tgl' dengan tanggal sekarang
        $input['tgl'] = now()->toDateString();

        // Set kolom 'jam_masuk', 'keterangan', 'jam_keluar', dan 'id_karyawan' berdasarkan tombol yang diklik
        if ($request->input('action') === 'absen_masuk') {
            $input['jam_masuk'] = now()->toTimeString();
            $input['keterangan'] = 'Absen Masuk';
            $input['jam_keluar'] = null; // Reset 'jam_keluar' if Absen Masuk
        } elseif ($request->input('action') === 'absen_izin') {
            $input['keterangan'] = 'Absen Izin';
            $input['jam_masuk'] = $input['jam_keluar'] = null; // Reset 'jam_masuk' and 'jam_keluar' if Absen Izin
        } elseif ($request->input('action') === 'absen_tidak_masuk') {
            $input['keterangan'] = 'Absen Tidak Masuk';
            $input['jam_masuk'] = $input['jam_keluar'] = null; // Reset 'jam_masuk' and 'jam_keluar' if Absen Tidak Masuk
        } elseif ($request->input('action') === 'absen_pulang') {
            $existingRecord = KaryawanAbsen::where('tgl', $input['tgl'])
                ->where('id_karyawan', $request->input('id_karyawan'))
                ->first();

            if ($existingRecord) {
                $input['jam_masuk'] = $existingRecord->jam_masuk;
                $input['keterangan'] = $existingRecord->keterangan;
                $input['jam_keluar'] = now()->toTimeString();
            } else {
                return redirect()->back()->with('error', 'Anda belum melakukan absen masuk, absen izin, atau absen tidak masuk hari ini.')->withInput();
            }
        }

        // Validate the rest of the fields
        $request->validate([
            'tgl' => 'nullable|date',
            'jam_masuk' => 'nullable|date_format:H:i:s',
            'jam_keluar' => 'nullable|date_format:H:i:s',
            'keterangan' => 'nullable|string|max:255',
            'id_karyawan' => 'required|exists:karyawans,id',
        ]);

        // Add 'id_karyawan' to the input array
        $input['id_karyawan'] = $request->input('id_karyawan');

        KaryawanAbsen::create($input);

        return redirect()->route('karyawan.absen.index')->with('success', 'Absen berhasil.');
    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->validator->errors())->withInput();
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat absen: ' . $e->getMessage())->withInput();
    }
}



    public function edit($id)
    {
        $karyawanAbsens = KaryawanAbsen::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Edit Data';
        $url = self::URL;

        return view(self::FOLDER . 'edit', compact('title', 'subtitle', 'url', 'karyawanAbsens'));
    }

    public function editCurrentUser()
    {
        $karyawanAbsen = KaryawanAbsen::where('id_karyawan', auth()->user()->id)->first();

        if (!$karyawanAbsen) {
            return redirect()->route('karyawan.absens.indexKaryawan')->with('error', 'Data not found for the current user.');
        }

        $subtitle = 'Edit Data';

        return view('karyawan.absen.edit', compact('subtitle','karyawanAbsen'));
    }

    public function update(UpdateKarwayanAbsenRequest $request, $id)
    {
        $karyawanAbsens = KaryawanAbsen::findOrFail($id);

        $input = $request->all();

        $karyawanAbsens->update($input);

        return redirect()->route(self::URL . 'index');
    }

    public function destroy($id)
    {
        $karyawanAbsens = KaryawanAbsen::findOrFail($id);

        $karyawanAbsens->delete();

        return redirect()->route('admin.absens.index')->with('success', 'KaryawanAbsen deleted successfully');
    }

    public function destroyAbsen($id)
    {
        try {
            // Menggunakan metode findOrFail untuk mencari absensi berdasarkan ID
            $karyawanAbsen = KaryawanAbsen::findOrFail($id);

            // Hapus absensi
            $karyawanAbsen->delete();

            return redirect()->route('karyawan.absens.index')->with('success', 'Absensi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('karyawan.absens.index')->with('error', 'Gagal menghapus absensi.');
        }
    }

    public function show($id)
    {
        $karyawanAbsens = KaryawanAbsen::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Detail KaryawanAbsen';
        $url = self::URL;

        return view(self::FOLDER . 'show', compact('title', 'subtitle', 'url', 'karyawanAbsens'));
    }
}
