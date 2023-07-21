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
        return view('perkara.perkara',$data);
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
}
