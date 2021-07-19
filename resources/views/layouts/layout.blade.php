<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" />

    <style>
    
    footer{
      width: 100%;
      height: 10px;
      position: fixed;
      bottom: 0;
}

#barra-rolagem{

    margin-top: 60px;
    background: #f5f5f5;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;

}
    </style>
</head>


<body class="bg-info " id="barra-rolagem">


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
        <li>
           <a class="dropdown-item" href="{{ route('logout') }}">teste</a>
        </li>
       
      
    </ul>
 
    <form action="{{route('contato.busca')}}" method="POST" class="form form-inline">
           @csrf
           <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" name="btnBusca"  aria-label="Pesquisar">

           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>

        </form>
    
  </div>
</nav>
  


    @if(session('msgSuc'))

    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
      <p>{{session('msgSuc')}}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endif
    

    
    @if(session('msgDel'))

    <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
      <p>{{session('msgDel')}}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endif

    <main class="py-4">
            @yield('content')
        </main>



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
  

    