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
      </div>

    

            <div class="card fat">

            @if(session('msgErro'))
            <div class="alert alert-danger text-center">
             <p>{{session('msgErro')}}</p>
             </div>
             @endif

              <div class="card-body">
                <h4 class="card-title text-center">Cadastro Usuário</h4>
                <form action="{{route('usuario.store')}}" method="POST" id="formCadastroUser">
                @csrf
                  <div class="form-group">

                    <label for="nome" class="text-weight-bold">Nome</label>
                    <div>
                      <input id="nome" type="text" class="form-control" name="nome" style="padding-right: 60px;">
                    </div>

                  </div>
        
                  
                  <div class="form-group">

                    <label for="email" class="text-weight-bold">E-mail</label>
                    <div>
                      <input id="email" type="email" class="form-control" name="email" style="padding-right: 60px;">
                    </div>

                  </div>

                  <div class="form-group">

                    <label for="senha">Senha</label>
                    <div>
                      <input id="senha" type="password" class="form-control" name="senha" style="padding-right: 60px;">
                    </div>

                  </div>

                  <div class="form-group">

                    <label for="confSenha">Confirmação Senha</label>
                    <div>
                      <input id="confSenha" type="password" class="form-control" name="confSenha" style="padding-right: 60px;">
                    </div>

                  </div>

                  <div class="form-group m-0">
                    <button type="submit" class="btn btn-primary btn-block" style="cursor: pointer">
                      Cadastrar
                    </button>
                  </div>
                  <div class="mt-4 text-center">
                  <a href="{{route('usuario.index')}}">Voltar</a>
                  </div>
                </form>
              </div>
            </div>
           
    </div>
  </div>
</div>

<script>

$(document).ready(function(){

  $("#formCadastroUser").validate({
    rules: {
      nome: {
        required: true,
      },
      
      senha: {
        required: true,
        rangelength: [4, 10]
      },
      confSenha: {
        required: true,
        equalTo: "#senha"
      }

    },
    messages: {

      nome: {
        required: "<div class='text-danger'>Campo Obrigatório.</div>"
      },
      
      senha: {
        required: "<div class='text-danger'>Campo Obrigatório.</div>",
        rangelength: "<div class='text-danger'>Senha deve ter de 4 a 10 caracteres</div>"
      },
      confSenha: {
        required: "<div class='text-danger'>Campo Obrigatório.</div>",
        equalTo: "<div class='text-danger'>Senhas não são iguais.</div>"
      }

    }
  });

});
</script>

</body>
</html>
