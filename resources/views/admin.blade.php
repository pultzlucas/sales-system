<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junete Churrasco | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <main class="container">
        <ul class="requests">
            @foreach ($requests as $req)
            <li id="{{$req->id}}">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td><strong>Número</strong></td>
                                <td>{{$req->id}}</td>
                            </tr>
                            <tr>
                                <td><strong>Preço total</strong></td>
                                <td><span class="request-total-price">@to_currency($req->total_price)</span></td>
                            </tr>
                            <tr>
                                <td><strong>Pedido feito em</strong></td>
                                <td>{{$req->created_at}}</td>
                            </tr>
                        </table>
                        
                        <div class="accordion-item request-items">
                            <h3 class="accordion-header" id="heading_1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_1" aria-expanded="false"
                                    aria-controls="collapse_1">
                                    <strong>Itens do Pedido</strong>
                                </button>
                            </h3>
                            <div id="collapse_1" class="accordion-collapse collapse"
                                aria-labelledby="heading_1" data-bs-parent="#routesAccordion">
                                <div class="accordion-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Descrição</th>
                                            <th>Preço</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($req->items as $item)
                                            <tr class="request-item">
                                                <td>{{$item->description}}</td>
                                                <td>@to_currency($item->price)</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="request-controls">
                            <button onclick="confirmRequest(this.parentNode.parentNode.parentNode.parentNode)" class="btn btn-success">Aceitar</button>
                            <button onclick="denyRequest(this.parentNode.parentNode.parentNode.parentNode)" class="btn btn-danger">Negar</button>
                        </div>
                    </div>
                </div>
            </li>     
            @endforeach
        </ul>
    </main>
    <script src="/js/admin/confirmation.js"></script>
</body>

</html>
