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
            <td>Filter</td>
            <td>:</td>
            <td>{{ ucwords($filter) }}</td>
        </tr>
    </table>
    <table class="table">
        <thead>
            @if ($jenis == 1)
                <tr>
                    <th>#</th>
                    <th>No Surat</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Ditujukan</th>
                    <th>Perihal</th>
                    <th>Sifat Surat</th>
                    <th>Status</th>
                    <th>Berkas</th>
                </tr>
            @else
                <tr>
                    <th>#</th>
                    <th>No Surat</th>
                    <th>No Agenda</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Ditujukan</th>
                    <th>Perihal</th>
                    <th>Jenis Surat</th>
                    <th>Status</th>
                    <th>Berkas</th>
                    <th>Isi Disposisi</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @foreach ($query as $no => $d)
            @if ($jenis == 1)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $d->no_surat }}</td>
                    <td>{{ date('d/m/Y', strtotime($d->tgl_surat)) }}</td>
                    <td>{{ $d->pengirim }}</td>
                    <td>{{ $d->ditujukan }}</td>
                    <td>{{ $d->perihal }}</td>
                    <td>{{ $d->sifat_surat }}</td>
                    <td>{{ $d->status_disposisi }}</td>
                    <td>
                        <a href="{{ asset("upload/$d->berkas") }}">
                        {{ $d->berkas }}
                        </a>
                    </td>
                </tr>
            @else
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $d->no_surat }}</td>
                    <td>{{ date('d/m/Y', strtotime($d->tgl_disposisi))}}/{{ $d->no_agenda }}</td>
                    <td>{{ date('d/m/Y', strtotime($d->tgl_disposisi)) }}</td>
                    <td>{{ $d->pengirim }}</td>
                    <td>{{ $d->ditujukan }}</td>
                    <td>{{ $d->perihal }}</td>
                    <td>{{ $d->jenis_surat }}</td>
                    <td>{{ $d->status_disposisi }}</td>
                    <td>
                        <a href="{{ asset("upload/$d->berkas") }}">
                        {{ $d->berkas }}
                        </a>
                    </td>
                    <td>{{ $d->isi_disposisi }}</td>

                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
