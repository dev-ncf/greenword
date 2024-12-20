<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function novasAgendas(){
       return Agenda::where('tipo', 'Externa')->orderBy('id', 'desc')->paginate(3);
    }
    public function index()
    {
        //
        $query = Medico::query();
        $medicos =$query->paginate(7);
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Medicos.index',compact(['medicos','ultimasAtualizacoes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Medicos.add',compact(['ultimasAtualizacoes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       $validatedDatas = $request->validate([
            'nome'=>'required|min:3|max:255',
            'especialidade'=>'required|min:3|max:60',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            if($request->hasFile('foto')){
                $arquivo = $request->file('foto');
                // Armazena o arquivo na pasta 'fotos' dentro do diretório de armazenamento padrão

                // Define um nome único para o arquivo
                $nomeArquivo = time() . '_' . $arquivo->getClientOriginalName();

                // Armazena o arquivo na pasta 'fotos' dentro do diretório de armazenamento padrão
                $caminho = $arquivo->storeAs('fotos', $nomeArquivo, 'public');

                $validatedDatas['foto'] = $caminho;
            }

            Medico::create($validatedDatas);
            DB::commit();
            return back()->with(['success'=>'Registo feito com sucesso']);
        } catch (\Throwable $th) {
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
    public function destroy(Medico $medico)
    {
        //
        DB::beginTransaction();
        try {

            $medico->delete();
            DB::commit();
            return back()->with(['success'=>'Dado excluido!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}
