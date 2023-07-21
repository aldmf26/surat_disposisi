<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisPerkaraController extends Controller
{
    protected $tbl;
    public function __construct()
    {
        $this->tbl = DB::table('tb_jenis_perkara');
    }
    public function index()
    {
        $data = [
            'title' => 'Data Jenis Perkara',
            'datas' => $this->tbl->get()
        ];
        return view('jenis_perkara.jenis_perkara',$data);
    }

    public function store(Request $r)
    {
        $this->tbl->insert([
            'nm_jenis' => $r->nm_jenis
        ]);
        return redirect()->route("jenis_perkara.index")->with('sukses', 'Data Berhasil ditambahkan');
    }

    public function update(Request $r)
    {
        $this->tbl->where('id_jenis_perkara', $r->id)->update([
            'nm_jenis' => $r->nm_jenis
        ]);
        return redirect()->route("jenis_perkara.index")->with('sukses', 'Data Berhasil ditambahkan');
    }
  
    public function destroy($id)
    {
        $this->tbl->where('id_jenis_perkara', $id)->delete();
        return redirect()->route("jenis_perkara.index")->with('sukses', 'Data Berhasil ditambahkan');
    }
}
