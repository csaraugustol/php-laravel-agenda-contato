<!DOCTYPE html>
<html>

<head>
    <title>Start Page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>


    <script>
		function getDadosEndPorCEP() {
			let cep = document.getElementById('cep').value;


			let url = 'https://viacep.com.br/ws/' + cep + '/json/unicode/';

			console.log(url);

			let xmlHttp = new XMLHttpRequest();
			xmlHttp.open('GET', url)

			xmlHttp.onreadystatechange = () => {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					let dadosJsonText = xmlHttp.responseText;
					let dadosJsonObj = JSON.parse(dadosJsonText);

					document.getElementById('endereco').value = dadosJsonObj.logradouro;
					document.getElementById('bairro').value = dadosJsonObj.bairro;
					document.getElementById('cidade').value = dadosJsonObj.localidade;
					document.getElementById('uf').value = dadosJsonObj.uf;

				}

			}

			xmlHttp.send()

		}

    function getDadosEndPorCEP2(int) {
			let cep = document.getElementById('cep'+int).value;


			let url = 'https://viacep.com.br/ws/' + cep + '/json/unicode/';

			console.log(url);

			let xmlHttp = new XMLHttpRequest();
			xmlHttp.open('GET', url)

			xmlHttp.onreadystatechange = () => {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					let dadosJsonText = xmlHttp.responseText;
					let dadosJsonObj = JSON.parse(dadosJsonText);

					document.getElementById('endereco'+int).value = dadosJsonObj.logradouro;
					document.getElementById('bairro'+int).value = dadosJsonObj.bairro;
					document.getElementById('cidade'+int).value = dadosJsonObj.localidade;
					document.getElementById('uf'+int).value = dadosJsonObj.uf;

				}

			}

			xmlHttp.send()

		}

    
		
	</script>
</head>


<body class="bg-info">

  <div class="container-fluid corpo">
    <div class="row justify-content-md-center h-100 p-5">
      <div class="card-wrapper w-75">
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
                  <h3 class="card-title text-center">Novo Contato</h3>
                
                <form id="addCampos" action="{{route('contato.update',['contato' => $contato->id])}}" method="POST">
                        @csrf
                        @method('PUT')


                  <h4 class="text-center">Dados</h4>

                    
                    <div class="row form-group">
                   
                      <div class="col-sm-12 mt-2">
                        <input type="text" class="form-control" placeholder="Nome" id="" name="nome" value="{{$contato->nome}}" />
                      </div>

                    </div>

                    <h4 class="text-center">Telefones</h4>

                    <div class="row form-group" id="eventoNovoTel">

                    <div class="col-lg-12 col-sm-12 mt-2">
                        <button class="form-control bg-warning" type="button" id="novoTel">+ Telefone</button>
                      </div>

                      @foreach($tel as $t)

                          @if($t == $primeiroTel )

                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2 input-group form-group remove-dados">
                           <!-- Exibe primeiro input sem a opção de remoção -->
                          
                          <input type="text" class="form-control" placeholder="Telefone" id="" name="telefone[]"  
                          value="{{$t->telefone}}" />

                          @else

                          <div class="col-lg-6 col-md-6 col-sm-6 mt-2 input-group form-group remove-dados">
                           <!-- Carrega restante array de telefones -->
                           <div class="input-group-prepend">
                           <button class="btn btn-danger remove" type="button" >-</button>
                                        </div>
                          <input type="text" class="form-control" placeholder="Telefone" id="" name="telefone[]"  
                          value="{{$t->telefone}}" />

                          @endif
                        </div>
                        @endforeach

                        </div>

                    </div>

                    <h4 class="text-center">Endereços</h4>

             

                    <div class="col-lg-12 col-sm-12 mt-2">
                          <button class="form-control bg-warning " type="button" id="novoEnd">+ Endereço</button>
                        </div>
          
                    <div id="eventoNovoEnd">
                    @foreach($endereco as $e)
                          <div class="remove-dados">

                            <div class="row form-group">
                              <div class="col-lg-3 col-sm-3 mt-2">
                                <input type="text" class="form-control" placeholder="CEP" value="{{$e->cep}}" name="cep[]" id="cep" onblur="getDadosEndPorCEP()"/>
                              </div>

                              <div class="col-lg-6 col-sm-6 mt-2">
                                <input type="text" class="form-control" placeholder="Endereço" value="{{$e->endereco}}" name="endereco[]" id="endereco" />
                              </div>

                              <div class="col-lg-3 col-sm-3 mt-2">
                                <input type="text" class="form-control" placeholder="Bairro" value="{{$e->bairro}}" name="bairro[]" id="bairro" />
                              </div>
                            </div>
                      
                            <div class="row form-group">
                            

                              <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                <input type="text" class="form-control" placeholder="Cidade" value="{{$e->cidade}}" name="cidade[]" id="cidade" />
                              </div>
                        
                              <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                <input type="text" class="form-control" placeholder="UF" value="{{$e->uf}}" name="uf[]" id="uf" />
                              </div>

                              <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                                <input type="text" class="form-control" placeholder="Número" value="{{$e->numero}}" name="numero[]" id="numero" />
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                              <button class="btn btn-danger remove w-100" type="button" >Remover</button>
                              </div>
                            </div>
                            <hr class="bg-secondary">
                           

                            </div>
                            @endforeach
                    </div>

                    <div class="form-group">
                      <button type="submit" id="btnCad" class=" btn btn-primary btn-block" style="cursor: pointer">
                        Salvar Alterações
                      </button>
                    </div>
                    <div class="mt-4 text-center">
                      <a href="{{route('contato.index')}}" style="cursor: pointer">Voltar</a>
                      
                    </div>
                  </form>
                </div>
              </div>
             
      </div>
    </div>
  </div>


<script>

$( "#novoTel" ).click(function() {
  $( "#eventoNovoTel" ).append( '<div class="col-lg-6 col-md-6 col-sm-6 mt-2 remove-dados"><input type="text" class="form-control" placeholder="Telefone" id="" name="telefone[]"/><button class="btn btn-danger remove" type="button" >-</button></div>');
});

var cont = 1;

$( "#novoEnd" ).click(function() {
  cont++;
  $( "#eventoNovoEnd" ).append( '<div class="remove-dados"><div class="row form-group"><div class="col-lg-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="CEP" value="{{$e->cep}}" name="cep[]" id="cep'+cont+'" onblur="getDadosEndPorCEP2('+cont+')"/></div>'+ 


                      ' <div class="col-lg-6 col-sm-6 mt-2"><input type="text" class="form-control" placeholder="Endereço" value="" name="endereco[]" id="endereco'+cont+'" /></div> ' +

                      '<div class="col-lg-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="Bairro" value="" name="bairro[]" id="bairro'+cont+'" /></div></div>' +
                
                     ' <div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="Cidade" value="" name="cidade[]" id="cidade'+cont+'" /></div>' +

                        '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="UF" value="" name="uf[]" id="uf'+cont+'" /></div>' + 
                  
                        '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="Número" value="" name="numero[]" id="numero'+cont+'" /></div>'+
                        '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"><button class="btn btn-danger remove w-100" type="button" >Remover</button></div>'+'<hr class="bg-secondary"> </div></div>' );
});


//Remover campos de dados
$(document).on('click', 'button.remove', function() {
  $(this).closest('div.remove-dados').remove();
});


</script>

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