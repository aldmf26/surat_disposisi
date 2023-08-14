@extends('laporan.theme.print')
@section('content')
    <div class="container">
        <table class="table" id="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Divisi</th>
                    <th>Nama Divisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($query as $no => $d)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $d->kd_divisi }}</td>
                        <td>{{ $d->nm_divisi }}</td>
                      
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
