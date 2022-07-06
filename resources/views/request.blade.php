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
    
    <!-- Modal -->
    <div class="modal fade" id="requestInfoFormPopup" tabindex="-1" aria-labelledby="requestInfoFormPopupLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="requestInfoFormPopupLabel">Dados Adicionais</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addictional-req-info">
                <div class="modal-body">
                    <label for="payment_method" class="form-label">Método de pagamento</label>
                    <select id="payment_method" class="form-select" aria-label="Default select example">
                        <option selected disabled>Selecione seu modo de pagamento</option>
                        <option value="pix">Pix</option>
                        <option value="card">Cartão</option>
                        <option value="coin">Dinheiro</option>
                    </select>
                    <div class="mt-3">
                        <div class="form-floating">
                            <input id="table_number" type="number" class="form-control" id="floatingCpf" 
                                placeholder="Digite o número da sua mesa" required>
                            <label for="floatingCpf">Digite o número da sua mesa</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-send-request">
                        <span class="title">Enviar pedido</span>
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <main class="container-fluid">
        <section class="products">
            @foreach ($products as $prod)
            <div class="product" id="{{$prod->id}}">
                <h2>{{ $prod->name }}</h2>
                <div class="product-body">
                    <img class="box" src="{{$prod->img_url}}" alt="{{$prod->description}} image">
                    <div class="product-controls">
                        <p class="price">@to_currency($prod->price)</p>
                        <button class="btn btn-success">
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
            <button class="btn btn-success btn-finish-request" data-bs-toggle="modal" data-bs-target="#requestInfoFormPopup" disabled>
                <span class="title">Finalizar pedido</span>
            </button>
        </div>
    </div>
    <script src="/js/spinner.js"></script>
    <script type="module" src="/js/request.js"></script>
</body>

</html>
