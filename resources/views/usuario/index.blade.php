<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
         <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" />
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
         integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
         crossorigin="anonymous"></script>

        <!-- Styles -->
       
    </head>
    <body class="bg-info">

    <div class="container-fluid corpo">
    <div class="row justify-content-md-center h-100 p-5">
      <div class="card-wrapper">
        <div class="brand text-center">
          <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
          <!--<img src="img/logo.jpg" alt="logo">-->
        </div>

        @if(session('msgSuc'))
    <div class="alert alert-success text-center">
        <p>{{session('msgSuc')}}</p>
    </div>
    @endif

              <div class="card fat">
                <div class="card-body">
                  <h4 class="card-title text-center">Login</h4>
                  <form method="POST" >
          
                    
                    <div class="form-group">

                      <label for="usuario" class="text-weight-bold">Usuário</label>
                      <div>
                        <input id="usuario" type="text" class="form-control" name="" style="padding-right: 60px;">
                      </div>

                    </div>

                    <div class="form-group">

                      <label for="senha">Senha</label>
                      <div>
                        <input id="senha" type="password" class="form-control" name="" style="padding-right: 60px;">
                      </div>

                    </div>

                    <div class="form-group m-0">
                      <button type="submit" class="btn btn-primary btn-block">
                        Entrar
                      </button>
                    </div>
                    <div class="mt-4 text-center">
                    <a href="{{route('usuario.create')}}">Cadastre-se</a>
                    </div>
                  </form>
                </div>
              </div>
             
      </div>
    </div>
  </div>



</body>
</html>
