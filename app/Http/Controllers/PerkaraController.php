<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerkaraController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Perkara',
            'perkara' => DB::table('tb_perkara')->get(),
            'jenis_perkara' => DB::table('tb_jenis_perkara')->get(),
        ];
        return view('perkara.perkara', $data);
    }

    public function store(Request $r)
    {
        DB::table('tb_perkara')->insert([
            'tgl' => $r->tgl,
            'no_perkara' => $r->no_perkara,
            'nm_perkara' => $r->nm_perkara,
            'id_jenis_perkara' => $r->id_jenis_perkara,
            'status' => 'Persidangan',
            'admin' => auth()->user()->name
        ]);
        return redirect()->route('perkara.index')->with('sukses', 'Data Berhasil ditambahkan');
    }

    public function detail($id_perkara)
    {
        $perkara = DB::table('tb_perkara as a')
            ->join('tb_jenis_perkara as b', 'a.id_jenis_perkara', 'b.id_jenis_perkara')
            ->where('a.id_perkara', $id_perkara)->first();

        $sidang = DB::table('tb_sidang as a')
            ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
            ->join('tb_hakim as c', 'a.id_hakim', 'c.id_hakim')
            ->where('a.id_perkara', $id_perkara)
            ->orderBy('a.id_sidang', 'ASC')
            ->get();

        $barang_bukti = DB::table('tb_barang_bukti as a')
            ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
            ->where('a.id_perkara', $id_perkara)->first();

        $biaya = DB::table('tb_biaya as a')
            ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
            ->where('a.id_perkara', $id_perkara)->get();

        $riwayat = DB::table('tb_biaya as a')
            ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
            ->where('a.id_perkara', $id_perkara)->get();

        $data = [
            'id_perkara' => $id_perkara,
            'title' => 'Detail Perkara',
            'perkara' => $perkara,
            'sidang' => $sidang,
            'biaya' => $biaya,
            'barang_bukti' => $barang_bukti
        ];
        return view('perkara.detail', $data);
    }
}
