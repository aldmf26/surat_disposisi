<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Dotenv\Validator;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    
    public function index()
    {
        $suratMasuk = SuratMasuk::all();
        $lastNoSurat = SuratMasuk::latest()->first();
       
        $data = [
            'title' => 'Surat Masuk',
            'suratMasuk' => $suratMasuk,
            'noSurat' => !empty($lastNoSurat) ? $lastNoSurat->no_surat+1 : 1001,
        ];
        
        return view('surat_masuk.surat_masuk', $data);
    }

    public function store(Request $r)
    {
        $file = $r->file('berkas');
        $fileDiterima = ['pdf', 'jpg', 'png', 'jpeg'];
        $cek = in_array($file->getClientOriginalExtension(), $fileDiterima);
        if($cek) {
            $file->move('upload', $file->getClientOriginalName());
            $data = [
                'no_surat' => $r->no_surat,
                'tgl_surat' => $r->tgl_surat,
                'pengirim' => $r->pengirim,
                'perihal' => $r->perihal,
                'sifat_surat' => $r->sifat_surat,
                'ditujukan' => $r->ditujukan,
                'berkas' => $file->getClientOriginalName(),
                'petugas' => $r->petugas,
                'status_disposisi' => 'Belum',
            ];
            SuratMasuk::create($data);
            return redirect()->route('surat_masuk')->with('sukses', 'Tambah surat masuk berhasil');
        } else {
            return redirect()->route('surat_masuk')->with('error', 'File tidak didukung');
        }
        
    }

    public function update(Request $r)
    {
        SuratMasuk::find($r->id_surat_masuk)->update([
            'tgl_surat' => $r->tgl_surat,
            'pengirim' => $r->pengirim,
            'perihal' => $r->perihal,
            'sifat_surat' => $r->sifat_surat,
            'ditujukan' => $r->ditujukan,
            'petugas' => $r->petugas,
        ]);
        return redirect()->route('surat_masuk')->with('sukses', 'Berhasil edit surat masuk');
    }

    public function destroy($id)
    {
        SuratMasuk::find($id)->delete();
        return redirect()->route('surat_masuk')->with('sukses', 'Berhasil hapus surat masuk');
    }
}
