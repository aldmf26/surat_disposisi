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
                    <th>Nama Perkara</th>
                    <th>Tanggal Transaksi</th>
                    <th>Uraian</th>
                    <th class="text-right">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ttl = 0;
                @endphp
                @foreach ($datas as $no => $d)
                @php
                    $ttl += $d->nominal;
                @endphp
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $d->no_perkara }}</td>
                        <td>{{ $d->nm_perkara }}</td>
                        <td>{{ tanggal($d->tgl_transaksi) }}</td>
                        <td>{{ $d->uraian }}</td>
                        <td align="right">{{ number_format($d->nominal,0) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-center">Total</th>
                    <td align="right">{{ number_format($ttl,0) }}</td>

                </tr>
            </tfoot>
        </table>
    </div>
@endsection
