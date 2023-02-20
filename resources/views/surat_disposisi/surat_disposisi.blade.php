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
                                    <th>No Surat</th>
                                    <th>No Agenda Disposisi</th>
                                    <th>Tgl Disposisi</th>
                                    <th>Pengirim</th>
                                    <th>jenis Surat</th>
                                    <th>Perihal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratDisposisi as $no => $d)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $d->no_surat }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#detail{{$d->id}}" >{{ date('d/m/Y', strtotime($d->tgl_disposisi))}}/{{ $d->no_agenda }}</a>
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($d->tgl_disposisi))}}</td>
                                        <td>{{ $d->suratMasuk->pengirim }}</td>
                                        <td>{{ $d->jenisSurat->jenis_surat }}</td>
                                        <td>{{ $d->suratMasuk->perihal }}</td>
                                        <td align="center">
                                            <a data-bs-toggle="modal" data-bs-target="#modal-edit{{$d->id}}" class="btn icon btn-sm btn-primary"><i
                                                    class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin dihapus ?')"
                                                href="{{ route('hapus_surat_disposisi', [$d->id,$d->suratMasuk->id]) }}"
                                                class="btn  icon btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
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
            <form action="{{ route('tambahSuratDisposisi') }}" enctype="multipart/form-data" method="post">
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
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="basicInput">No Surat</label>
                                    <input readonly name="no_surat" type="text" class="form-control" id="basicInput" value="{{ $noSurat }}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input required type="date" name="tgl_surat" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="basicInput">Pilih Surat</label>
                                    <select name="id_sm" id="" class="form-control">
                                        <option value="">- Pilih Surat Masuk -</option>
                                        @foreach ($suratMasuk as $m)
                                            <option value="{{ $m->id }}">SM-{{ $m->no_surat }} ~ {{ $m->pengirim }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Jenis Surat</label>
                                    <select name="id_js" id="" class="form-control">
                                        <option value="">- Pilih Jenis Surat -</option>
                                        @foreach ($js as $j)
                                            <option value="{{ $j->id }}">{{ $j->jenis_surat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Isi Disposisi</label>
                                        <input class="form-control" type="text" name="isi_disposisi">
                                    </div>
                            </div>
                            
                        </div>
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
    @foreach ($suratDisposisi as $d)
        <div class="modal fade text-left" id="modal-edit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <form action="{{ route('edit_surat_disposisi') }}" method="post">
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
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="hidden" name="id_disposisi" value="{{ $d->id }}"> 
                                        <label for="basicInput">No Surat</label>
                                        <input disabled name="no_surat" type="text" class="form-control" id="basicInput" value="{{ $noSurat }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input required type="date" name="tgl_surat" value="{{ $d->tgl_disposisi }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="basicInput">Pilih Surat</label>
                                        <select disabled name="id_sm" id="" class="form-control">
                                            <option value="">- Pilih Surat Masuk -</option>
                                            @php
                                                $suratMasukD = DB::table('surat_masuk')->get();
                                            @endphp
                                            @foreach ($suratMasukD as $m)
                                                <option {{ $d->suratMasuk->id == $m->id ? 'selected' : '' }} value="{{ $m->id }}">SM-{{ $m->no_surat }} ~ {{ $m->pengirim }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Jenis Surat</label>
                                        <select name="id_js" id="" class="form-control">
                                            <option value="">- Pilih Jenis Surat -</option>
                                            @foreach ($js as $j)
                                                <option {{ $d->jenisSurat->id == $j->id ? 'selected' : '' }} value="{{ $j->id }}">{{ $j->jenis_surat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Isi Disposisi</label>
                                        <input class="form-control" type="text" name="isi_disposisi" value="{{ $d->isi_disposisi }}">
                                    </div>
                                </div>
                                
                            </div>
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
    @endforeach

    {{-- modal detail --}}
    @foreach ($suratDisposisi as $d)
        <div class="modal fade text-left" id="detail{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <form action="{{ route('edit_surat_masuk') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">
                                Detail {{ $title }}
                            </h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table">
                                        <tr>
                                            <td width="30%">Surat Dari</td>
                                            <td width="5%">:</td>
                                            <td>{{ ucwords($d->suratMasuk->pengirim) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Ditujukan</td>
                                            <td width="5%">:</td>
                                            <td>{{ ucwords($d->suratMasuk->ditujukan) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Tanggal Surat</td>
                                            <td width="5%">:</td>
                                            <td>{{ tanggal($d->suratMasuk->tgl_surat) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Berkas</td>
                                            <td width="5%">:</td>
                                            <td><a href="/upload/{{ $d->suratMasuk->berkas }}">{{ $d->suratMasuk->berkas }}</a></td>
                                        </tr>
                                    </table>
    
                                </div>
                                <div class="col-lg-6">
                                    <table class="table">
                                        
                                        <tr>
                                            <td width="40%">Tanggal Diterima</td>
                                            <td width="5%">:</td>
                                            <td>{{ tanggal($d->tgl_disposisi) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">No Agenda</td>
                                            <td width="5%">:</td>
                                            <td>{{ tanggal($d->tgl_disposisi)}}/{{ $d->no_agenda }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Sifat Surat</td>
                                            <td width="5%">:</td>
                                            <td>{{ $d->suratMasuk->sifat_surat }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Isi Disposisi</td>
                                            <td width="5%">:</td>
                                            <td>{{ $d->isi_disposisi }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
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
    @endforeach
@endsection
