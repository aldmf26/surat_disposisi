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
                    <th>No Perkara</th>
                    <th>Tanggal Daftar Perkara</th>
                    <th>Nama Perkara</th>
                    <th>Tanggal Sidang - Jam</th>
                    <th>Nama Hakim</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $no => $d)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $d->no_perkara }}</td>
                        <td>{{ tanggal($d->tgl) }}</td>
                        <td>{{ $d->nm_perkara }}</td>
                        <td>{{ tanggal($d->tgl) }} - {{ $d->jam }}</td>
                        <td>{{ $d->nm_hakim }}</td>
                        <td>{{ ucwords($d->ket) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
