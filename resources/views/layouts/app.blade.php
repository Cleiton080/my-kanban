<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Metas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Links / Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <style media="screen">

      .fa-star { color: #f4a121; }

      .fa-project-diagram { color: #46C5D9; }

      .fa-users { color: #FFEAC4; }

    </style>

    @yield('css')

    <!-- .Links / Styles -->
  </head>
  <body>
    <main>

      <div class="d-flex">

        <!-- Nav -->
        <aside class="nav nav-show">
          <div class="nav-head">
            <div class="nav-brand">
              <h4 class="title">My kanban</h4>
            </div>
            <div class="nav-user">
              <img src="http://www.urhobosocialclublagos.com/wp-content/uploads/2017/07/default-avatar-ginger-guy.png" class="user-profile">
              <p>{{ Auth::user()->name }} <br> {{ Auth::user()->email }} </p>
            </div>
          </div>

          <ul class="nav-body">
            <a href="/" class="nav-link">
              <li class="nav-item">
                <i class="fas fa-project-diagram"></i> &nbsp;Projetos
              </li>
            </a>
            <a href="/favorite" class="nav-link">
              <li class="nav-item">
                <i class="fas fa-star"></i> &nbsp;Favoritos
              </li>
            </a>
            <li class="nav-item">
              <i class="fas fa-users"></i> &nbsp;Equipes
            </li>
            <li class="nav-item" onclick="modal.open('github')">
              <i class="fab fa-github"></i> &nbsp;Github
            </li>
          </ul>

          <div class="nav-swipe">
            <i class="fas fa-angle-right"></i>
          </div>
        </aside>
        <!-- .Nav -->

        <div class="row">

          <!-- Navbar -->
          <nav class="navbar">
            <ul class="navbar-menu">
              <li class="navbar-item dropdown">
                <a href="#" class="navbar-link"> {{ Auth::user()->name }} &nbsp;<i class="fas fa-angle-down"></i></a>
                <ul class="dropdown-menu" style="top: 3.6em; right: 0;">
                  <li>Configurações</li>
                  <li>Ajuda</li>
                  <li>Sair</li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- .Navbar -->

          <section class="container">
            @yield('content')
          </section>

        </div>
      </div>

    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>

      // Show / Hidden side nav
      const nav = new Nav('.nav');
      document.querySelector('.nav-swipe').addEventListener('click', function() { nav.click() });

    </script>

    @yield('script')
    <!-- .Scripts -->

  </body>
</html>