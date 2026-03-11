<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Medico;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\EnviarEmail;
use Illuminate\Support\Facades\Mail;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      private function novasAgendas(){
       return Agenda::where('estado', '=','0')->orderBy('id', 'desc')->paginate(3);
    }


public function enviarEmail($dados=null,$destination = null)
{


    Mail::to($destination)->send(new EnviarEmail($dados));


    return 'Email enviado com sucesso!';
}

    public function index()
    {
        //
        $todasAgendas = Agenda::all();
        $query = Agenda::query();
        $agendas = $query->paginate(4);
        $ultimasAtualizacoes = $this->novasAgendas();
        // dd($ultimasAtualizacoes);
        return view('Admin.Agendas.index',compact(['agendas','todasAgendas','ultimasAtualizacoes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $medicos = Medico::all();
        $pacientes = Paciente::all();
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Agendas.add',compact(['medicos','pacientes','ultimasAtualizacoes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Paciente $paciente)
    {
        //

       

            $validatedData = $request->validate([
                'paciente_id'    => 'exists:pacientes,id',
                'descricao'       => 'nullable',
                'prioridade'       => 'nullable',
                // ... outras regras ...
            ]);

        DB::beginTransaction();
        try {
             $dados = $validatedData;
            
            

           $agenda =  Agenda::create($dados);
            DB::commit();
            
            return back()->with(['success'=>'Agenda guardada com sucesso!']);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        //
        $agenda->update(['estado'=>'1']);
         $ultimasAtualizacoes = $this->novasAgendas();

        return view('Admin.Agendas.show',compact(['agenda','ultimasAtualizacoes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        //
        DB::beginTransaction();
        try {

            $agenda->delete();
            DB::commit();
            return back()->with(['success'=>'Dado excluido!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}
