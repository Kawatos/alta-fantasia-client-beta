<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Alta Fantasia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Estilos e bibliotecas compartilhadas -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Genos:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=WDXL+Lubrifont+JP+N&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital@1&family=Great+Vibes&family=Lora:ital@1&family=Merriweather&family=Libre+Baskerville:ital@1&family=Satisfy&family=Spectral&family=Cormorant+Garamond&family=UnifrakturCook&family=Dancing+Script&display=swap" rel="stylesheet">

  <!-- Scripts jQuery e Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="css/style.css">
  <!-- Scripts personalizados -->
  <script src="js/script.js" defer></script>
</head>


<body class="h-100" style="height: 100vh;">
  <nav class="navbar navbar-expand-lg navbar-white bg-white">
    <div class="container-fluid">
      <a class="navbar-brand" href="alta.php">
        <h1 class="h3 fw-bold text-primary">
          <span class="font-alta">Alta</span>
          <span class="font-fantasia fw-bold" id="">Fantasia</span>
        </h1>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="alta.php">Sobre Alta Fantasia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="wiki.php">Wiki</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="comunidade.php">Comunidade</a>
          </li>

          <?php if (isset($_SESSION['usuario_id'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="editor.php">Editor de Personagens</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="configuracoes-usuario.php" title="Configurações">
                <span><i class="fas fa-user"></i></span>
              </a>

            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="#" onclick="document.getElementById('logout-form').submit();" title="Sair">
                <i class="fas fa-sign-out-alt"></i>
              </a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="bemvindo.php">Entrar/Cadastrar</a>
            </li>
          <?php endif; ?>
        </ul>

      </div>
      <?php if (isset($_SESSION['usuario_id'])): ?>
        <form id="logout-form" action="backend/logout.php" method="post" style="display: none;"></form>
      <?php endif; ?>

    </div>
  </nav>