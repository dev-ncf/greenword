<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Consulta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
       $consultas = Consulta::paginate(5);
        $ultimasAtualizacoes = Agenda::where('tipo', '=','Externa')->where('estado', '=','0')->orderBy('id', 'desc')->paginate(3);

        // dd($agendas);
        return view('Admin.index',compact(['consultas','ultimasAtualizacoes']));
    }
    public function sobre()
    {
        $consultas = Consulta::paginate(5);
        return view('Home.about',compact(['consultas']));
    }
    public function medicos()
    {
        $consultas = Consulta::paginate(5);
        return view('Home.medicos',compact(['consultas']));
    }
    public function servicos()
    {
        $consultas = Consulta::paginate(5);
        return view('Home.servicos',compact(['consultas']));
    }
    public function recursos()
    {
        $consultas = Consulta::paginate(5);
        return view('Home.recursos',compact(['consultas']));
    }
    public function agendar()
    {
        $consultas = Consulta::paginate(5);
        return view('Home.agendar',compact(['consultas']));
    }
    public function contactar()
    {
        $consultas = Consulta::paginate(5);
        return view('Home.contact',compact(['consultas']));
    }
}
