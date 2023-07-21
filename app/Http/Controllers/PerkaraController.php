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
            'perkara' => DB::table('tb_perkara')->get()
        ];
        return view('perkara.perkara',$data);
    }
}
