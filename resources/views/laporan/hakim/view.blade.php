@extends('theme.app')
@section('content')
    <div id="main">
        <div class="page-heading">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: left">{{ $title }}</h3>
                        <a href="{{ route('lap_pengadilan.save_hakim') }}" class="btn btn-primary" style="float: right"
                                        >
                                        <i class="bi bi-filetype-pdf"></i> Cetak
                                    </a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nik</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $no => $d)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ $d->nm_hakim }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>{{ $d->no_hp }}</td>
                         
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
