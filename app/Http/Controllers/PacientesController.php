<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Doenca;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function novasAgendas(){
      return Agenda::where('tipo', '=','Externa')->where('estado', '=','0')->orderBy('id', 'desc')->paginate(3);
    }

    public function index(Request $request)
    {

        $query = Paciente::query();
        $search = $request->search;

        if($search){
            $query->where('nome','like','%'.$search.'%')->orWhere('contacto','like','%'.$search.'%');
        }
         $pacientes=$query->paginate(5);
         $todosPacientes = Paciente::with('doencas')->get();
         $doencas = Doenca::all();
         $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Pacientes.index',compact(['pacientes','todosPacientes','doencas','ultimasAtualizacoes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Pacientes.add',compact(['ultimasAtualizacoes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nome' => 'required|string|min:3|max:50',
            'apelido' => 'required|string|min:3|max:50',
            'data_nascimento' => 'required|date|before:today',
            'genero' => 'required|in:M,F',
            'contacto' => 'required|regex:/^8[2-7][0-9]{7}$/',

        ],[
            'nome.required' => 'O nome é obrigatório.',
            'apelido.required' => 'O apelido é obrigatório.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.before' => 'A data de nascimento deve ser anterior a hoje.',
            'genero.in' => 'O género deve ser Masculino ou Feminino .',
            'contacto.regex' => 'O contacto deve estar no formato válido, como 8XXXXXXX.',
        ]);
    DB::beginTransaction();
        try {

        Paciente::create($request->all());
        DB::commit();
        return back()->with(['success'=>'Cadastro feito com sucesso!']);

        } catch (Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
        $ultimasAtualizacoes = $this->novasAgendas();
        $proximaAgenda = Agenda::where('paciente_id','=',$paciente->id)->where('data','>',date('Y-m-d'))->first();
        return view('Admin.Pacientes.show',compact(['paciente','ultimasAtualizacoes','proximaAgenda']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        //
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Pacientes.edit',compact(['paciente','ultimasAtualizacoes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        //
        $request->validate([
            'nome' => 'required|string|min:3|max:50',
            'apelido' => 'required|string|min:3|max:50',
            'data_nascimento' => 'required|date|before:today',
            'genero' => 'required|in:M,F',
            'contacto' => 'required|regex:/^8[2-7][0-9]{7}$/',

        ],[
            'nome.required' => 'O nome é obrigatório.',
            'apelido.required' => 'O apelido é obrigatório.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.before' => 'A data de nascimento deve ser anterior a hoje.',
            'genero.in' => 'O género deve ser Masculino ou Feminino .',
            'contacto.regex' => 'O contacto deve estar no formato válido, como 8XXXXXXX.',
        ]);
    DB::beginTransaction();
        try {

        $paciente->update($request->all());
        DB::commit();
        return back()->with(['success'=>'Actualização feita com sucesso!']);

        } catch (Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
        DB::beginTransaction();
        try {

            $paciente->delete();
            DB::commit();
            return back()->with(['success'=>'Dado excluido!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }

    }
}
