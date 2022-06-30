<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junete Churrasco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <main class="container">
        @if ($request_info)
        <section class="request-view" id="{{$request_info->id}}">
            <h1>Pedido</h1>
            <table class="table">
                <tr>
                    <td><strong>Número</strong></td>
                    <td class="request-id">{{$request_info->id}}</td>
                </tr>
                <tr>
                    <td><strong>Status do pedido</strong></td>
                    <td class="request_status" id="{{$request_info->state}}"><strong>@translate_status($request_info->state)</strong></td>
                </tr>
                <tr>
                    <td><strong>Preço total</strong></td>
                    <td><span class="request-total-price">@to_currency($request_info->total_price)</span></td>
                </tr>
                <tr>
                    <td><strong>Pedido feito em</strong></td>
                    <td>{{$request_info->created_at}}</td>
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
                            @foreach ($request_info->items as $item)
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
            <button onclick="deleteRequest(this)" class="btn btn-danger btn-cancel-request">Cancelar pedido</button>
        </section>
        @endif

        @if (!$request_info)
        <a class="btn btn-secondary" href="/request">Fazer pedido</a>
        @endif

        <a class="btn btn-secondary" href="/menu">Ver Cardápio</a>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          $('.alert').alert()
        })
    </script>
    <script src="/js/index.js"></script>
    <script src="/js/utils/color-rq-state.js"></script>
    <script type="module" src="/js/firebase/index.js"></script>
</body>

</html>
