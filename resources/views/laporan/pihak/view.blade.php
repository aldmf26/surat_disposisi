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
            <form action="{{ route('lap_pengadilan.save_pihak') }}" method="get">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Perkara</label>
                        <select name="id_perkara" class="form-control select2" id="">
                            <option value="">- Pilih Perkara -</option>
                            @foreach ($perkara as $d)
                                <option value="{{ $d->id_perkara }}">{{ $d->no_perkara }} ~ {{ ucwords($d->nm_perkara) }}</option>
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
