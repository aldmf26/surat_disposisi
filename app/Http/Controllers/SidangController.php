<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SidangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Sidang',
            'datas' => DB::table('tb_sidang as a')
                ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
                ->join('tb_hakim as c', 'a.id_hakim', 'c.id_hakim')
                ->where('b.status', 'Putusan')
                ->get(),
            'perkara' => DB::table('tb_perkara')->where('status', 'Putusan')->get(),
            'hakim' => DB::table('tb_hakim')->get()
        ];
        return view('sidang.sidang', $data);
    }
    
    public function store(Request $r)
    {
        DB::table('tb_sidang')->insert([
            'id_perkara' => $r->id_perkara,
            'tgl_sidang' => $r->tgl,
            'id_hakim' => $r->id_hakim,
            'ket' => $r->ket,
            'jam' => $r->jam,
            'admin' => auth()->user()->name
        ]);
        return redirect()->route('sidang.index')->with('sukses', 'Berhasil tambah sidang');
    }

    public function update(Request $r)
    {
        DB::table('tb_sidang')->where('id_sidang', $r->id)->update([
            'id_perkara' => $r->id_perkara,
            'tgl_sidang' => $r->tgl,
            'id_hakim' => $r->id_hakim,
            'ket' => $r->ket,
            'admin' => auth()->user()->name
        ]);
        return redirect()->route('sidang.index')->with('sukses', 'Berhasil ubah sidang');
    }

    public function destroy($id)
    {
        DB::table('tb_sidang')->where('id_sidang', $id)->delete();
        return redirect()->route('sidang.index')->with('sukses', 'Berhasil hapus sidang');
    }
}
