@extends('theme.app')
@section('content')
    <div id="main">
        <div class="page-heading">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: left">{{ $title }}</h3>
                        <button type="button" class="btn btn-primary" style="float: right"
                                data-bs-toggle="modal" data-bs-target="#modal-tambah">
                                <i class="bi bi-plus"></i> Tambah Data
                            </button>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>Tgl</th>
                                    <th>Pengirim</th>
                                    <th>Di Tujukan</th>
                                    <th>Status Disposisi</th>
                                    <th>Berkas</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratMasuk as $no => $d)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $d->no_surat }}</td>
                                        <td>{{ date('d/m/Y', strtotime($d->tgl_surat)) }}</td>
                                        <td>{{ $d->pengirim }}</td>
                                        <td>{{ $d->ditujukan }}</td>
                                        <td>
                                            <span class="badge bg-{{ $d->status_disposisi != 'selesai' ? 'danger' : 'primary'}}">{{ strtoupper($d->status_disposisi) }}</span>
                                        </td>
                                        <td><a href="{{ asset("upload/$d->berkas") }}">{{ Str::limit($d->berkas,10, '...') }}</a></td>
                                        <td align="center">
                                            <a data-bs-toggle="modal" data-bs-target="#modal-edit{{$d->id}}" class="btn icon btn-sm btn-primary"><i
                                                    class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin dihapus ?')"
                                                href="{{ route('hapus_surat_masuk', $d->id) }}"
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
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="basicInput">No Surat</label>
                                    <input name="no_surat" type="text" class="form-control" id="basicInput" value="{{ $noSurat }}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input required type="date" name="tgl_surat" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicInput">Pengirim</label>
                                    <input required name="pengirim" type="text" class="form-control"> 
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="basicInput">Perihal</label>
                                    <input name="perihal" type="text" class="form-control"> 
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Sifat Surat</label>
                                    <select name="sifat_surat" class="form-control" id="">
                                        <option value="">- Pilih Sifat -</option>
                                        <option value="Biasa">Biasa</option>
                                        <option value="Penting">Penting</option>
                                        <option value="Sangat Penting">Sangat Penting</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Ditujukan</label>
                                    <input type="text" class="form-control" name="ditujukan">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Berkas</label>
                                    <input type="file" class="form-control" name="berkas">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Petugas</label>
                                    <input type="text" class="form-control" name="petugas">
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
    @foreach ($suratMasuk as $d)
        <div class="modal fade text-left" id="modal-edit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <form action="{{ route('edit_surat_masuk') }}" method="post">
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
                            <input type="hidden" name="id_surat_masuk" value="{{ $d->id }}">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="basicInput">No Surat</label>
                                        <input name="no_surat" type="text" class="form-control" id="basicInput" value="{{ $d->no_surat }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input value="{{ $d->tgl_surat }}" required type="date" name="tgl_surat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="basicInput">Pengirim</label>
                                        <input value="{{ $d->pengirim }}" required name="pengirim" type="text" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="basicInput">Perihal</label>
                                        <input value="{{ $d->perihal }}" name="perihal" type="text" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Sifat Surat</label>
                                        <select name="sifat_surat" class="form-control" id="">
                                            <option value="">- Pilih Sifat -</option>
                                            <option {{ $d->sifat_surat == 'Biasa' ? 'selected' : '' }} value="Biasa">Biasa</option>
                                            <option {{ $d->sifat_surat == 'Penting' ? 'selected' : '' }} value="Penting">Penting</option>
                                            <option {{ $d->sifat_surat == 'Sangat Penting' ? 'selected' : '' }} value="Sangat Penting">Sangat Penting</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Ditujukan</label>
                                        <input value="{{ $d->ditujukan }}" type="text" class="form-control" name="ditujukan">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Berkas</label>
                                        <select name="berkas" class="form-control" id="">
                                            <option value="">- Pilih Berkas -</option>
                                            <option {{ $d->berkas == 'Pdf' ? 'selected' : '' }} value="Pdf">Pdf</option>
                                            <option {{ $d->berkas == 'Kertas' ? 'selected' : '' }} value="Kertas">Kertas</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Petugas</label>
                                        <input value="{{ $d->petugas }}" type="text" class="form-control" name="petugas">
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
@endsection
