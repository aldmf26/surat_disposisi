<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\JenisSurat;
use App\Models\SuratDisposisi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function suratMasuk($jenis, Request $r)
    {

        $data = [
            'title' => $jenis == 1 ? 'Laporan Surat Masuk' : 'Laporan Surat Disposisi',
            'pengirim' => $jenis == 1 ? SuratMasuk::all() : SuratDisposisi::with('suratMasuk', 'jenisSurat')->get(),
            'jenis' => $jenis,
        ];
        return view('laporan.surat_masuk.view',$data);
    }

    public function saveLapMasuk(Request $r)
    {
        
        $pengirim = $r->pengirim;
        $bulan = $r->bulan;
        $tahun = $r->tahun;
        if(!empty($pengirim)) {
            $suratMasuk = SuratMasuk::where('pengirim', $pengirim)->orderBy('no_surat', 'ASC')->get();
            $suratDisposisi = DB::table('surat_disposisis as a')->join('surat_masuk as b', 'a.id_sm', 'b.id')->join('jenis_surats as c', 'a.id_js', 'c.id')->where('b.pengirim', $pengirim)->orderBy('a.no_surat', 'ASC')->get();
        }
        if(!empty($bulan)) {
            $suratMasuk = SuratMasuk::whereMonth('tgl_surat', date($bulan))->orderBy('no_surat', 'ASC')->get();
            $suratDisposisi = DB::table('surat_disposisis as a')->join('surat_masuk as b', 'a.id_sm', 'b.id')->join('jenis_surats as c', 'a.id_js', 'c.id')->whereMonth('a.tgl_disposisi', date($bulan))->orderBy('a.no_surat', 'ASC')->get();
        }
        if(!empty($tahun)) {
            $suratMasuk = SuratMasuk::whereYear('tgl_surat', date($tahun))->orderBy('no_surat', 'ASC')->get();
            $suratDisposisi = DB::table('surat_disposisis as a')->join('surat_masuk as b', 'a.id_sm', 'b.id')->join('jenis_surats as c', 'a.id_js', 'c.id')->whereYear('a.tgl_disposisi', date($tahun))->orderBy('a.no_surat', 'ASC')->get();
        }
        $data = [
            'query' => $r->jenis == 1 ? $suratMasuk : $suratDisposisi,
            'jenis' => $r->jenis,
            'tgl1' => $r->tgl1,
            'tgl2' => $r->tgl2,
            'filter' => $r->pilih,
            'title' => $r->jenis == 1 ? 'Laporan Surat Masuk' : 'Laporan Surat Disposisi',
        ];

        return view('laporan.surat_masuk.print',$data);

    }

    public function suratKeluar()
    {
        $data = [
            'title' => "Laporan Surat Keluar",
            'datas' => SuratKeluar::all(),
            'divisi' => Divisi::all(),
        ];
        return view('laporan.surat_keluar.view',$data);
    }

    public function saveLapKeluar(Request $r)
    {
        $divisi = $r->divisi;
        $bulan = $r->bulan;
        $tahun = $r->tahun;
        if(!empty($divisi)) {
            $suratMasuk = DB::table('surat_keluar as a')->join('divisis as b', 'a.divisi_id', 'b.id')->where('b.kd_divisi', $divisi)->get();

        }
        if(!empty($bulan)) {
            $suratMasuk = DB::table('surat_keluar as a')->join('divisis as b', 'a.divisi_id', 'b.id')->whereMonth('a.tgl_surat', date($bulan))->get();

        }
        if(!empty($tahun)) {
            $suratMasuk = DB::table('surat_keluar as a')->join('divisis as b', 'a.divisi_id', 'b.id')->whereYear('a.tgl_surat', date($tahun))->get();

        }

        $data = [
            'query' => $suratMasuk,
            'tgl1' => $r->tgl1,
            'tgl2' => $r->tgl2,
            'filter' => $r->pilih,
            'title' => 'Laporan Surat Keluar'
        ];
        return view('laporan.surat_keluar.print',$data);
    }

    public function jenisSurat()
    {
        $data = [
            'title' => "Laporan Jenis Surat",
            'datas' => JenisSurat::all()
        ];
        return view('laporan.jenis_surat.view',$data);
    }

    public function saveLapJenisSurat(Request $r)
    {
        $data = [
            'query' => JenisSurat::whereBetween('kd_js', [$r->kode1, $r->kode2])->get(),
            'title' => 'Laporan Jenis Surat',
            'filter' => "$r->kode1 ~ $r->kode2",
        ];
        return view('laporan.jenis_surat.print',$data);
    }

    public function divisi()
    {
        $data = [
            'title' => "Laporan Divisi Surat",
            'datas' => Divisi::all()
        ];
        return view('laporan.divisi.view',$data);
    }

    public function saveLapDivisi(Request $r)
    {
        $data = [
            'query' => Divisi::all(),
            'title' => 'Laporan Divisi Surat'
        ];
        return view('laporan.divisi.print',$data);
    }

    // pengadilan
    public function perkara()
    {
        $data = [
            'title' => "Laporan Perkara",
            'datas' => DB::table('tb_perkara')->get(),
            'jenis_perkara' => DB::table('tb_jenis_perkara')->get()
        ];
        return view('laporan.perkara.view',$data);
    }
    public function save_perkara(Request $r)
    {
        $perkara = DB::table('tb_jenis_perkara')->where('id_jenis_perkara', $r->id_jenis_perkara)->first()->nm_jenis;
        $data = [
            'perkara' => DB::table('tb_perkara')->where('id_jenis_perkara', $r->id_jenis_perkara)->whereBetween('tgl', [$r->tgl1, $r->tgl2])->get(),
            'title' => "Laporan Perkara $perkara",
        ];
        return view('laporan.perkara.print',$data);
    }

    public function pihak()
    {
        $data = [
            'title' => "Laporan Pihak",
            'datas' => DB::table('tb_pihak')->get(),
            'perkara' => DB::table('tb_perkara')->get()
        ];
        return view('laporan.pihak.view',$data);
    }
    public function save_pihak(Request $r)
    {
        $data = [
            'pihak' => DB::table('tb_pihak as a')
                        ->join('tb_jenis_pihak as b', 'a.id_jenis_pihak', 'b.id_jenis_pihak')
                        ->join('tb_perkara as c', 'a.id_perkara', 'c.id_perkara')
                        ->where('a.id_perkara', $r->id_perkara)
                        ->orderBy('a.id_pihak', 'DESC')
                        ->get(),
            'title' => "Laporan Pihak",
        ];
        return view('laporan.pihak.print',$data);
    }

    public function barang_bukti()
    {
        $data = [
            'title' => "Laporan Barang Bukti",
            'datas' => DB::table('tb_barang_bukti')->get(),
            'perkara' => DB::table('tb_perkara')->get()
        ];
        return view('laporan.barang_bukti.view',$data);
    }
    public function save_barang_bukti(Request $r)
    {
        $data = [
            'datas' => DB::table('tb_barang_bukti as a')
                ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
                ->whereBetween('a.tgl_penerimaan', [$r->tgl1, $r->tgl2])
                ->get(),
            'title' => "Laporan Barang Bukti",
        ];
        return view('laporan.barang_bukti.print',$data);
    }

    public function sidang()
    {
        $data = [
            'title' => "Laporan Sidang",
            'datas' => DB::table('tb_sidang')->get(),
            'perkara' => DB::table('tb_perkara')->get(),
            'hakim' => DB::table('tb_hakim')->get()
        ];
        return view('laporan.sidang.view',$data);
    }
    public function save_sidang(Request $r)
    {
        $hakim = DB::table('tb_hakim')->where('id_hakim', $r->id_hakim)->first()->nm_hakim;
        $data = [
            'datas' => DB::table('tb_sidang as a')
                ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
                ->join('tb_hakim as c', 'a.id_hakim', 'c.id_hakim')
                ->where('a.id_hakim', $r->id_hakim)
                ->whereBetween('a.tgl_sidang', [$r->tgl1, $r->tgl2])
                ->get(),
            'title' => "Laporan Sidang Hakim : $hakim",
        ];
        return view('laporan.sidang.print',$data);
    }
    public function hakim()
    {
        $data = [
            'title' => "Laporan Hakim",
            'datas' => DB::table('tb_hakim as a')->get(),
        ];
        return view('laporan.hakim.view',$data);
    }
    public function save_hakim(Request $r)
    {
        $data = [
            'datas' => DB::table('tb_hakim as a')->get(),
            'title' => "Laporan Hakim",
        ];
        return view('laporan.hakim.print',$data);
    }
    public function biaya()
    {
        $data = [
            'title' => "Laporan Biaya",
            'datas' => DB::table('tb_biaya as a')
                ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
                ->get(),
            'perkara' => DB::table('tb_perkara')->get()

        ];
        return view('laporan.biaya.view',$data);
    }
    public function save_biaya(Request $r)
    {
        $data = [
            'datas' => DB::table('tb_biaya as a')
                ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
                ->where('a.id_perkara', $r->id_perkara)
                ->get(),
            'title' => "Laporan Biaya",
        ];
        return view('laporan.biaya.print',$data);
    }
}
