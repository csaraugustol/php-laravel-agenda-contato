<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contatos - PDF</title>
</head>

<body>
    <div class="container">

        <h1 style="text-align: center">Listagem de Contatos</h1>



        @forelse($contatos as $c)


            <div style="text-align: center">
                
                <hr>

                <h1>{{ $c->nome }}</h1>

             

                <h3>Telefones</h3>
                @foreach ($c->telefones as $t)

                    {{ $t->telefone }} <br>

                @endforeach

                <h3>Endereços</h3>
                @foreach ($c->enderecos as $e)

                    {{ $e->endereco }}, {{ $e->numero }}, {{ $e->bairro }},
                    {{ $e->cidade }}/{{ $e->uf }} - {{ $e->cep }}<br>

                @endforeach

            </div>

        @empty
           
            <h1 style="text-align: center">Sem contatos cadastrados.</h1>

        @endforelse



    </div>
</body>

</html>
