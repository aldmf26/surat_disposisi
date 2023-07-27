<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HakimController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Hakim',
            'datas' => DB::table('tb_hakim as a')
                ->get(),
        ];
        return view('hakim.hakim', $data);
    }

    
    public function store(Request $r)
    {
        DB::table('tb_hakim')->insert([
            'nm_hakim' => $r->nm_hakim,
            'nik' => $r->nik,
            'alamat' => $r->alamat,
            'no_hp' => $r->no_hp,
        ]);
        return redirect()->route('hakim.index')->with('sukses', 'Berhasil tambah hakim');
    }

    public function update(Request $r)
    {
        DB::table('tb_hakim')->where('id_hakim', $r->id)->update([
            'nm_hakim' => $r->nm_hakim,
            'nik' => $r->nik,
            'alamat' => $r->alamat,
            'no_hp' => $r->no_hp,
        ]);
        return redirect()->route('hakim.index')->with('sukses', 'Berhasil ubah hakim');
    }

    public function destroy($id)
    {
        DB::table('tb_hakim')->where('id_hakim', $id)->delete();
        return redirect()->route('hakim.index')->with('sukses', 'Berhasil hapus hakim');
    }
}
