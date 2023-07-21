<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisPihakontroller extends Controller
{
    protected $tbl;
    public function __construct()
    {
        $this->tbl = DB::table('tb_jenis_pihak');
    }
    public function index()
    {
        $data = [
            'title' => 'Data Jenis Pihak',
            'datas' => $this->tbl->get()
        ];
        return view('jenis_pihak.jenis_pihak',$data);
    }

    public function store(Request $r)
    {
        $this->tbl->insert([
            'nm_jenis' => $r->nm_jenis
        ]);
        return redirect()->route("jenis_pihak.index")->with('sukses', 'Data Berhasil ditambahkan');
    }

    public function update(Request $r)
    {
        $this->tbl->where('id_jenis_pihak', $r->id)->update([
            'nm_jenis' => $r->nm_jenis
        ]);
        return redirect()->route("jenis_pihak.index")->with('sukses', 'Data Berhasil ditambahkan');
    }
  
    public function destroy($id)
    {
        $this->tbl->where('id_jenis_pihak', $id)->delete();
        return redirect()->route("jenis_pihak.index")->with('sukses', 'Data Berhasil ditambahkan');
    }
}
