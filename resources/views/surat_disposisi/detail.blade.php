@extends('laporan.theme.print')
@section('content')
<div class="container">
    <style>
        table {
            font-size: 13px;
        }
    </style>
    <div class="row">
        <div class="col-lg-6">
            <table class="table">
                <tr>
                    <th width="30%">Surat Dari</th>
                    <th width="5%">:</th>
                    <td>{{ $d->pengirim }}</td>
                </tr>
                <tr>
                    <th width="30%">No Surat</th>
                    <th width="5%">:</th>
                    <td>{{ $d->no_surat }}</td>
                </tr>
                <tr>
                    <th width="30%">Tgl Surat</th>
                    <th width="5%">:</th>
                    <td>{{ $d->tgl_disposisi }}</td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6">
            <table class="table">
                <tr>
                    <th width="30%">Dikirim Tgl</th>
                    <th width="5%">:</th>
                    <td>{{ $d->tgl_surat }}</td>
                </tr>
                <tr>
                    <th width="30%">No. Agenda</th>
                    <th width="5%">:</th>
                    <td>{{ $d->no_agenda }}</td>
                </tr>
                <tr>
                    <th width="30%">Sifat</th>
                    <th width="5%">:</th>
                    <td>{{ $d->jenis_surat }}</td>
                </tr>
            </table>
        </div>
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <th width="14.5%">Perihal</th>
                    <th width="2%">:</th>
                    <th>{{ $d->perihal }}</th>
                </tr>
                <tr>
                    <th width="14.5%">Diserahkan Ke</th>
                    <th width="2%">:</th>
                    <th>{{ $d->ditujukan }}</th>
                </tr>
            </table>
        </div>
        <div class="col-lg-12 text-left">
            <h5>Catatan : </h5>
            <p>{{ $d->isi_disposisi }}</p>
        </div>
        
    </div>
</div>
@endsection
