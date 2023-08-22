<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangBuktiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Barang Bukti',
            'datas' => DB::table('tb_barang_bukti as a')
                ->select('a.catatan as catatan_bb', 'a.*', 'b.*')
                ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
                ->get(),
            'perkara' => DB::table('tb_perkara')->where('status', 'persidangan')->get()
        ];
        return view('barang_bukti.barang_bukti', $data);
    }

    
    public function store(Request $r)
    {
        $cek = DB::table('tb_barang_bukti')->where('id_perkara', $r->id_perkara)->count();
        if($cek > 0) {
        return redirect()->route('barang_bukti.index')->with('error', 'BARANG BUKTI SUDAH ADA, MOHON EDIT !!');
        } else {
            DB::table('tb_barang_bukti')->insert([
                'id_perkara' => $r->id_perkara,
                'tgl_penerimaan' => $r->tgl,
                'uraian_bukti' => $r->uraian_bukti,
                'penyimpanan' => $r->penyimpanan,
                'penyerahan' => $r->penyerahan,
                'nm_penerima' => $r->nm_penerima,
                'catatan' => $r->catatan,
                'admin' => auth()->user()->name
            ]);
            return redirect()->route('barang_bukti.index')->with('sukses', 'Berhasil tambah barang_bukti');
        }
    }

    public function update(Request $r)
    {
        DB::table('tb_barang_bukti')->where('id_barang_bukti', $r->id)->update([
            'tgl_penerimaan' => $r->tgl,
            'uraian_bukti' => $r->uraian_bukti,
            'penyimpanan' => $r->penyimpanan,
            'penyerahan' => $r->penyerahan,
            'nm_penerima' => $r->nm_penerima,
            'catatan' => $r->catatan,
            'admin' => auth()->user()->name
        ]);
        return redirect()->route('barang_bukti.index')->with('sukses', 'Berhasil ubah barang_bukti');
    }

    public function destroy($id)
    {
        DB::table('tb_barang_bukti')->where('id_barang_bukti', $id)->delete();
        return redirect()->route('barang_bukti.index')->with('sukses', 'Berhasil hapus barang_bukti');
    }
}
