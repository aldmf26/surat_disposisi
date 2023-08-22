@extends('theme.app')
@section('content')
    <div id="main">
        <div class="page-heading">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: left">{{ $title }}</h3>
                        <a href="{{ route('perkara.index') }}" class="btn btn-primary" style="float: right">
                            <i class="bi bi-arrow-bar-left"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>Nomor Perkara</th>
                                    <th>Penuntut Umum</th>
                                    <th>Terdakwa</th>
                                    <th>Saksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $penggugat = DB::table('tb_pihak')
                                        ->where([['id_perkara', $id_perkara], ['id_jenis_pihak', 1]])
                                        ->first();
                                    $digugat = DB::table('tb_pihak')
                                        ->where([['id_perkara', $id_perkara], ['id_jenis_pihak', 2]])
                                        ->get();
                                    $saksi = DB::table('tb_pihak')
                                        ->where([['id_perkara', $id_perkara], ['id_jenis_pihak', 4]])
                                        ->get();
                                    $status = DB::table('tb_sidang')
                                        ->where('id_perkara', $id_perkara)
                                        ->orderBy('id_sidang', 'DESC')
                                        ->first();
                                @endphp
                                <tr>
                                    <td>{{ $perkara->no_perkara }}</td>
                                    <td>{{ ucwords($penggugat->nama) }}</td>
                                    <td>
                                        @foreach ($digugat as $s)
                                            - {{ ucwords($s->nama) }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($saksi as $s)
                                            - {{ ucwords($s->nama) }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ strtoupper($status->ket ?? '') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- nav --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Data Umum</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Jadwal Sidang</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="false">Barang Bukti</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="biaya-tab" data-bs-toggle="tab" href="#biaya" role="tab"
                                    aria-controls="biaya" aria-selected="false">Biaya</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="riwayat-tab" data-bs-toggle="tab" href="#riwayat" role="tab"
                                    aria-controls="riwayat" aria-selected="false">Riwayat Perkara</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <table class="table mt-2">
                                    <tr>
                                        <td class="bg-info text-white" width="20%">Tanggal Pendaftaran</td>
                                        <td>{{ tanggal($perkara->tgl) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Klasifikasi Perkara</td>
                                        <td>{{ $perkara->nm_jenis }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Nomor Perkara</td>
                                        <td>{{ $perkara->no_perkara }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Perkara</td>
                                        <td>{{ $perkara->nm_perkara }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Penuntut Umum</td>
                                        <td>{{ ucwords($penggugat->nama) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Terdakwa</td>
                                        <td>
                                            @foreach ($digugat as $s)
                                                - {{ ucwords($s->nama) }} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table mt-2">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Sidang</th>
                                            <th>Jam</th>
                                            <th>Agenda</th>
                                            <th>Hakim</th>
                                        </tr>
                                    </thead>
                                    
                                    @foreach ($sidang as $no => $d)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ tanggal($d->tgl_sidang) }}</td>
                                        <td>{{ $d->jam }} s/d Selesai</td>
                                        <td>{{ $d->ket }}</td>
                                        <td>{{ ucwords($d->nm_hakim) }}</td>
                                    </tr>
                                    @endforeach
                                    
                                </table>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <table class="table mt-2">
                                    <tr>
                                        <td class="bg-info text-white" width="20%">Tanggal Penerimaan</td>
                                        <td>{{ tanggal($barang_bukti->tgl_penerimaan) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Uraian Lengkap Barang Bukti</td>
                                        <td>{{ $barang_bukti->uraian_bukti }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Tempat Penyimpanan</td>
                                        <td>{{ $barang_bukti->penyimpanan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Tempat Penyerahan</td>
                                        <td>{{ $barang_bukti->penyerahan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Nama Penerima</td>
                                        <td>{{ ucwords($barang_bukti->nm_penerima) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Catatan</td>
                                        <td>{{ ucwords($barang_bukti->catatan_bb) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="biaya" role="tabpanel" aria-labelledby="contact-tab">
                                <table class="table mt-2">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $totalNominal = 0;
                                    @endphp
                                    <tbody>
                                        @foreach ($biaya as $no => $d)
                                        @php
                                            $totalNominal += $d->nominal;
                                        @endphp
                                        <tr>
                                            <td>{{ $no+1 }}</td>
                                            <td>{{ tanggal($d->tgl_transaksi) }}</td>
                                            <td>{{ $d->uraian }}</td>
                                            <td>{{ number_format($d->nominal, 0) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" align="center"><b>Total</b></td>
                                            <td><b>{{ number_format($totalNominal,0) }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="contact-tab">
                                <table class="table mt-2">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Penetapan</th>
                                            <th>Proses</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ tanggal($perkara->tgl) }}</td>
                                            <td>Pendaftaran</td>
                                            <td>Pendaftaran Perkara</td>
                                        </tr>
                                        @foreach ($sidang as $no => $d)
                                        <tr>
                                            <td>{{ $no+2 }}</td>
                                            <td>{{ tanggal($d->tgl_sidang) }}</td>
                                            <td>Penetapan</td>
                                            <td>{{ $d->ket }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
