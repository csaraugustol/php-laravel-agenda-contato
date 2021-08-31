@extends('layouts.creat_edit')
@section('content')


    <div class="container-fluid corpo">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper w-75">
                <div class="brand text-center">
                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>

                </div>

                <div class="card fat">


                    @if (session('msgErro'))
                        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                            <p>{{ session('msgErro') }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card-body">
                        <h3 class="card-title text-center">Ver Contato</h3>

                        <form id="addCampos" action="{{ route('contato.update', ['contato' => $contato->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')


                            <h4 class="text-center">Dados</h4>


                            <div class="row form-group">

                                <div class="col-sm-12 mt-2">
                                    <input type="text" class="form-control" required placeholder="Nome" id="" name="nome"
                                        value="{{ $contato->nome }}" />
                                </div>

                            </div>

                            <h4 class="text-center">Telefones</h4>

                            <div class="row form-group" id="eventoNovoTel">

                                <div class="col-sm-12 mt-2">
                                    <button class="form-control bg-warning mt-2" type="button" id="novoTel">+
                                        Telefone</button>
                                </div>


                                @foreach ($tel as $t)

                                    @if ($t == $primeiroTel)

                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2 input-group form-group">
                                            <!-- Exibe primeiro input sem a opção de remoção -->

                                            <input type="text" class="form-control" required placeholder="Telefone" id=""
                                                name="telefone[]" value="{{ $t->telefone }}" />
                                        </div>
                                    @else


                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2 input-group form-group remove-dados">
                                            <!-- Carrega restante array de telefones -->
                                            <div class="input-group-prepend">
                                                <button class="btn btn-danger remove" type="button">-</button>
                                            </div>
                                            <input type="text" class="form-control" required placeholder="Telefone" id=""
                                                name="telefone[]" value="{{ $t->telefone }}" />
                                        </div>

                                    @endif
                                @endforeach

                            </div>

                            <h4 class="text-center">Endereços</h4>
                            <div class="col-sm-12 mt-2">
                                <button class="form-control bg-warning " type="button" id="novoEnd">+ Endereço</button>
                            </div>

                            <div id="eventoNovoEnd">
                                @foreach ($endereco as $e)
                                    <div class="remove-dados">

                                        <div class="row form-group">
                                            <div class="col-lg-3 col-sm-3 mt-2">
                                                <input type="text" class="form-control" required placeholder="CEP"
                                                    value="{{ $e->cep }}" name="cep[]" id="cep"
                                                    onblur="getDadosEndPorCEP()" />
                                            </div>

                                            <div class="col-lg-6 col-sm-6 mt-2">
                                                <input type="text" class="form-control" required placeholder="Endereço"
                                                    value="{{ $e->endereco }}" name="endereco[]" id="endereco" />
                                            </div>

                                            <div class="col-lg-3 col-sm-3 mt-2">
                                                <input type="text" class="form-control" required placeholder="Bairro"
                                                    value="{{ $e->bairro }}" name="bairro[]" id="bairro" />
                                            </div>
                                        </div>

                                        <div class="row form-group">


                                            <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                <input type="text" class="form-control" required placeholder="Cidade"
                                                    value="{{ $e->cidade }}" name="cidade[]" id="cidade" />
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                <input type="text" class="form-control" required placeholder="UF"
                                                    value="{{ $e->uf }}" name="uf[]" id="uf" />
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                <input type="text" class="form-control" required placeholder="Número"
                                                    value="{{ $e->numero }}" name="numero[]" id="numero" />
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                <button class="btn btn-danger remove w-100" type="button">Remover</button>
                                            </div>
                                        </div>
                                        <hr class="bg-secondary">

                                    </div>
                                @endforeach
                            </div>


                            <div class="form-group">
                                <button type="submit" id="btnCad" class=" btn btn-primary btn-block"
                                    style="cursor: pointer">
                                    Salvar Alterações
                                </button>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('contato.index') }}" style="cursor: pointer">Voltar</a>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
