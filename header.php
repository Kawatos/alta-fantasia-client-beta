<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$imgUsuario = null;

if (!empty($_SESSION['imagem'])) {
  $caminhoImagem = 'backend/uploads_usuario/' . $_SESSION['imagem'];
  if (file_exists($caminhoImagem)) {
    $imgUsuario = $caminhoImagem;
  }
}
$isLoggedIn = !empty($_SESSION['usuario_id']);
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

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/alta-landing.css">
  <link rel="stylesheet" href="css/alta-app.css">

  <script>
    if (typeof navigator.serviceWorker !== 'undefined') {
      navigator.serviceWorker.register('pwabuilder-sw.js')
    }
  </script>
</head>

<body class="h-100 <?= htmlspecialchars($bodyClass ?? 'af-page af') ?>" data-user-id="<?php echo $_SESSION['usuario_id'] ?? ''; ?>">

  <nav class="navbar sticky-top shadow-sm py-2">
    <div class="container-fluid d-flex align-items-center justify-content-between position-relative">

      <a class="navbar-brand me-0" href="#landing" data-af-view-trigger="landing" title="Alta Fantasia">
        <h1 class="h4 fw-bold text-primary mb-0">
          <span class="font-alta">Alta</span>
          <span class="font-fantasia fw-bold">Fantasia</span>
        </h1>
      </a>

      <ul class="af-nav d-none d-lg-flex" id="afMainNav">
        <li class="af-nav-landing"><a href="#sistema">Sistema</a></li>
        <li class="af-nav-landing"><a href="#mundo">O Mundo</a></li>
        <li class="af-nav-landing"><a href="#equipe">Comunidade</a></li>
        
        <li class="af-nav-app d-none"><a href="#landing" data-af-view-trigger="landing"><i class="fas fa-compass me-1"></i> Apresentação</a></li>
        
        <!-- Painel RPG: sempre visível, spa-router gerencia auth se não estiver logado -->
        <li>
          <a href="#app" data-af-view-trigger="app">
            <i class="fas fa-dice-d20 me-1" style="color: var(--af-gold-soft);"></i> Painel RPG
          </a>
        </li>

        <li><a href="#wiki" data-af-view-trigger="wiki"><i class="fas fa-book me-1"></i> Wiki</a></li>
      </ul>

      <div class="d-flex align-items-center gap-3 mx-2">
        <button class="af-burger d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#afMenu" aria-controls="afMenu" aria-expanded="false" aria-label="Abrir menu">
          <span></span><span></span><span></span>
        </button>

        <!-- Dropdown do Usuário (Apenas Desktop - no Mobile fica unificado no afMenu) -->
        <div class="dropdown af-user-menu <?= $isLoggedIn ? 'd-none d-lg-block' : 'd-none' ?>" id="afUserDropdown">
          <a class="nav-link p-0 d-flex align-items-center dropdown-toggle no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu do Usuário">
            <img id="afUserAvatarImg" src="<?= $imgUsuario ?? '' ?>" alt="Avatar" class="rounded-circle shadow-sm <?= empty($imgUsuario) ? 'd-none' : '' ?>" style="width:34px; height:34px; object-fit:cover; border: 1px solid var(--af-gold-soft);">
            <i id="afUserAvatarIcon" class="fas fa-user text-primary fs-5 <?= !empty($imgUsuario) ? 'd-none' : '' ?>"></i>
          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
            <li class="m-2">
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#app" data-af-view-trigger="app">
                <i class="fas fa-dice-d20 text-primary fs-5" style="width: 20px; text-align: center;"></i>
                <span>Painel RPG</span>
              </a>
            </li>

            <li class="m-2">
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#wiki" data-af-view-trigger="wiki">
                <i class="fas fa-book text-warning fs-5" style="width: 20px; text-align: center;"></i>
                <span>Wiki do Sistema</span>
              </a>
            </li>

            <li class="m-2">
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#landing" data-af-view-trigger="landing">
                <i class="fas fa-compass text-secondary fs-5" style="width: 20px; text-align: center;"></i>
                <span>Apresentação</span>
              </a>
            </li>

            <li class="m-2">
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#" data-bs-toggle="modal" data-bs-target="#userConfigModal">
                <i class="fas fa-user-cog text-secondary fs-5" style="width: 20px; text-align: center;"></i>
                <span>Editar Perfil</span>
              </a>
            </li>

            <li class="m-2">
              <hr class="dropdown-divider">
            </li>

            <li class="m-2">
              <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger af-spa-logout" href="#" id="afLogoutBtn">
                <i class="fas fa-sign-out-alt fs-5" style="width: 20px; text-align: center;"></i>
                <span>Sair</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- Botão Entrar (Desktop e Mobile Visitante) -->
        <button type="button" class="btn btn-sm btn-primary fw-bold px-3 af-auth-btn <?= $isLoggedIn ? 'd-none' : '' ?>" id="afAuthBtn" data-auth-open="login">
          <i class="fas fa-sign-in-alt me-2"></i> Entrar
        </button>
      </div>

      <!-- Menu Mobile Unificado (Overlay Flutuante - Não empurra o conteúdo) -->
      <div class="collapse af-mobile-menu d-lg-none" id="afMenu">
        
        <!-- Cartão do Usuário (se logado) -->
        <div class="af-user-menu <?= !$isLoggedIn ? 'd-none' : 'd-flex' ?> p-3 rounded-3 align-items-center gap-3" style="background: rgba(255, 255, 255, 0.08); border: 1px solid var(--af-glass-border);">
          <img id="afMobileUserAvatar" src="<?= $imgUsuario ?? '' ?>" alt="Avatar" class="rounded-circle shadow-sm <?= empty($imgUsuario) ? 'd-none' : '' ?>" style="width:42px; height:42px; object-fit:cover; border: 2px solid var(--af-gold-soft);">
          <i id="afMobileUserIcon" class="fas fa-user-circle text-warning fs-1 <?= !empty($imgUsuario) ? 'd-none' : '' ?>"></i>
          <div class="overflow-hidden flex-grow-1">
            <div class="fw-bold text-white text-truncate" id="afMobileUsername"><?= htmlspecialchars($_SESSION['username'] ?? 'Aventureiro') ?></div>
            <small class="text-success d-flex align-items-center gap-1.5 mt-0.5" style="font-size: 0.74rem;"><span class="rounded-circle bg-success d-inline-block" style="width: 7px; height: 7px;"></span> Conectado</small>
          </div>
        </div>

        <!-- Links da Apresentação (visíveis na landing) -->
        <div class="af-mobile-landing d-flex flex-column gap-2">
          <a href="#sistema" data-bs-toggle="collapse" data-bs-target="#afMenu"><i class="fas fa-dice-d20"></i> Sistema</a>
          <a href="#mundo" data-bs-toggle="collapse" data-bs-target="#afMenu"><i class="fas fa-globe-americas"></i> O Mundo</a>
          <a href="#equipe" data-bs-toggle="collapse" data-bs-target="#afMenu"><i class="fas fa-users"></i> Comunidade</a>
        </div>

        <!-- Links de Navegação SPA (visíveis no app/wiki) -->
        <div class="af-mobile-app d-none flex-column gap-2">
          <a href="#landing" data-af-view-trigger="landing"><i class="fas fa-compass"></i> Apresentação</a>
        </div>

        <!-- Wiki Oficial (compartilhado em todas as visões) -->
        <div class="d-flex flex-column gap-2">
          <a href="#wiki" data-af-view-trigger="wiki"><i class="fas fa-book"></i> Wiki do Sistema</a>
        </div>

        <!-- Ações do Usuário Logado -->
        <div class="af-user-menu <?= !$isLoggedIn ? 'd-none' : 'd-flex' ?> flex-column gap-2">
          <a href="#app" data-af-view-trigger="app" class="af-mobile-menu__cta"><i class="fas fa-dice-d20"></i> Painel RPG</a>
          <a href="#" data-bs-toggle="modal" data-bs-target="#userConfigModal"><i class="fas fa-user-cog"></i> Editar Perfil</a>
          <a href="#" class="af-mobile-menu__danger af-spa-logout" id="afMobileLogoutBtn"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </div>

        <!-- Ações do Visitante -->
        <div class="af-auth-btn <?= $isLoggedIn ? 'd-none' : 'd-flex' ?> flex-column gap-2">
          <a href="#app" class="af-mobile-menu__cta" data-af-view-trigger="app"><i class="fas fa-scroll"></i> Vamos lá!</a>
        </div>
      </div>

    </div>
  </nav>

  <?php
  include __DIR__ . '/auth-modal.php';
  include __DIR__ . '/user-config-modal.php';
  ?>