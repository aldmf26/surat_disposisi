@extends('laporan.theme.print')
@section('content')
    <div class="container">
        <table class="mb-3" cellpadding="3">
            <tr>
                <td>Cetak</td>
                <td>:</td>
                <td>{{ ucwords(Auth::user()->level) }} ({{ Auth::user()->name }})</td>
            </tr>

        </table>
        <table class="table table-bordered">
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
                        <td>{{ ucwords($d->nm_hakim) }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>{{ $d->no_hp }}</td>
         
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
