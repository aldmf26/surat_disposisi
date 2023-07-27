<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BiayaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Biaya',
            'datas' => DB::table('tb_biaya as a')
                ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
                ->get(),
            'perkara' => DB::table('tb_perkara')->where('status', 'Putusan')->get(),
        ];
        return view('biaya.biaya', $data);
    }
    
    public function store(Request $r)
    {
        DB::table('tb_biaya')->insert([
            'id_perkara' => $r->id_perkara,
            'tgl_transaksi' => $r->tgl,
            'uraian' => $r->uraian,
            'nominal' => $r->nominal,
            'admin' => auth()->user()->name
        ]);
        return redirect()->route('biaya.index')->with('sukses', 'Berhasil tambah biaya');
    }

    public function update(Request $r)
    {
        DB::table('tb_biaya')->where('id_biaya', $r->id)->update([
            'id_perkara' => $r->id_perkara,
            'tgl_transaksi' => $r->tgl,
            'uraian' => $r->uraian,
            'nominal' => $r->nominal,
            'admin' => auth()->user()->name
        ]);
        return redirect()->route('biaya.index')->with('sukses', 'Berhasil ubah biaya');
    }

    public function destroy($id)
    {
        DB::table('tb_biaya')->where('id_biaya', $id)->delete();
        return redirect()->route('biaya.index')->with('sukses', 'Berhasil hapus biaya');
    }
}
