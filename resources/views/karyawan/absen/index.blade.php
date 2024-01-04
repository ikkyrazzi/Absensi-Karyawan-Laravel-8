@extends('karyawan.layouts.app')

@section('addTitle') 

@endsection

@section('addCss') 

@endsection 

@section('addJs') 

@endsection 

@section('addJsCustom') 

@endsection 

@section('subheader') 

@endsection 

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Absen Karyawan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('karyawan.absens.store') }}">
                            @csrf
                            <input type="hidden" name="id_karyawan" value="{{ auth()->user()->karyawan->id }}">
                            <!-- Your other form fields, if any -->
                        
                            <div class="row">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <div class="text-center">
                        
                                        <h5>Silahkan Absen Masuk!</h5>
                        
                                        <p>Tanggal dan Jam saat ini: <strong>{{ date('j F Y') }}</strong></p>
                        
                                        <div class="mt-3">
                                            <button type="submit" name="action" value="absen_masuk" class="btn btn-success">Absen Masuk</button>
                                            <button type="submit" name="action" value="absen_izin" class="btn btn-warning">Absen Izin</button>
                                            <button type="submit" name="action" value="absen_tidak_masuk" class="btn btn-danger">Absen Tidak Masuk</button>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" name="action" value="absen_pulang" class="btn btn-info">Absen Pulang</button>
                                        </div>
                        
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Jam Masuk</th>
                                        <th class="text-center">Jam Keluar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($karyawanAbsens as $karyawanAbsen)
                                    <tr>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $no++ }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawanAbsen->karyawan->nik }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ optional($karyawanAbsen->karyawan->user)->name }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawanAbsen->karyawan->nama_jabatan }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawanAbsen->keterangan }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawanAbsen->tgl }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawanAbsen->jam_masuk ? \Carbon\Carbon::parse($karyawanAbsen->jam_masuk)->format('H:i') : '-' }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawanAbsen->jam_keluar ? \Carbon\Carbon::parse($karyawanAbsen->jam_keluar)->format('H:i') : '-' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                {{-- <a href="{{ route('hrd.kriterias.show', $kriteria->id) }}" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                                                <form action="{{ route('karyawan.absens.destroy', $karyawanAbsen->id) }}" method="POST" style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
