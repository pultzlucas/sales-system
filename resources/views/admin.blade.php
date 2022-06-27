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
        <h1>Pedidos</h1>

        <ul class="nav nav-tabs mt-2">
            <li class="nav-item">
                <button type="button" id="state_1" class="nav-link active">Confirmação</button>
            </li>
            <li class="nav-item">
                <button type="button" id="state_2" class="nav-link">Em preparo</button>
            </li>
            <li class="nav-item">
                <button type="button" id="state_3" class="nav-link">Prontos</button>
            </li>
            <li class="nav-item">
                <button type="button" id="state_4" class="nav-link">Entregues</button>
            </li>
            <li class="nav-item">
                <button type="button" id="state_0" class="nav-link">Negados</button>
            </li>
        </ul>
        <div class="d-flex justify-content-center">
            <div class="spinner-border mt-3" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
        <p class="request-list-placeholder" hidden>Nenhum pedido</p>
        <ul class="requests"></ul>
    </main>

    <script type="module" src="/js/admin/load-requests.js"></script>
    <script src="/js/spinner.js"></script>
    <script src="/js/admin/request-controls.js"></script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-app.js";
        import { getDatabase, ref, set } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries
      
        // Your web app's Firebase configuration
        const firebaseConfig = {
          apiKey: "AIzaSyD321D2bwStA_ceuFvUXAynXTa5l2KIsis",
          authDomain: "juneterealtimedb.firebaseapp.com",
          databaseURL: "https://juneterealtimedb-default-rtdb.firebaseio.com",
          projectId: "juneterealtimedb",
          storageBucket: "juneterealtimedb.appspot.com",
          messagingSenderId: "787964355463",
          appId: "1:787964355463:web:54154b7b534f6f87a36922"
        };
      
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const db = getDatabase()
        // set(requests)
        
        function addRequestToDatabase(request) {
            const requests = ref(db, `/requests/${request.id}`)
            set(requests, request)
        }

        addRequestToDatabase({
            id: 2,
            state: 1
        })

      </script>
</body>

</html>
