<style>
    .chart-container {
        position: relative;
        display: flex;
        justify-content: center;
    }

    .chart-legend {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
    }
</style>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <section class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="text-center">

                            <h5 id="welcome-message">Hii <b>{{ Auth::user()->name }}</b>, silahkan absen masuk</h5><br>
                            <p>
                                <a href="{{ route('karyawan.absens.indexKaryawan') }}">Klik Disini</a>
                            </p>      

                            <h5 id="welcome-message">Untuk absen pulang</h5><br>
                            <p>
                                <a href="{{ route('karyawan.absens.edit', auth()->user()->id) }}">Klik Disini</a>
                            </p>                              

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
</section>

<script>
    function absenMasuk() {
        var waktuSekarang = new Date();
        var jam = waktuSekarang.getHours();
        var menit = waktuSekarang.getMinutes();

        var konfirmasi = confirm("Anda telah Absen Masuk jam " + jam + ":" + menit + ". Apakah Anda ingin mengarahkan ke halaman Absen Masuk?");
        
        if (konfirmasi) {
            // Mengarahkan ke halaman Absen Masuk
            window.location.href = "{{ route('karyawan.absens.indexKaryawan') }}";
        }
    }

    function absenKeluar() {
        var waktuSekarang = new Date();
        var jam = waktuSekarang.getHours();
        var menit = waktuSekarang.getMinutes();

        alert("Anda telah Pulang jam " + jam + ":" + menit);
    }
</script>