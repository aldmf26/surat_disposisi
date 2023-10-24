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
                    <th>Gambar</th>
                    <th>Nama Perkara</th>
                    <th>Uraian Bukti</th>
                    <th>Tgl Penerimaan</th>
                    <th>Nama Penerima</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $no => $d)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $d->no_perkara }}</td>
                        <td><img class="img img-thumbnail" width="150" src="{{ asset("upload/$d->foto") }}" alt=""></td>
                        <td>{{ $d->nm_perkara }}</td>
                        <td>{{ $d->uraian_bukti }}</td>
                        <td>{{ tanggal($d->tgl_penerimaan) }}</td>
                        <td>{{ $d->nm_penerima }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
