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
                                    <th>Nik</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $no => $d)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ $d->nm_hakim }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>{{ $d->no_hp }}</td>
                                        <td align="center">
                                            <a data-bs-toggle="modal" data-bs-target="#modal-edit{{ $d->id_hakim }}"
                                                class="btn icon btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin dihapus ?')"
                                                href="{{ route('hakim.destroy', $d->id_hakim) }}"
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
        <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
            <form action="{{ route('hakim.store') }}" enctype="multipart/form-data" method="post">
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
                            <div class="mb-2 col-lg-6">
                                <div class="form-group">
                                    <label for="">Nik</label>
                                    <input type="text" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <div class="form-group">
                                    <label for="">Nama Hakim</label>
                                    <input type="text" name="nm_hakim" class="form-control">
                                </div>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamat" class="form-control">
                                </div>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <div class="form-group">
                                    <label for="">No Telepon</label>
                                    <input type="text" name="no_hp" class="form-control">
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
    @foreach ($datas as $d)
        <div class="modal fade text-left" id="modal-edit{{$d->id_hakim}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <form action="{{ route('hakim.update') }}" method="post">
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
                            <input type="hidden" name="id"  value="{{ $d->id_hakim }}">
                            <div class="row">
                                <div class="mb-2 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Nik</label>
                                        <input value="{{ $d->nik }}" type="text" name="nik" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-2 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Nama Hakim</label>
                                        <input value="{{ $d->nm_hakim }}" type="text" name="nm_hakim" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-2 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <input value="{{ $d->alamat }}" type="text" name="alamat" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-2 col-lg-6">
                                    <div class="form-group">
                                        <label for="">No Telepon</label>
                                        <input value="{{ $d->no_hp }}" type="text" name="no_hp" class="form-control">
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
