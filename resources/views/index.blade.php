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
    <main class="container">
        <h1>Junete - Churrasco</h1>
        <div class="card">
            <div class="card-body">
                <form action="/api/login" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input id="cpf_input" type="number" class="form-control" name="cpf" id="floatingCpf" placeholder="Digite seu CPF" required>
                        <label for="floatingCpf">Digite seu CPF</label>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-success btn-ok">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="/js/index.js"></script>
</body>

</html>
