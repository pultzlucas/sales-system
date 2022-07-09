<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
    <link rel="stylesheet" href="/css/request-history.css">
</head>
<body>
    <header>
        <a href="/dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </a>
        <h1>Histórico</h1>
        <hr>
    </header>
    <main class="container">
        @if(!$requests)
        <span class="requests-placeholder">Você ainda não fez nenhum pedido</span>
        @endif

        @if($requests)
        @foreach($requests as $request)
            <div class="request" id="{{$request->id}}">
                <table class="table">
                    <tr>
                        <td><strong>Número</strong></td>
                        <td class="request-id">{{$request->id}}</td>
                    </tr>
                    <tr>
                        <td><strong>Status do pedido</strong></td>
                        <td class="request_status" id="{{$request->state}}"><strong>@translate_status($request->state)</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Nº da mesa</strong></td>
                        <td>{{$request->table_number}}</td>
                    </tr>
                    <tr>
                        <td><strong>Preço total</strong></td>
                        <td><span class="request-total-price">@to_currency($request->total_price)</span></td>
                    </tr>
                    <tr>
                        <td><strong>Método de pagamento</strong></td>
                        <td><span class="request-payment" data-payment="{{$request->payment}}">@translate_payment($request->payment)</span></td>
                    </tr>
                    <tr>
                        <td><strong>Pedido feito em</strong></td>
                        <td>{{$request->created_at}}</td>
                    </tr>
                </table>
            
                <div class="accordion-item request-items">
                    <h3 class="accordion-header" id="heading_{{$request->id}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_{{$request->id}}" aria-expanded="false"
                            aria-controls="collapse_{{$request->id}}">
                            <strong>Itens do Pedido</strong>
                        </button>
                    </h3>
                    <div id="collapse_{{$request->id}}" class="accordion-collapse collapse"
                        aria-labelledby="heading_{{$request->id}}" data-bs-parent="#routesAccordion">
                        <div class="accordion-body">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($request->items as $item)
                                    <tr class="request-item">
                                        <td>{{$item->name}}</td>
                                        <td>@to_currency($item->price)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        @endif          
    </main>
    <script src="/js/utils/color-rq-state.js"></script>
</body>

</html>
