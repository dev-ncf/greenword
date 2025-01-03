<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Medico;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      private function novasAgendas(){
       return Agenda::where('tipo', '=','Externa')->where('estado', '=','0')->orderBy('id', 'desc')->paginate(3);
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
    public function store(Request $request,$tipo)
    {
        //

        if($tipo=='Interna'){

            $validatedData = $request->validate([
                'paciente_id'    => 'required',
                'medico_id'       => 'required',
                'data'       => 'required',
                'hora'       => 'required',
                // ... outras regras ...
            ]);
        }
        if($tipo=='Externa'){

            $validatedData = $request->validate([
                'paciente'    => 'required',
                'medico_id'       => 'required',
                'data'       => 'required',
                'hora'       => 'required',
                // ... outras regras ...
            ]);
        }

        DB::beginTransaction();
        try {
             $dados = $request->all();
            if($tipo=='Interna'){

                $paciente = Paciente::findOrFail($validatedData['paciente_id']);
                 $dados['paciente']=$paciente->nome.' '.$paciente->apelido;
                 $dados['contacto']=$paciente->contacto;
                 $dados['tipo']='Interna';
                 $dados['estado']='1';
            }
            if($tipo=='Externa'){
                 $paciente = Paciente::where('nome','like','%'.$dados['paciente'].'%')->where('apelido','like','%'.$dados['paciente'].'%')->first();
                //  dd($paciente);
                 if($paciente){
                    $dados['paciente_id']=$paciente->id;
                    $dados['paciente']=$paciente->nome.''.$paciente->apelido;

                 }
                   $dataFormatada = Carbon::createFromFormat('m/d/Y', $validatedData['data'])->format('Y-m-d');
                   $horaFormatada  = Carbon::createFromFormat('h:i A', $validatedData['hora'])->format('H:i:s');
                 $dados['data']=$dataFormatada;
                 $dados['hora']=$horaFormatada;
                 $dados['tipo']='Externa';
                 $dados['estado']='0';
            }

            Agenda::create($dados);
            DB::commit();
            return back()->with(['success'=>'Agenda guardada com sucesso! A recepcionista entrará em contacto em breve, aguarde porfavor!']);

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
