<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     private function novasAgendas(){
       return Agenda::where('tipo','=','Externa')->latest()->paginate(3);
    }
    public function index()
    {
        //
        $query = User::query();
        $usuarios = $query->paginate(5);
        $todosUsuarios = User::all();
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Usuarios.index',compact(['usuarios','todosUsuarios','ultimasAtualizacoes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ultimasAtualizacoes = $this->novasAgendas();
        return view('Admin.Usuarios.add',compact(['ultimasAtualizacoes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validatedDatas = $request->validate([
            'name'=>'required|min:3|max:50',
            'email'=>'required|email|unique:users,email',
            'nivel'=>'required|max:1'

        ],[

            'name.required'=>'O nome é obrigatório',
            'email.required'=>'O email é obrigatório',
            'nivel.required'=>'O nivel é obrigatório',
            'nivel.max'=>'O nivel deve ter no maximo 1 caratere!',
            'name.max'=>'O nome deve ter no maximo 50 carateres!',
            'name.min'=>'O nome deve ter no minimo 3 carateres!',
            'email.email'=>'forneca um email válido!',
            'email.unique'=>'o email ja existe no nosso banco de dados!',
        ]);

        DB::beginTransaction();

        try {
            $validatedDatas['password']=bcrypt('1234');
            User::create($validatedDatas);
            DB::commit();
            return back()->with(['success'=>'Usuario reistado com sucesso!']);
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
    public function destroy(User $user)
    {
        //
         DB::beginTransaction();
        try {

            $user->delete();
            DB::commit();
            return back()->with(['success'=>'Dado excluido!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}
