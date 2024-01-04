@extends('admin.layouts.app')

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
        <h1>Data Karyawan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.karyawans.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required autofocus />
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autofocus />
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Ulangi Password</label>
                                        <input type="password" class="form-control @error('konfirmasi_password') is-invalid @enderror" name="konfirmasi_password" id="konfirmasi_password" required autofocus />
                                        @error('konfirmasi_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required autofocus />
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" required autofocus />
                                        @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>No Hp</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" required autofocus />
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" id="tgl_lahir" required autofocus />
                                        @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" name="nama_jabatan">
                                            <option value="">Pilih</option>
                                            <option value="Direktur Utama">Direktur Utama</option>
                                            <option value="Direktur Keuangan">Direktur Keuangan</option>
                                            <option value="Direktur Pemasaran">Direktur Pemasaran</option>
                                            <option value="Direktur IT">Direktur IT</option>
                                            <option value="HRD">HRD</option>
                                            <option value="Koordinator Keuangan">Koordinator Keuangan</option>
                                            <option value="Staf Keuangan">Staf Keuangan</option>
                                            <option value="Koordinator Pemasaran">Koordinator Pemasaran</option>
                                            <option value="Staf Pemasaran">Staf Pemasaran</option>
                                            <option value="Koordinator Produksi">Koordinator Produksi</option>
                                            <option value="Staf Produksi">Staf Produksi</option>
                                            <option value="Koordinator Graphic Design">Koordinator Graphic Design</option>
                                            <option value="Staf Graphic Design">Staf Graphic Design</option>
                                        </select>
                                        @error('nama_jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>                                    
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <select class="form-control @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                            <option value="">Pilih</option>
                                            <option value="sma">SMA/SMK Sederajat</option>
                                            <option value="diploma">Diploma</option>
                                            <option value="sarjana">Sarjana</option>
                                        </select>
                                        @error('pendidikan_terakhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Tambah Karyawan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil! </strong>{{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">No Hp</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($karyawans as $karyawan)
                                    <tr>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $no++ }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawan->user->name }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawan->user->email }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawan->nik }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawan->no_hp }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawan->alamat }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $karyawan->nama_jabatan }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                {{-- <a href="{{ route('hrd.kriterias.show', $kriteria->id) }}" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                                                <form action="{{ route('admin.karyawans.destroy', $karyawan->id) }}" method="POST" style="display: inline;">
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
