<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/request.css">
</head>
<body>
    <main class="container-fluid">
        <section class="products">
            @foreach ($products as $prod)
            <div class="product" id="{{$prod->id}}">
                <h2>{{ $prod->description }}</h2>
                <div class="product-body">
                    <img class="box" src="{{$prod->img_url}}" alt="{{$prod->description}} image">
                    <div class="product-controls">
                        <p class="price">@to_currency($prod->price)</p>
                        <button onclick="addToRequest({{$prod->id}}, this)" class="btn btn-success">
                            <span class="title">Adicionar ao pedido</span>
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
        </section>
    </main>
    <div class="request-view">
        <div class="request-items"><p>Seu pedido está vazio</p></div>

        <div class="request-view-controls">
            <div class="total-view">
                <h4>Total R$</h4>
                <span class="total">0,00</span>
            </div>
            <button onclick="finishRequest(this)" class="btn btn-success btn-finish-request" disabled>
                <span class="title">Finalizar pedido</span>
            </button>
        </div>
    </div>
    <script src="/js/request.js"></script>
</body>

</html>
