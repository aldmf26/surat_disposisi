@extends('laporan.theme.print')
@section('content')
    <div class="container">
        <table class="mb-3" cellpadding="3">
            <tr>
                <td>Cetak</td>
                <td>:</td>
                <td>{{ ucwords(Auth::user()->level) }} ({{ Auth::user()->name }})</td>
            </tr>
            <tr>
                <td>Nama Perkara</td>
                <td>:</td>
              
                <td>{{ strtoupper($pihak[0]->nm_perkara) }}</td>
            </tr>

        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Pihak</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pihak as $no => $d)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $d->nik }}</td>
                        <td>{{ ucwords($d->nama) }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>{{ $d->nm_jenis }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
