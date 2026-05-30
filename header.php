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

      <div class="d-flex align-items-center gap-3  mx-2">
        <?php if (isset($_SESSION['usuario_id'])): ?>

          <a class="nav-link text-secondary d-flex align-items-center gap-1 p-1" href="home.php" title="Home">
            <i class="bi bi-house-door-fill fs-5 text-primary"></i>

          </a>

          <a class="nav-link p-0 d-flex align-items-center" href="configuracoes-usuario.php" title="Configurações">
            <?php if ($imgUsuario): ?>
              <img src="<?= $imgUsuario ?>" alt="Avatar" class="rounded-circle shadow-sm" style="width:32px; height:32px; object-fit:cover;">
            <?php else: ?>
              <i class="fas fa-user text-primary fs-5"></i>
            <?php endif; ?>
          </a>

          <a class="nav-link text-danger p-1 d-flex align-items-center" href="#" onclick="document.getElementById('logout-form').submit();" title="Sair">
            <i class="fas fa-sign-out-alt fs-5"></i>
          </a>

        <?php else: ?>
          <a class="btn btn-sm btn-primary fw-bold px-3" href="bemvindo.php"><i class="fas fa-sign-in-alt me-2"></i> Entrar</a>
        <?php endif; ?>
      </div>

      <?php if (isset($_SESSION['usuario_id'])): ?>
        <form id="logout-form" action="backend/logout.php" method="post" style="display: none;"></form>
      <?php endif; ?>

    </div>
    <div class="mt-2 bg-light border-bottom d-flex align-items-center justify-content-center w-100 overflow-hidden shadow-sm mx-3" style="height: 48px; z-index: 1020;">
      <div id="mensagem" class="text-muted text-center px-3 w-100 fw-medium fst-italic" style="font-size: 0.75rem; transition: opacity 0.5s ease-in-out; opacity: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
      </div>
    </div>
  </nav>

  <script>const mensagens = [
    'Que suas aventuras sejam épicas e seus dados sempre favoráveis!',
    'Nunca subestime o poder de um crítico natural.',
    'Até os goblins merecem uma chance... talvez.',
    'A sorte favorece os audaciosos, mas um bom plano nunca é demais.',
    'Em um mundo de fantasia, até os sonhos mais loucos podem se tornar realidade.',
    'A magia está em todo lugar, basta saber onde olhar.',
    'Cada dado lançado é uma nova história esperando para ser contada.',
    'A jornada é tão importante quanto o destino.',
    'Um bom mestre de jogo sabe que a narrativa é mais importante que as regras.',
    'A amizade é o maior tesouro que um aventureiro pode encontrar.',
    'A imaginação é o único limite em um mundo de fantasia.',
    'Role os dados e confie no destino.',
    'Um herói é feito de escolhas e sorte.',
    'A verdadeira aventura começa onde o conforto termina.',
    'Em cada esquina, uma nova história espera para ser descoberta.',
    'Em Alta Fantasia, um dos pilares da Magia é a criatividade.',
    'A diplomacia é tão poderosa quanto a espada.',
    'Nunca subestime o poder de um bom plano de fuga.',
    'A violencia não é a resposta, mas às vezes é a única opção.',
    'Nem todos os monstros são maus, e nem todos os heróis são bons.',
    'Nem todos os vilões podem ser convencidos com palavras.',
    'As vezes o reconhecimento é o maior tesouro que um aventureiro pode encontrar.',
    'Atitudes bondosas podem ser mal vistas em certos lugares.',
    'Mostros se chamam monstros por um motivo.',
    'Anote os nomes dos NPCs, eles podem ser importantes mais tarde.',
    'Sempre leve em conta as intenções daqueles que falam com você.',
    'Violencia gratuíta não é bem vista na grande maioria dos lugares.',
    'Um bom mestre de jogo sabe que ele não está competindo com os jogadores.',
    'A verdadeira magia está na capacidade de contar histórias que unem as pessoas.',
    'Em Alta Fantasia, cada personagem é uma peça fundamental na tapeçaria da aventura.',
    'O caminho fácil nem sempre é o mais divertido.',
    'Nem sempre o inimigo do seu inimigo é seu amigo.',
    'A Progressive Technologies é uma empresa que surgiu do nada, mas que se tornou um dos maiores conglomerados de tecnologia do mundo.',
    'A única diferença entre Alta e o mundo real, é que no mundo real não existem goblins, mas existem pessoas que agem como tais.',
    'Em Alta existem magos que destroem cidades e guerreiros que partem montanhas ao meio.',
    'Antes de Alta ascender, ela era uma criança como qualquer outra.',
    'Resolver um problema com diplomacia também dá XP, e às vezes até mais do que na base da violência.',
    'Porque será que tem uma mancha de sangue na frente desse baú?',
    'Alta Fantasia é balanceado através da força.',
    'Uma noite tão calminha no mar, o que poderia dar errado?',
    'Uma vez teve um infeliz que tentou domar um dragão com uma cenoura.',
    'Vocês ouviram? Um forasteiro vestido de preto foi grosseiro com a Capitã Irina! Precisamos fazer algo a respeito!',
    'As lendas contam que, no topo da montanha mais alta do mundo, Sagarmāthā, reside a Espada do Herói, sobre a sombra de uma Gegenteil...',
    'A magia é a linguagem do universo, e o universo não fala com ignorantes. Agora, tentem não se explodirem desta vez. — Hayla, a Arquimaga Eterna',
    'O primeiro personagem de Alta Fantasia foi um Bardo, que o jogador era Gaúcho! Assim como o Gado, seu criador!',
    'O primeiro mago de Alta Fantasia se chamava Taskir, o gnomo, e sua banda de rock favorita era o Nirvana. Ele foi criado pelo Gui!',
    'O primeiro clérigo de Alta Fantasia era chamado Cassian De Montverre Bastratti, e ele era um tanto, digamos... excêntrico.',
    'O primeiro ninja de Alta Fantasia era um humano, de 2m+ de altura, chamado Tekomo (kkkk), sim, ele era Japonês! Ele foi criado pelo Joaobachi!',
    'O primeiro samurai de Alta Fantasia e segundo personagem criado foi o Jeff, o Herói de Sagarmāthā... Ele foi criado pelo Ike!',
    'Existiam, na Era das Cinzas, 3 poderosas bruxas, uma delas era Sagarmāthā, a Bruxa do Destino, que criou a profecia da Espada do Herói.',
    'Taskir foi o primeiro avatar a morrer em Alta Fantasia, e, seu controlador Peter que vivia na Terra foi o primeiro a se libertar.',
    'Veja mais sobre a campanha oficial de Alta Fantasia em: https://alta-fantasia.ct.ws/campanhas_oficiais.php!'
];

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (typeof mensagens !== 'undefined' && mensagens.length > 0) {
        shuffleArray(mensagens);
    }

    const mensagemEl = document.getElementById('mensagem');

    if (mensagemEl) {
        let index = 0;

        
        mensagemEl.innerHTML = mensagens[index];
        mensagemEl.style.opacity = 1;

        // TRAVA DE SEGURANÇA: Limpa qualquer loop fantasma que tenha ficado para trás
        if (window.loopMensagens) {
            clearInterval(window.loopMensagens);
        }

        // Inicia o ciclo exato de 8 em 8 segundos
        window.loopMensagens = setInterval(() => {
            mensagemEl.style.opacity = 0; // Apaga a atual
            
            setTimeout(() => {
                // Prepara e mostra a próxima após o fade-out do CSS (500ms)
                index = (index + 1) % mensagens.length;
                mensagemEl.innerHTML = mensagens[index];
                mensagemEl.style.opacity = 1;
            }, 500); 

        }, 8000);
    }
});
  </script>