

@php

    function tgl_indo($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $pecahkan = explode('-', $tanggal);
    
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
    
        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
@endphp
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<style>
    @charset "utf-8";
    /* CSS Document */

    #logo {
        height: 120px;
        margin-bottom: 50px;
        width: 100%;
        border-top-style: none;
        border-right-style: none;
        border-bottom-style: none;
        border-left-style: none;
    }

    #title {
        font-weight: bold;
        text-transform: capitalize;
        color: #000;

        margin-bottom: 4px;
        font-size: 12pt;
        text-decoration: none;
        text-align: center;
    }

    #title-tanggal {
        float: none;
        font-weight: bold;
        text-transform: capitalize;
        color: #000;
        margin-bottom: 10px;
        font-size: 10pt;
        text-decoration: none;
        text-align: center;
    }

    #isi {
        font-size: 9pt;
    }

    #isi-table {
        padding: 0 0 0 3px;
    }

    .table .tr-title {
        font-size: 9pt;
        font-weight: bold;
        color: #000;
        background-color: rgb(204, 204, 204);
    }

    #footer-tanggal {
        color: #000;
        margin-top: 40px;
        margin-left: 810px;
        font-size: 10pt;
    }

    #footer-jabatan {
        color: #000;
        font-size: 10pt;
        margin-left: 810px;
        margin-bottom: 70px;
    }

    #footer-nama {
        color: #000;
        font-size: 10pt;
        margin-left: 810px;
        text-decoration: underline;
        font-weight: bold;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        color: #000;
        text-align: center;
    }
</style>

<body>
    <div class="container">
        <p>
            <img style="float: left; max-width: 100%;" src="https://th.bing.com/th/id/OIP.UV9JSyZyhuo57yNIJMd6ZQHaJm?w=134&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7" alt=""
                width="90" height="90">
        </p>
        <div id="title" style="font-size: 30px;">
            PENGADILAN NEGERI BANJARMASIN
        </div>
        <p style="margin-top: 2px;" align="center"><i>Jalan Mayjend Jl. D. I. Panjaitan No.27 70114
                <br>Banjarmasin
                Prov.
                Kalimantan Selatan. HP : +62 511 3352859</i></p>
        <hr><br>
        <div id="title">
            {{ $title }}
        </div>
    </div>
    <br>
    <div id="isi">
        @yield('content')
        <div id="footer-tanggal">
            Banjarmasin, {{ tanggal(date('Y-m-d')) }}
        </div>
        <div id="footer-jabatan">
            Ketua Pengadilan
        </div>
        <style>
            .ttd {
                position: absolute;
                margin-left: 860px;
                margin-top: -120px;
            }
        </style>
        {{-- <div class="ttd">
            <img width="500" height="140" src="{{ asset('upload/ttd2.png') }}" alt="">
        </div> --}}
        <div id="footer-nama">
            Rustanto S.H.,M.H
        </div>
    </div>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<script>
    // window.print()
</script>
