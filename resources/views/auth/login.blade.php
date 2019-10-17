<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <style media="screen">

      body { height: 100vh; }

      main {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      input, button { padding: 1em; }

      .title { font-size: 4em; }

      #wrapper { width: 30%; }

      @media (max-width: 770px) {

        #wrapper { width: 100%; }

        #title { font-size: 3em; }

      }

    </style>
  </head>
  <body>
    <main>
      <div id="wrapper">
      
        <div class="row justify-content-center">
          <h1 class="title text-center">My kanban</h1>
        </div>

        <div class="divide"></div>

        <div class="row justify-content-center">
          <form method="post" action="{{ route('login') }}">

            @if($errors->any())
            <div style="margin: 0 1em;">
              <i class="text-red fas fa-exclamation-circle"></i>
              &nbsp;<b class="text-red">O email ou senha está incorreto!</b>
            </div>
            @endif

            <div class="input-group">
              <div class="input-group-label">
                <span class="fas fa-user"></span>
              </div>
              <input type="email" name="email" class="input-control" placeholder="E-Mail" value="{{ old('email') }}">
            </div>
            <div class="input-group">
              <div class="input-group-label">
                <span class="fas fa-lock"></span>
              </div>
              <input type="password" name="password" class="input-control" placeholder="Password">
            </div>

            @csrf

            <div class="form-group">
              <button type="submit" name="button" class="btn btn-block btn-blue">Login</button>
            </div>
            
          </form>
        </div>
      </div>

    </main>
  </body>
</html>