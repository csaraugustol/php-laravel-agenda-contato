<!DOCTYPE html>
<html>

<head>
    <title>Start Page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" />
</head>


<body class="bg-info">


  <nav class="navbar navbar-expand-sm" style="background-color: #e3f2fd;">
    <a href="{{route('contato.index')}}" class="navbar-brand">Agenda Contatos</a>
    <!--Menu Hamburguer-->
    <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav m-auto">
        <li class="nav-item">
          <a href="{{route('contato.index')}}" class="nav-link text-info">Ver Contatos |</a>
        </li>
        <li class="nav-item">
          <a href="{{route('contato.create')}}" class="nav-link text-info">Criar Contato |</a>
        </li>
        <li>
        <form action="{{route('contato.busca')}}" method="POST" class="form form-inline">
           @csrf
           <input type="text" class="form-control col-sm-5 justify-content-center" placeholder="Pesquisar" id="" name="btnBusca" />

           <button type="submit" class="btn btn-warning">Buscar</button>

        </form>
        </li>
        <li class="nav-item">
          <a href="{{url('/logout')}}" class="nav-link text-info">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  

  @if(session('msgSuc'))
    <div class="alert alert-success text-center">
        <p>{{session('msgSuc')}}</p>
    </div>
    @endif

    
    @if(session('msgDelete'))
    <div class="alert alert-warning text-center">
        <p>{{session('msgDelete')}}</p>
    </div>
    @endif

    <div class="">
      <h2 class="text-center mt-3 text-light display-4">Meus Contatos</h2>
    </div>

    <div class="row form-group">
      <!--Campo de busca por contatos-->
      <div class="col-sm-6 mt-2">
        <form action="{{route('contato.busca')}}" method="POST" class="form form-inline">
           @csrf
           <input type="text" class="form-control col-sm-3 justify-content-center" placeholder="Pesquisar" id="" name="btnBusca" />

           <button type="submit" class="btn btn-warning">Buscar</button>

        </form>
      </div>

      <div class="col-sm-6 mt-2">
        <a href="{{route('contato.create')}}" class="btn btn-warning float-right mr-3">Novo Contato</a>
      </div>

    </div>


    <div class="d-flex justify-content-center">
    <table class="table table-light table-striped w-50 table-hover">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col">Nome</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contatos as $c)
            <tr>
                <!-- <td scope="col">{{$c->id}}</td> -->
                <td scope="col">{{$c->nome}}</td>
                <td scope="col">
                    <a href="{{route('contato.edit',['contato' => $c->id])}}" class="btn btn-primary w-50">Ver informações</a>
                    <form action="{{route('contato.destroy',['contato' => $c->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger w-50" value="Apagar" />
                    </form>
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






  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md text-center footer text-center">
        <small class="d-block mb-3 text-light"> Agenda VExpenses &copy; - 2021</small>
      </div>

    </div>



  </footer>


</body>


</html>