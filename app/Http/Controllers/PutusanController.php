<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PutusanController extends Controller
{
    protected $tbl;
    public function __construct()
    {
        $this->tbl = DB::table('tb_putusan');
    }
    public function index()
    {
        $data = [
            'title' => 'Data Putusan',
            'putusan' => DB::table('tb_putusan as a')
                ->select('a.id_putusan','a.id_perkara','b.no_perkara', 'b.nm_perkara', 'a.tgl', 'a.isi')
                ->join('tb_perkara as b', 'a.id_perkara', 'b.id_perkara')
                ->get(),
            'perkara' => DB::table('tb_perkara')->where('status', 'persidangan')->get()
        ];
        return view('putusan.putusan', $data);
    }

    
    public function store(Request $r)
    {
        DB::table('tb_putusan')->insert([
            'id_perkara' => $r->id_perkara,
            'tgl' => $r->tgl,
            'isi' => $r->isi,
            'admin' => auth()->user()->name
        ]);

        DB::table('tb_perkara')->where('id_perkara', $r->id_perkara)->update(['status' => 'Putusan']);
        return redirect()->route('putusan.index')->with('sukses', 'Berhasil tambah putusan');
    }

    public function update(Request $r)
    {
        DB::table('tb_putusan')->where('id_putusan', $r->id)->update([
            'tgl' => $r->tgl,
            'isi' => $r->isi,
            'admin' => auth()->user()->name
        ]);
        return redirect()->route('putusan.index')->with('sukses', 'Berhasil ubah putusan');
    }

    public function destroy($id)
    {
        $q = DB::table('tb_putusan')->where('id_putusan', $id);
        $id_perkara = $q->first()->id_perkara;
        DB::table('tb_perkara')->where('id_perkara', $id_perkara)->update(['status' => 'Persidangan']);
        $q->delete();
        return redirect()->route('putusan.index')->with('sukses', 'Berhasil hapus putusan');
    }
}
