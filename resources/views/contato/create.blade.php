@extends('layouts.creat_edit')

@section('content')

    <div class="container-fluid corpo">
        <div class="row justify-content-center h-100 ">
            <div class="card-wrapper w-75">
                <div class="brand text-center">
                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                </div>
                <div class="card fat">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h3 class="card-title text-center">Novo Contato</h3>
                        <form id="addCampos" method="POST" action="{{ route('contato.store') }}">
                            @csrf
                            <h4 class="text-center">Dados</h4>
                            <div class="row form-group">
                                <div class="col-sm-12 mt-2">
                                    <input type="text" class="form-control" value="{{ old('nome') }}" placeholder="Nome"
                                        id="nome" name="nome" />
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" class="form-control" value="{{ old('tags') }}" placeholder="Tags"
                                        id="tags" name="tags" data-role="tagsinput" />
                                </div>
                            </div>
                            <h4 class="text-center">Telefones</h4>
                            <div class="col-lg-12 col-sm-12 mt-2">
                                <button class="form-control bg-warning" type="button" id="novoTel">+ Telefone</button>
                            </div>
                            <div class="row form-group" id="eventoNovoTel">
                                @if (!is_null(old('telefones')))
                                    @foreach (old('telefones') as $telefone)
                                        @if ($telefone === old('telefones')[0])
                                            <div class="col-lg-6 col-sm-6 mt-2">
                                                <input type="text" class="form-control" placeholder="Telefone"
                                                    id="telefones" name="telefones[]" value="{{ $telefone }}" />
                                            </div>
                                        @else
                                            <div
                                                class="col-lg-6 col-md-6 col-sm-6 mt-2 input-group form-group remove-dados">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-danger remove" type="button">-</button>
                                                </div>
                                                <input type="text" class="form-control" required placeholder="Telefone"
                                                    id="" name="telefones[]" value="{{ $telefone }}" />
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="col-lg-6 col-sm-6 mt-2">
                                        <input type="text" class="form-control" placeholder="Telefone" id="telefones"
                                            name="telefones[]" />
                                    </div>
                                @endif
                            </div>
                            <h4 class="text-center">Endereços</h4>
                            <div class="col-lg-12 col-sm-12 mt-2">
                                <button class="form-control bg-warning" type="button" id="novoEnd">+ Endereço</button>
                            </div>
                            <div id="eventoNovoEnd">
                                @if (!is_null(old('enderecos')))
                                    @foreach (old('enderecos') as $endereco)
                                        @if ($endereco == old('enderecos')[0])
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                    <input type="text" class="form-control" placeholder="CEP"
                                                        value="{{ $endereco['cep'] }}" name="enderecos[0][cep]" id="cep1"
                                                        onblur="getDadosEndPorCEP2(1)" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                                    <input type="text" class="form-control" placeholder="Logradouro"
                                                        value="{{ $endereco['endereco'] }}" name="enderecos[0][endereco]"
                                                        id="endereco1" />
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                    <input type="text" class="form-control" placeholder="Bairro"
                                                        value="{{ $endereco['bairro'] }}" name="enderecos[0][bairro]"
                                                        id="bairro1" />
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                                    <input type="text" class="form-control" placeholder="Cidade"
                                                        value="{{ $endereco['cidade'] }}" name="enderecos[0][cidade]"
                                                        id="cidade1" />
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                                    <input type="text" class="form-control" placeholder="UF"
                                                        value="{{ $endereco['uf'] }}" name="enderecos[0][uf]" id="uf1" />
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                                    <input type="text" class="form-control" placeholder="Número"
                                                        value="{{ $endereco['numero'] }}" name="enderecos[0][numero]"
                                                        id="numero1" />
                                                </div>
                                            </div>
                                            <hr class="bg-secondary">
                                        @else
                                            <div class="remove-dados">
                                                <div class="row form-group">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                        <input type="text" class="form-control" placeholder="CEP"
                                                            value="{{ $endereco['cep'] }}" name="enderecos[0][cep]"
                                                            id="cep2" onblur="getDadosEndPorCEP2(2)" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                                        <input type="text" class="form-control" placeholder="Logradouro"
                                                            value="{{ $endereco['endereco'] }}"
                                                            name="enderecos[0][endereco]" id="endereco2" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                        <input type="text" class="form-control" placeholder="Bairro"
                                                            value="{{ $endereco['bairro'] }}" name="enderecos[0][bairro]"
                                                            id="bairro2" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                        <input type="text" class="form-control" placeholder="Cidade"
                                                            value="{{ $endereco['cidade'] }}" name="enderecos[0][cidade]"
                                                            id="cidade2" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                        <input type="text" class="form-control" placeholder="UF"
                                                            value="{{ $endereco['uf'] }}" name="enderecos[0][uf]"
                                                            id="uf2" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                        <input type="text" class="form-control" placeholder="Número"
                                                            value="{{ $endereco['numero'] }}" name="enderecos[0][numero]"
                                                            id="numero2" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                                        <button class="btn btn-danger remove w-100"
                                                            type="button">Remover</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="bg-secondary">
                                        @endif
                                    @endforeach
                                @else
                                    <div class="row form-group">
                                        <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                            <input type="text" class="form-control" placeholder="CEP" value=""
                                                name="enderecos[0][cep]" id="cep1" onblur="getDadosEndPorCEP2(1)" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                            <input type="text" class="form-control" placeholder="Logradouro" value=""
                                                name="enderecos[0][endereco]" id="endereco1" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                            <input type="text" class="form-control" placeholder="Bairro" value=""
                                                name="enderecos[0][bairro]" id="bairro1" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                            <input type="text" class="form-control" placeholder="Cidade" value=""
                                                name="enderecos[0][cidade]" id="cidade1" />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                            <input type="text" class="form-control" placeholder="UF" value=""
                                                name="enderecos[0][uf]" id="uf1" />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                            <input type="text" class="form-control" placeholder="Número" value=""
                                                name="enderecos[0][numero]" id="numero1" />
                                        </div>
                                    </div>
                                    <hr class="bg-secondary">
                                @endif
                            </div>
                            <div class="form-grhttps://meet.google.com/mrs-ofsb-dzioup">
                                <button onclick='teste()' type="submit" id="btnCad" class=" btn btn-primary btn-block"
                                    style="cursor: pointer">
                                    Cadastrar
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
@endsection
