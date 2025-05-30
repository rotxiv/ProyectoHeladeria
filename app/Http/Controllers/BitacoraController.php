<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;

class BitacoraController extends Controller
{
    public function panel()
    {
        return view('controlador.bitacora.panel');
    }
    public function index()
    {
        $bitacoras = Bitacora::with('user')->latest('logged_in_at')->get();

        return view('controlador.bitacora.index', compact('bitacoras'));
    }
}