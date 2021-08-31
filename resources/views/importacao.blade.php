@extends('layouts.creat_edit')
@section('content')


    <div class="container-fluid corpo">
        <div class="row justify-content-center h-100 ">
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
                        <h3 class="card-title text-center">Importação via CSV</h3>
                        <form enctype="multipart/form-data" method="POST" action="{{ route('contato.importaArqCsv') }}">
                            @csrf

                            <div class="form-group">
                                <label for="file">Arquivo CSV</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            

                            <div class="form-group">
                                <button type="submit" id="btnCad" class=" btn btn-primary btn-block"
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
