<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Doenca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class DoencasController extends Controller
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
        $query = Doenca::query();
        $doencas = $query->paginate(5);
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Doencas.index',compact(['doencas','ultimasAtualizacoes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Doencas.add',compact(['ultimasAtualizacoes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nome' => 'required|string|min:3|max:50|unique:doencas,nome',
        ],[
            'nome.required' => 'O nome é obrigatório.',
            'nome.unique' => 'O nome já existe.',
        ]);

        DB::beginTransaction();
        try {
            //code...
            Doenca::create($request->all());
            DB::commit();
            return back()->with(['success'=>'Registo feito com sucesso!']);
        } catch (Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Doenca $doenca)
    {
        //
         DB::beginTransaction();
        try {

            $doenca->delete();
            DB::commit();
            return back()->with(['success'=>'Dado excluido!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }

    }
}
