@extends('theme.app')
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3 style="text-transform: capitalize">{{ $title }}</h3>
        </div>
        <div class="page-content">
            <form action="{{ route('lap_pengadilan.save_sidang') }}" method="get">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Dari</label>
                        <input type="date" name="tgl1" value="{{ date('Y-m-01') }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Sampai</label>
                        <input type="date" name="tgl2" value="{{ date('Y-m-d') }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                    <label for="">Hakim</label>
                    <select name="id_hakim" class="form-control select2" id="">
                        <option value="">- Pilih Hakim -</option>
                        @foreach ($hakim as $d)
                            <option value="{{ $d->id_hakim }}">{{ $d->nm_hakim }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Aksi</label><br>
                        <button class="btn btn-primary" type="submit">Cetak</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
        

    </div>
@endsection
