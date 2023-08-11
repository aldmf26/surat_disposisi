@extends('theme.app')
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3 style="text-transform: capitalize">Sistem informasi pengelolaan surat menyurat dan disposisi</h3>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @php
                            $data = [
                                [
                                    'icon' => 'bank',
                                    'judul' => 'data sidang',
                                    'count' => $sd,
                                ],
                                [
                                    'icon' => 'archive',
                                    'judul' => 'data perkara',
                                    'count' => $pr,
                                ],
                                [
                                    'icon' => 'people-fill',
                                    'judul' => 'data pihak pengadilan',
                                    'count' => $ph,
                                ],
                                [
                                    'icon' => 'envelope',
                                    'judul' => 'surat masuk',
                                    'count' => $sm,
                                ],
                                [
                                    'icon' => 'envelope-paper',
                                    'judul' => 'disposisi',
                                    'count' => $sp,
                                ],
                                [
                                    'icon' => 'send',
                                    'judul' => 'surat keluar',
                                    'count' => $sk,
                                ],
                                [
                                    'icon' => 'chat-square-dots',
                                    'judul' => 'jenis surat',
                                    'count' => $js,
                                ],
                                [
                                    'icon' => 'stack',
                                    'judul' => 'divisi',
                                    'count' => $dv,
                                ],
                            ];
                        @endphp
                        @foreach ($data as $d)
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon purple mb-2">
                                                <i class="bi bi-{{$d['icon']}}"
                                                    style="padding-bottom: 40px; padding-right: 25px;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">
                                                {{ ucwords($d['judul']) }}
                                            </h6>
                                            <h6 class="font-extrabold mb-0">{{ $d['count'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
    
                    </div>
                </div>
            </div>
        </div>


        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2023 &copy; Pengadilan Negeri Banjarmasin</p>
                </div>
                <div class="float-end">
                    <p> <span class="text-danger"><i class=" "></i></span> <a href="https://saugi.me">PN Banjarmasin
                            Kelas 1A</a></p>
                </div>
            </div>
        </footer>
    </div>
@endsection
