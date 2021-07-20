<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <style>
        #barra-rolagem {

            margin-top: 60px;
            background: #f5f5f5;
            display: block;
            overflow-y: auto;
            overflow-x: hidden;

        }

    </style>
</head>


<body class="bg-info " id="barra-rolagem">



    @if (session('msgSuc'))

        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
            <p>{{ session('msgSuc') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if (session('msgDel'))

        <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
            <p>{{ session('msgDel') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @yield('content')




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script>
        $("#novoTel").click(function() {
            $("#eventoNovoTel").append(
                '<div class="col-lg-6 col-md-6 col-sm-6 mt-2 input-group form-group remove-dados"><div class="input-group-prepend"><button class="btn btn-danger remove" type="button">-</button></div><input type="text" class="form-control" placeholder="Telefone" id="" name="telefone[]" /></div>'
            );
        });

        var cont = 1;

        $("#novoEnd").click(function() {
            cont++;
            $("#eventoNovoEnd").append(
                '<div class="remove-dados"><div class="row form-group"><div class="col-lg-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="CEP" name="cep[]" id="cep' +
                cont + '" onblur="getDadosEndPorCEP2(' + cont + ')" /></div>' +
                '<div class="col-lg-6 col-sm-6 mt-2"><input type="text" class="form-control" placeholder="Endereço"  name="endereco[]" id="endereco' +
                cont + '" /></div>' +
                '<div class="col-lg-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="Bairro" name="bairro[]" id="bairro' +
                cont + '" /></div></div>' +
                '<div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="Cidade" name="cidade[]" id="cidade' +
                cont + '" /></div>' +
                '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="UF" name="uf[]" id="uf' +
                cont + '" /></div>' +
                '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"> <input type="text" class="form-control" placeholder="Número" name="numero[]" id="numero' +
                cont + '" /></div>' +
                '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"><button class="btn btn-danger remove w-100" type="button">Remover</button></div></div><hr class="bg-secondary"></div>'
            );
        });

        //Remover campos de dados
        $(document).on('click', 'button.remove', function() {
            $(this).closest('div.remove-dados').remove();
        });
    </script>

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
            let cep = document.getElementById('cep' + int).value;


            let url = 'https://viacep.com.br/ws/' + cep + '/json/unicode/';

            console.log(url);

            let xmlHttp = new XMLHttpRequest();
            xmlHttp.open('GET', url)

            xmlHttp.onreadystatechange = () => {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    let dadosJsonText = xmlHttp.responseText;
                    let dadosJsonObj = JSON.parse(dadosJsonText);

                    document.getElementById('endereco' + int).value = dadosJsonObj.logradouro;
                    document.getElementById('bairro' + int).value = dadosJsonObj.bairro;
                    document.getElementById('cidade' + int).value = dadosJsonObj.localidade;
                    document.getElementById('uf' + int).value = dadosJsonObj.uf;

                }

            }

            xmlHttp.send()

        }
    </script>

</body>


</html>
