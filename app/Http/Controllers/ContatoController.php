<?php

namespace App\Http\Controllers;

use App\Contato;
use App\Endereco;
use App\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Contacts\StoreRequest;
use App\Services\Contracts\ContatoServiceInterface;
use App\Services\Params\Contacts\CreateCompleteContactsServiceParams;

class ContatoController extends Controller
{
    /**
     * @var ContatoServiceInterface
     */
    protected $contatoService;

    public function __construct(ContatoServiceInterface $contatoService)
    {
        $this->contatoService = $contatoService;
    }

    /**
     * Busca todos os contatos do usuário logado.
     * Realiza filtragem para o usuário.
     *
     * @return View
     */

    public function index(Request $request)
    {
        $findContactsResponse = $this->contatoService
            ->filterSearch(Auth::user()->id, $request->btnBusca);

        if (!$findContactsResponse->success) {
            return back()->with('msgErro', $findContactsResponse->message);
        }

        $contacts = $findContactsResponse->data;

        return view('contato.index', compact('contacts'));
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
     * Método para criação do contato
     *
     * @param StoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $tags = explode(',', $request->tags);

        $completeContactParams = new CreateCompleteContactsServiceParams(
            Auth::user()->id,
            $request->nome,
            $request->telefones,
            $request->enderecos,
            $tags
        );

        $storeCompleteContactResponse = $this->contatoService
            ->storeCompleteContacts($completeContactParams);

        if (!$storeCompleteContactResponse->success) {
            return back()
                ->withInput()
                ->with('msgErro', $storeCompleteContactResponse->message);
        }

        return redirect("/contato")
            ->with('msgSuc', 'Cadastrado realizado com sucesso!')
            ->withInput();
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

        return view('contato.edit', [
            'contato'     => $contato,
            'tel'         => $tel,
            'endereco'    => $endereco,
            'primeiroTel' => $primeiroTel
        ]);
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
        $userId = Auth::user()->id;

        if (
            $request->cep == null || $request->endereco == null || $request->bairro == null || $request->cidade == null ||
            $request->numero == null || $request->uf == null
        ) {
            return back()->withInput()->with('msgErro', 'Não é possível salvar um endereço com campos vazios.');
        }

        if ($request->nome == null || $request->telefone == null) {
            return back()->withInput()->with('msgErro', 'Você tentou salvar com campos vazios.');
        }


        $c = Contato::findOrFail($id);
        $c->nome = $request->nome;
        $c->userId = Auth::user()->id;
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

    public function importaArqCsv()
    {
        return view("importacao");
    }

    /*public function importacao(Request $request){
        Excel::import(new ContatoImport, $request->file);

        if($request == null){
            return back()->withInput()->with('msgErro', 'Selecione o arquivo a ser enviado.');
        }else{
            return redirect()->route('contato.index')->with('msgSuc', 'Importação feita com sucesso.');
        }
    }*/
}
