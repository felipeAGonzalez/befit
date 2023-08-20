<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Befit</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </header>
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-xl">
   <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Befit Sport Gym</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleCenteredNav" aria-controls="navbarsExampleCenteredNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      @auth
      <div class="collapse navbar-collapse navbar-collapse justify-content-md-end" id="navbarsExampleCenteredNav">
         <ul class="navbar-nav">
            <!-- <li class="nav-item active">
               <a class="nav-link" href="{{ url('/') }}">Inicio<span class="sr-only">(current)</span></a>
            </li> -->
            <li class="nav-item active">
               <a class="nav-link" href="{{ url('/sales') }}">Ventas<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ url('/clients') }}">Clientes</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ url('/services') }}">Servicios</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ url('/users') }}">Usuarios</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ url('/products') }}">Productos</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                <li class="nav-item">
                   <a class="nav-link" href="{{ url('/logout') }}">Cerrar Sesión</a>
                </li>
               @endauth
            </li>
         </ul>
      </div>
   </div>
</nav>
    <main class="container mt-4">
        @yield('content')
    </main>
</body>
</html>
