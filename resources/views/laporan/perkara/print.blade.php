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
                    <th>Tgl Register</th>
                    <th>Perkara</th>
                    <th width="30%">Para Pihak</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perkara as $no => $d)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $d->no_perkara }}</td>
                        <td>{{ tanggal($d->tgl) }}</td>
                        <td>{{ $d->nm_perkara }}</td>
                        @php
                            $penggugat = DB::table('tb_pihak')
                                ->where([['id_perkara', $d->id_perkara], ['id_jenis_pihak', 1]])
                                ->first();
                            $digugat = DB::table('tb_pihak')
                                ->where([['id_perkara', $d->id_perkara], ['id_jenis_pihak', 2]])
                                ->get();
                        @endphp
                        <td>
                            Penggugat : <br>
                            - {{ $penggugat->nama ?? '' }} <br>
                            <hr>
                            Digugat : <br>
                            @if (!empty($digugat))
                                @foreach ($digugat as $s)
                                    - {{ $s->nama }} <br>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $d->status }}</td>
                      
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
