<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $guarded = [];

    protected $fillable = [
        'name', 'password', 'konfirmasi_password', 'email', 'nip', 'no_hp', 'alamat', 'id_user'
    ];

    public static $rules = [
        'name'                  => 'required',
        'password'              => 'required|min:3|same:konfirmasi_password',
        'konfirmasi_password'   => 'required|min:3',
        'email'                 => 'required|email|unique:users',
        'nip'                   => 'required|numeric|unique:admins',
        'no_hp'                 => 'required|numeric',
        'alamat'                => 'required',
    ];

    public static $ruleMessages = [
        'name.required'                 => 'Nama wajib diisi',
        'password.required'             => 'Password wajib diisi',
        'password.min'                  => 'Password minimal 3 karakter',
        'password.same'                 => 'Konfirmasi password harus sama dengan password',
        'konfirmasi_password.required'  => 'Konfirmasi password wajib diisi',
        'konfirmasi_password.min'       => 'Konfirmasi password minimal 3 karakter',
        'email.required'                => 'Email wajib diisi',
        'email.email'                   => 'Email tidak valid',
        'email.unique'                  => 'Email sudah terdaftar',
        'nip.required'                  => 'NIP wajib diisi',
        'nip.unique'                    => 'NIP sudah terdaftar',
        'no_hp.required'                => 'Nomor handphone wajib diisi',
        'no_hp.numeric'                 => 'Nomor handphone harus berupa angka',
        'alamat.required'               => 'Alamat wajib diisi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public static function createUserAndAdmin($request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'level' => 'admin',
            'password' => $request['password'],
        ]);

        $input = $request->except(['name', 'email', 'password', 'konfirmasi_password']);

        return Admin::create(array_merge($input, ['id_user' => $user->id]));
    }
}
