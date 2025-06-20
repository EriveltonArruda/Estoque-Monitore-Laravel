<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Controle de Estoque</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #f4f6f9;
    }

    .header-login {
      background-color: #343a40;
      color: white;
      padding: 1rem 1.5rem;
    }

    .main-content {
      flex-grow: 1;
    }

    .login-container {
      width: 100%;
      max-width: 420px;
    }

    .footer-login {
      background-color: #ffffff;
      padding: 1rem 1.5rem;
      font-size: 0.9rem;
      color: #6c757d;
      border-top: 1px solid #dee2e6;
    }
  </style>
</head>

<body>

  <header class="header-login">
    <h5><b>Estoque Monitore</b> <small class="fw-light">| Controle e Gestão de Produtos</small></h5>
  </header>

  <main class="main-content d-flex align-items-center justify-content-center">
    <div class="login-container card p-4 shadow-sm">
      <h3 class="card-title text-center mb-3">
        {{-- Ícone de usuário em SVG --}}
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
          class="bi bi-person-circle mb-1" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
          <path fill-rule="evenodd"
            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
        </svg>
        Login do Usuário
      </h3>

      {{-- Espaço para futuros erros de login --}}
      @if ($errors->any())
        <div class="alert alert-danger py-2" role="alert">
          {{-- Pega a primeira mensagem de erro da lista e a exibe --}}
          {{ $errors->first() }}
        </div>
      @endif


      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required
            autofocus>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="showPassword">
          <label class="form-check-label" for="showPassword">Mostrar Senha</label>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <a href="#">Esqueceu a senha?</a>
          <button type="submit" class="btn btn-dark">Login</button>
        </div>
      </form>
    </div>
  </main>

  <footer class="footer-login d-flex justify-content-between">
    <div>Copyright © 2021-2025 - Sua Empresa</div>
    <div>Pode colocar um link aqui - E aqui também</div>
  </footer>

  <script>
    // Script para a funcionalidade "Mostrar Senha"
    const showPasswordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
      // Se o checkbox estiver marcado, muda o tipo do input para 'text', senão, volta para 'password'
      passwordInput.type = this.checked ? 'text' : 'password';
    });
  </script>

</body>

</html>
