<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <script src="/js/jquery-3.3.1.slim.min.js"></script>

    <script src="/js/popper.min.js"></script>

    <title>Site</title>
</head>

<body>

<!--Debut Bar de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#"><h1>Alert securite</h1></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="acceuil">Acceuil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="form">Signaler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">A propos</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
@yield('content');

<!-- JavaScript-->

<script type="text/javascript" src="/js/app.js"></script>
<script src="/js/bootstrap.js"></script>
</body>

</html>