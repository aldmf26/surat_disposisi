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
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jenis Pihak</th>
                                    <th>Perkara</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pihak as $no => $d)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ ucwords($d->nama) }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>{{ $d->nm_jenis }}</td>
                                        <td>{{ $d->nm_perkara }}</td>
                                        <td align="center">
                                            <a data-bs-toggle="modal" data-bs-target="#modal-edit{{$d->id_pihak}}" class="btn icon btn-sm btn-primary"><i
                                                    class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin dihapus ?')"
                                                href="{{ route('pihak.destroy', $d->id_pihak) }}"
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
            <form action="{{ route('pihak.store') }}" enctype="multipart/form-data" method="post">
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
                            <div class="col-lg-4">
                                <label for="">Perkara</label>
                                <select name="id_perkara" class="form-control select2" id="">
                                    <option value="">- Pilih Perkara -</option>
                                    @foreach ($perkara as $p)
                                        <option value="{{ $p->id_perkara }}">{{ $p->nm_perkara }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Nik</label>
                                    <input type="text" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamat" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <label for="">Jenis Pihak</label>
                                <select name="id_jenis_pihak" class="form-control select2" id="">
                                    <option value="">- Pilih Jenis -</option>
                                    @foreach ($jenis_pihak as $j)
                                        <option value="{{ $j->id_jenis_pihak }}">{{ $j->nm_jenis }}</option>
                                    @endforeach
                                </select>
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
    @foreach ($pihak as $d)
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
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Perkara</label>
                                    <select name="id_perkara" class="form-control select2" id="">
                                        <option value="">- Pilih Perkara -</option>
                                        @foreach ($perkara as $p)
                                            <option {{$p->id_perkara == $d->id_perkara ? 'selected' : ''}} value="{{ $p->id_perkara }}">{{ $p->nm_perkara }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Nik</label>
                                        <input type="text" value="{{ $d->nik }}" name="nik" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" value="{{ $d->nama }}" name="nama" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <input type="text" value="{{ $d->alamat }}" name="alamat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <label for="">Jenis Pihak</label>
                                    <select name="id_jenis_pihak" class="form-control select2" id="">
                                        <option value="">- Pilih Jenis -</option>
                                        @foreach ($jenis_pihak as $j)
                                            <option {{$j->id_jenis_pihak == $d->id_jenis_pihak ? 'selected' : ''}} value="{{ $j->id_jenis_pihak }}">{{ $j->nm_jenis }}</option>
                                        @endforeach
                                    </select>
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
