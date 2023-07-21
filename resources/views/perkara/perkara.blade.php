@extends('theme.app')
@section('content')
    <div id="main">
        <div class="page-heading">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: left">{{ $title }}</h3>
                        <button type="button" class="btn btn-primary" style="float: right" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah">
                            <i class="bi bi-plus"></i> Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Perkara</th>
                                    <th>Tgl Register</th>
                                    <th>Perkara</th>
                                    <th width="30%">Para Pihak</th>
                                    <th>Status</th>
                                    {{-- <th class="text-center">Aksi</th> --}}
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
                                        {{-- <td align="center">
                                            <a data-bs-toggle="modal" data-bs-target="#modal-edit{{ $d->id_perkara }}"
                                                class="btn icon btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin dihapus ?')"
                                                href="{{ route('hapus_surat_masuk', $d->id_perkara) }}"
                                                class="btn  icon btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

    </div>

    {{-- modal tambah --}}
    <div class="modal fade text-left" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <form action="{{ route('tambah_surat_masuk') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">
                            Tambah {{ $title }}
                        </h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal edit --}}
    {{-- @foreach ($pihak as $d)
        <div class="modal fade text-left" id="modal-edit{{$d->id_pihak}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <form action="{{ route('pihak.update') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">
                                Edit {{ $title }}
                            </h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id"  value="{{ $d->id_pihak }}">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Save</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach --}}
@endsection
