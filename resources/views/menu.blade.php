<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/menu.css">
</head>
<body>
    <main class="container">
    <h1>Cardápio</h1>
    <div class="products">
        @foreach ($products as $prod)
        <div class="product">
            <h2>{{ $prod->name }}</h2>
            <img class="box" src="{{$prod->img_url}}" alt="{{$prod->name}} image">
            <span class="price box">@to_currency($prod->price)</p>
            <p>{{$prod->description}}</p>
        </div>
        @endforeach
    </div>
</body>

</html>
