@extends('theme.app')
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3 style="text-transform: capitalize">{{ $title }}</h3>
        </div>
        <div class="page-content">
            <form action="{{ route('saveLapMasuk') }}" method="get">
                <div class="row" x-data="{
                    pilih: false
                }">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Pilih Jenis</label>
                            <select name="" id="" x-model="pilih" class="form-control">
                                <option value="false">- Pilih -</option>
                                <option value="pengirim">Pengirim</option>
                                <option value="bulan">Bulan</option>
                                <option value="tahun">Tahun</option>
                            </select>
                        </div>
                    </div>

                    <template x-if="pilih === 'bulan'">
                        <div class="col-lg-3">
                            @php
                                $bulan = [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ];
                                
                                $tahun = [
                                    '1' => '2021',
                                    '2' => '2022',
                                    '3' => '2023',
                                ];
                            @endphp
                            <div class="form-group">
                                <label for="">Bulan</label>
                                <select required name="bulan" id="" class="form-control">
                                    <option value="">- Pilih Bulan -</option>
                                    @foreach ($bulan as $i => $b)
                                        <option value="{{ $i }}">{{ $b }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </template>
                    <template x-if="pilih === 'tahun'">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Tahun</label>
                                <select required name="tahun" id="" class="form-control">
                                    <option value="">- Pilih Tahun -</option>
                                    @for ($i = 1; $i <= 3; $i++)
                                        <option value="{{ "202".$i }}">{{ "202".$i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </template>
                    <template x-if="pilih === 'pengirim'" >
                        <div class="col-lg-3" x-transition>
                            <div class="form-group">
                                <label for="">Pengirim</label>
                                <select required name="pengirim" id="" class="form-control">
                                    <option value="">- Pilih Pengirim -</option>
                                    @foreach ($pengirim as $p)
                                        <option value="{{ $jenis == 1 ? $p->pengirim : $p->suratMasuk->pengirim }}">
                                            {{ $jenis == 1 ? $p->pengirim : $p->suratMasuk->pengirim }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </template>
                    <input type="hidden" name="jenis" value="{{ $jenis }}">
                    <input type="hidden" name="pilih" x-model="pilih">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Aksi</label><br>
                            <button class="btn btn-primary" type="submit">Cetak</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>
@endsection
