<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Consulta;
use App\Models\Doenca;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function novasAgendas(){
       return Agenda::where('tipo', '=','Externa')->where('estado', '=','0')->orderBy('id', 'desc')->paginate(3);
    }
    public function index(Request $request, $data=null)
    {
        //

        $query = Consulta::query();
        if($data){
            $query->where('data_consulta','=',$data);
        }
        $consultas = $query->paginate(5);
        $todasConsultas = Consulta::with(['paciente','doencas'])->get();
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Consultas.index',compact(['consultas','todasConsultas','ultimasAtualizacoes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pacientes = Paciente::all();
        $doencas = Doenca::all();
        $medicos = Medico::all();
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Consultas.add',compact(['doencas','pacientes','ultimasAtualizacoes','medicos']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $validatedData = $request->validate([
        'paciente_id' => 'required|exists:pacientes,id',
        'doenca' => 'required|array|min:1',             //
        'doenca.*' => 'exists:doencas,id',
        'data_consulta' => 'required|date',
        'nivel' => 'required|string',
        'medico_id' => 'required|exists:medicos,id',
        'observacoes' => 'nullable|string|max:500',     // Observações opcionais
    ],[
        'paciente_id.exists'=>'ID do paciente deve existir na tabela pacientes',
        'doenca.exists'=>'Cada Doença deve existir na tabela de doenças',
        'doenca.min'=>'Deve ter  pelo menos (1) uma doença',

    ]);


     $paciente = Paciente::findOrFail($validatedData['paciente_id']);
     $medico = Medico::findOrFail($validatedData['medico_id']);

    // Criar a consulta
    DB::beginTransaction();
    try {
        //code...
        $consulta = Consulta::create([
        'paciente_id' => $paciente->id,
        'data_consulta' => $validatedData['data_consulta'],
        'nivel' => $validatedData['nivel'],
        'medico_id' => $medico->id,
        'observacoes' => $validatedData['observacoes'] ?? null,
    ]);

    // Associar as doenças à consulta e ao paciente
    foreach ($validatedData['doenca'] as $doencaId) {
        // Relacionar doença com consulta
        $consulta->doencas()->syncWithoutDetaching([$doencaId]);

        // Relacionar doença com paciente
        $paciente->doencas()->syncWithoutDetaching([$doencaId]);
    }
    DB::commit();
    return back()->with(['success'=>'Consulta registrada com sucesso!']);
    } catch (Throwable $th) {
        //throw $th;
        DB::rollBack();
        return back()->withErrors(['error'=>$th->getMessage()]);
    }




    }

    /**
     * Display the specified resource.
     */
    public function show(Consulta $consulta)
    {
        //
          $ultimasAtualizacoes = $this->novasAgendas();
          $proximaAgenda = Agenda::where('paciente_id','=',$consulta->paciente_id)->where('estado','=','0')->first();
        return view('Admin.Consultas.show',compact(['consulta','ultimasAtualizacoes','proximaAgenda']));
    }
    public function estado(Consulta $consulta)
    {
        //
        DB::beginTransaction();
        try {

            $consulta->update(['estado'=>'Atendido']);
            DB::commit();
            return back()->with(['success'=>'Estado actualizado com sucesso!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }

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
    public function destroy(Consulta $consulta)
    {
        //
         DB::beginTransaction();
        try {

            $consulta->delete();
            DB::commit();
            return back()->with(['success'=>'Dado excluido!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}
