<!DOCTYPE html>
<html>

<head>
    <title>Agenda Contatos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" />

    <style>
    
    footer{
      width: 100%;
      height: 10px;
      position: fixed;
      bottom: 0;
      left: 0;
}
    </style>
</head>


<body class="bg-info">


  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="{{route('contato.index')}}">Agenda de Contatos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">

        <li class="nav-item">
          <a href="{{route('contato.create')}}" class="nav-link text-info">Criar Contato</a>
        </li>

        <li class="nav-item">
          <a href="{{url('/logout')}}" class="nav-link text-info">Sair</a>
        </li>
      
    </ul>
 
    <form action="{{route('contato.busca')}}" method="POST" class="form form-inline">
           @csrf
           <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" name="btnBusca"  aria-label="Pesquisar">

           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>

        </form>
    
  </div>
</nav>

  

  

    <div class="mt-5">
    @if(session('msgSuc'))
    <div class="alert alert-success text-center mt-5">
        <p>{{session('msgSuc')}}</p>
    </div>
    @endif

    
    @if(session('msgDel'))
    <div class="alert alert-warning text-center">
        <p>{{session('msgDel')}}</p>
    </div>
    @endif
    <div>
      <h2 class="text-center mt-5 text-light display-4">Minha Agenda de Contatos</h2>
    </div>

    <!-- <div class="row form-group">
     
      <div class="col-sm-6 mt-2">
      <form action="{{route('contato.busca')}}" method="POST" class="form form-inline">
           @csrf
           <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" name="btnBusca"  aria-label="Pesquisar">

           <button class="btn btn-warning my-2 my-sm-0" type="submit">Pesquisar</button>

        </form>
      </div>

      <div class="col-sm-6 mt-2">
        <a href="{{route('contato.create')}}" class="btn btn-warning float-right mr-3">Novo Contato</a>
      </div>

    </div> -->


    <div class="d-flex justify-content-center mt-5">
    <table class="table table-light table-striped w-50 table-hover">
        <thead>
            <tr class='text-center'>
                <!-- <th scope="col">#</th> -->
                <th scope="col">Nome</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contatos as $c)
            <tr class='text-center'>
                <!-- <td scope="col">{{$c->id}}</td> -->
                <td scope="col">{{$c->nome}}</td>
                <td scope="col">
                   
                    <div class="row form-group">
                        <div class="col-sm-2">
                        <a href="{{route('contato.edit',['contato' => $c->id])}}" class="btn btn-primary " style="width: 100px">Detalhes</a>
                        </div>

                        <div class="col-sm-2 ml-3 ">
                        <form action="{{route('contato.destroy',['contato' => $c->id])}}" method="post" style="width: 200px">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger w-50 " value="Apagar" />
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

 

  </div>



  

  <footer class="pt-4 my-md-5 pt-md-5 border-top ">
    <div class="row">
      <div class="col-12 col-md text-center footer text-center">
        <small class="d-block mb-3 text-light"> Agenda VExpenses &copy; - 2021</small>
      </div>

    </div>



  </footer> 



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

</body>


</html>