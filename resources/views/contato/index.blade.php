@extends('layouts.layout')
@section('content')
    <div>
        <h2 class="text-center text-light display-4">Minha Agenda de Contatos</h2>
    </div>
    <div class="d-flex justify-content-center mt-2">
        <table class="table table-light table-striped w-50 table-hover">
            <thead>
                <tr class='text-center'>
                    <th colspan="2" class='text-center text-uppercase'>
                        @if (count($contacts) > 1)
                            Você possui {{ count($contacts) }} contatos em sua agenda.
                        @elseif(count($contacts) === 1)
                            Você possui {{ count($contacts) }} contato em sua agenda.
                        @endif
                    </th>
                </tr>
                <tr class='text-center'>
                    <th scope="col">Nome</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $c)
                    <tr class='text-center'>
                        <td scope="col" class="col-md-4 col-sm-2 align-middle">{{ $c->nome }}</td>
                        <td scope="col">

                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-4">
                                    <a href="{{ route('contato.edit', ['contato' => $c->id]) }}"
                                        class="btn btn-primary  mr-sm-3 mr-md-2" style="width: 100px">Detalhes</a>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-4 ">
                                    <form action="{{ route('contato.destroy', ['contato' => $c->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger ml-sm-3 ml-md-2" value="Apagar"
                                            style="width: 100px" />
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class='text-center'>
                        <td colspan="2">Não há contatos cadastrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
