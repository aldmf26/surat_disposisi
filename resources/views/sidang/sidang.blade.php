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
                                    <th>Nama Perkara</th>
                                    <th>Tanggal</th>
                                    <th>Hakim</th>
                                    <th>Ket</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $no => $d)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $d->no_perkara }}</td>
                                        <td>{{ $d->nm_perkara }}</td>
                                        <td>{{ tanggal($d->tgl) }}</td>
                                        <td>{{ $d->nm_hakim }}</td>
                                        <td>{{ $d->ket }}</td>
                                        <td align="center">
                                            <a data-bs-toggle="modal" data-bs-target="#modal-edit{{ $d->id_sidang }}"
                                                class="btn icon btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a onclick="return confirm('Yakin dihapus ?')"
                                                href="{{ route('sidang.destroy', $d->id_sidang) }}"
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
            <form action="{{ route('sidang.store') }}" enctype="multipart/form-data" method="post">
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
                            <div class="mb-2 col-lg-12">
                                <div class="fomr-group">
                                    <label for="">Perkara</label>
                                    <select name="id_perkara" class="form-control select2" id="">
                                        <option value="">- Pilih Perkara -</option>
                                        @foreach ($perkara as $p)
                                            <option value="{{ $p->id_perkara }}">{{ $p->no_perkara }} ~
                                                {{ ucwords($p->nm_perkara) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-lg-12">
                                <div class="fomr-group">
                                    <label for="">Hakim</label>
                                    <select name="id_hakim" class="form-control select2" id="">
                                        <option value="">- Pilih Hakim -</option>
                                        @foreach ($hakim as $p)
                                            <option value="{{ $p->id_hakim }}">
                                                {{ ucwords($p->nm_hakim) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="tgl" value="{{ date('Y-m-d') }}" class="form-control">
                                </div>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <div class="form-group">
                                    <label for="">Jam</label>
                                    <input type="time" name="jam" class="form-control">
                                </div>
                            </div>
                            <div class="mb-2 col-lg-12">
                                <label for="">Agenda</label>
                                <textarea name="ket" id="" cols="5" rows="2" class="form-control"></textarea>
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
        <div class="modal fade text-left" id="modal-edit{{$d->id_sidang}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <form action="{{ route('sidang.update') }}" method="post">
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
                            <input type="hidden" name="id"  value="{{ $d->id_sidang }}">
                            <div class="row">
                                <div class="mb-2 col-lg-12">
                                    <div class="fomr-group">
                                        <label for="">Perkara</label>
                                        <select name="id_perkara" class="form-control select2" id="">
                                            <option value="">- Pilih Perkara -</option>
                                            @foreach ($perkara as $p)
                                                <option {{$d->id_perkara == $p->id_perkara ? 'selected' : ''}} value="{{ $p->id_perkara }}">{{ $p->no_perkara }} ~
                                                    {{ ucwords($p->nm_perkara) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-lg-12">
                                    <div class="fomr-group">
                                        <label for="">Hakim</label>
                                        <select name="id_hakim" class="form-control select2" id="">
                                            <option value="">- Pilih Hakim -</option>
                                            @foreach ($hakim as $p)
                                                <option {{$d->id_hakim == $p->id_hakim ? 'selected' : ''}} value="{{ $p->id_hakim }}">
                                                    {{ ucwords($p->nm_hakim) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input type="date" name="tgl" value="{{ $d->tgl_sidang }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-2 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Jam</label>
                                        <input value="{{ $d->jam }}" type="time" name="jam" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-2 col-lg-12">
                                    <label for="">Agenda</label>
                                    <textarea name="ket" id="" cols="5" rows="2" class="form-control">{{ $d->ket }}</textarea>
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
