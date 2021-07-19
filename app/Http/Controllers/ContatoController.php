<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use  Illuminate\Database\Eloquent\Collection;
use App\Contato;
use App\User;
use App\Telefone;
use App\Endereco;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function buscaFiltrada(Request $request){

        $user_id = Auth::user()->id;
        $btnBusca = $request->btnBusca;

        if($btnBusca != null){

                $contatos = DB::table('contatos')
            ->where('user_id', $user_id)
            ->where(function($query) use ($btnBusca) {
               
                return $query->where('nome', 'like', '%'. $btnBusca . '%');
            })->orderBy('nome','asc')->get();

        }else{
            //Busca todos por usuário se o campo de busca por vazio
            $contatos = Contato::where("user_id", Auth::user()
            ->id)
            ->orderBy('nome','asc')
            ->get();

        }
      
       return view('contato.index', ['contatos' =>  $contatos]);

    }

    public function index()
    {

        $contaContatos = DB::table('contatos')
        ->where("user_id", Auth::user()
        ->id)
        ->count();
 
        $contatos = Contato::where("user_id", Auth::user()
        ->id)
        ->orderBy('nome','asc')
        ->get();
        return view('contato.index', ['contatos' =>  $contatos, 'contaContatos' =>  $contaContatos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        //Query para verificar se existe contato com o nome no banco
        $verificaNomeNoBanco = DB::table('contatos')
        ->where('nome', $request->nome)
        ->where('user_id',  $user_id)
        ->count();
       
        if($request->nome == null || $request->telefone[0] == null || $request->cep[0] == null
        || $request->endereco[0] == null || $request->bairro[0] == null || $request->uf[0] == null || $request->cidade[0] == null
        || $request->numero[0] == null){

            return back()->withInput()->with('msgErro', 'Preencha todos os campos!');

        }else if($verificaNomeNoBanco > 0){

            return back()->withInput()->with('msgErro', 'Já existe um contato com esse nome!');

        }
        else{

            //Salva dados básicos do contato
            $c = new Contato();
            $c->nome = $request->nome;
            $c->user_id = Auth::user()->id;

            $c->save();

            //Salva array de telefone
            for ($i = 0; $i < count($request->telefone); $i++) { 
                $this->tel = new Telefone();
                $this->tel->telefone = $request->telefone[$i];
                $this->tel->contato_id = $c->id;
                $this->tel->save();
            }   

            //Salva array de endereços
            for ($i = 0; $i < count($request->cep); $i++) { 
                $this->end = new Endereco();
                $this->end->cep = $request->cep[$i];
                $this->end->endereco = $request->endereco[$i];
                $this->end->bairro = $request->bairro[$i];
                $this->end->cidade = $request->cidade[$i];
                $this->end->uf = $request->uf[$i];
                $this->end->numero = $request->numero[$i];
                $this->end->contato_id = $c->id;
                $this->end->save();
            }   

        return redirect("/contato")->with('msgSuc', 'Cadastrado realizado com sucesso!')->withInput();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //Query pega o primeiro telefone cadastrado
        $primeiroTel = Telefone::where("contato_id", $id)->first();

        $contato = Contato::findOrFail($id);

        $tel = Telefone::where("contato_id", $id)->get();

        $endereco = Endereco::where("contato_id", $id)->get();


        return view('contato.edit', ['contato' => $contato, 'tel' => $tel, 'endereco' => $endereco, 'primeiroTel' => $primeiroTel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        
        if($request->numero == null)
        {
            return back()->withInput()->with('msgErro', 'O endereço deve conter ao menos um registro.');
        }

        if($request->nome == null || $request->telefone == null)
        {
            return back()->withInput()->with('msgErro', 'Você tentou salvar com campos vazios.');
        }
        

        $c = Contato::findOrFail($id);
        $c->nome = $request->nome;
        $c->user_id = Auth::user()->id;
        $c->save();

        $c->telefones()->delete();
        $c->enderecos()->delete();

        for ($i = 0; $i < count($request->telefone); $i++) { 
            $this->tel = new Telefone();
            $this->tel->telefone = $request->telefone[$i];
            $this->tel->contato_id = $c->id;

                $this->tel->save();
       

        }   

        

        for ($i = 0; $i < count($request->cep); $i++) { 
            $this->end = new Endereco();
            $this->end->cep = $request->cep[$i];
            $this->end->endereco = $request->endereco[$i];
            $this->end->bairro = $request->bairro[$i];
            $this->end->cidade = $request->cidade[$i];
            $this->end->uf = $request->uf[$i];
            $this->end->numero = $request->numero[$i];
            $this->end->contato_id = $c->id;
  
                $this->end->save();
          
        }   

        return redirect("/contato")->with('msgSuc', 'Atualizações realizadas com sucesso!')->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contato $Contato)
    {
    
        $Contato->delete();
        return redirect()->route('contato.index')->with('msgDel', 'Contato deletado!');

    }
}
