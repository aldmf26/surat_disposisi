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
    public function suratMasuk($jenis)
    {
        $data = [
            'title' => $jenis == 1 ? 'Laporan Surat Masuk' : 'Laporan Surat Disposisi',
            'pengirim' => $jenis == 1 ? SuratMasuk::all() : SuratDisposisi::with('suratMasuk', 'jenisSurat')->get(),
            'jenis' => $jenis
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
}
