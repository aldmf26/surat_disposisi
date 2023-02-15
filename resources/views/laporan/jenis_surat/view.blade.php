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
            <form action="{{ route('saveLapJenisSurat') }}" method="get">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Dari</label>
                        <select required name="kode1" id="" class="form-control">
                            <option value="">- Pilih Kode -</option>
                            @foreach ($datas as $p)
                                <option value="{{ $p->kd_js }}">{{ $p->kd_js }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Sampai</label>
                        <select required name="kode2" id="" class="form-control">
                            <option value="">- Pilih Kode -</option>
                            @foreach ($datas as $p)
                                <option value="{{ $p->kd_js }}">{{ $p->kd_js }}</option>
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
