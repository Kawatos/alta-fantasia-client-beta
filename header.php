<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$imgUsuario = null;

// Supondo que você já tenha o nome do arquivo na sessão
if (!empty($_SESSION['imagem'])) {
  $caminhoImagem = 'backend/uploads_usuario/' . $_SESSION['imagem'];
  if (file_exists($caminhoImagem)) {
    $imgUsuario = $caminhoImagem;
  }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Alta Fantasia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="AltaFantasiaIconRounded.png" type="image/png">

  <link rel="manifest" href="/manifest.json">

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

  <script>
    if (typeof navigator.serviceWorker !== 'undefined') {
      navigator.serviceWorker.register('pwabuilder-sw.js')
    }
  </script>

</head>


<body class="h-100" style="height: 100vh;" data-user-id="<?php echo $_SESSION['usuario_id'] ?? ''; ?>">

  <nav class="navbar bg-white sticky-top shadow-sm py-2">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a class="navbar-brand me-0" href="alta.php">
        <h1 class="h4 fw-bold text-primary mb-0">
          <span class="font-alta">Alta</span>
          <span class="font-fantasia fw-bold">Fantasia</span>
        </h1>
      </a>

      <div class="d-flex align-items-center gap-3 mx-2">
        <?php if (isset($_SESSION['usuario_id'])): ?>

          <div class="dropdown">
            <a class="nav-link p-0 d-flex align-items-center dropdown-toggle no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu do Usuário">
              <?php if ($imgUsuario): ?>
                <img src="<?= $imgUsuario ?>" alt="Avatar" class="rounded-circle shadow-sm" style="width:32px; height:32px; object-fit:cover;">
              <?php else: ?>
                <i class="fas fa-user text-primary fs-5"></i>
              <?php endif; ?>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="home.php">
                  <i class="bi bi-house-door-fill text-primary fs-5"></i>
                  <span>Início</span>
                </a>
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="configuracoes-usuario.php">
                  <i class="fas fa-user-cog text-secondary fs-5" style="width: 20px; text-align: center;"></i>
                  <span>Editar Perfil</span>
                </a>
              </li>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt fs-5" style="width: 20px; text-align: center;"></i>
                  <span>Sair</span>
                </a>
              </li>
            </ul>
          </div>

        <?php else: ?>
          <a class="btn btn-sm btn-primary fw-bold px-3" href="bemvindo.php"><i class="fas fa-sign-in-alt me-2"></i> Entrar</a>
        <?php endif; ?>
      </div>

      <?php if (isset($_SESSION['usuario_id'])): ?>
        <form id="logout-form" action="backend/logout.php" method="post" style="display: none;"></form>
      <?php endif; ?>

    </div>


  </nav>