<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PihakController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Data Pihak',
            'pihak' => DB::table('tb_pihak as a')
                        ->join('tb_jenis_pihak as b', 'a.id_jenis_pihak', 'b.id_jenis_pihak')
                        ->join('tb_perkara as c', 'a.id_perkara', 'c.id_perkara')
                        ->orderBy('a.id_pihak', 'DESC')
                        ->get(),
            'perkara' => DB::table('tb_perkara')->get(),
            'jenis_pihak' => DB::table('tb_jenis_pihak')->get()
        ];
        return view('pihak.pihak',$data);
    }

    public function store(Request $r)
    {
        DB::table('tb_pihak')->insert([
            'id_perkara' => $r->id_perkara,
            'nama' => $r->nama,
            'alamat' => $r->alamat,
            'id_jenis_pihak' => $r->id_jenis_pihak,
            'nik' => $r->nik,
            'admin' => auth()->user()->name,
        ]);
        return redirect()->route('pihak.index')->with('sukses', 'Data Berhasil ditambahkan');
    }
    public function update(Request $r)
    {
        DB::table('tb_pihak')->where('id_pihak', $r->id)->update([
            'id_perkara' => $r->id_perkara,
            'nama' => $r->nama,
            'alamat' => $r->alamat,
            'id_jenis_pihak' => $r->id_jenis_pihak,
            'nik' => $r->nik,
            'admin' => auth()->user()->name,
        ]);
        return redirect()->route('pihak.index')->with('sukses', 'Data Berhasil diedit');
    }
    public function destroy($id)
    {
        DB::table('tb_pihak')->where('id_pihak', $id)->delete();
        return redirect()->route('pihak.index')->with('sukses', 'Data Berhasil dihapus');
    }
}
