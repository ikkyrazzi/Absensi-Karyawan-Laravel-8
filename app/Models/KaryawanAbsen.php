<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanAbsen extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $guarded = [];

    protected $fillable = [
        'id_karyawan','tgl', 'jam_masuk', 'jam_keluar', 'keterangan'
    ];

    public static $rules = [
        'tgl'                  => 'required',
        'jam_masuk'            => 'nullable',
        'jam_keluar'           => 'nullable',
        'keterangan'           => 'nullable',
    ];

    public static $ruleMessages = [

    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
