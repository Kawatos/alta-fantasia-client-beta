<?php include('header.php'); ?>

<link rel="stylesheet" href="css/style.css">

<style>
  .hero-section {
    background: linear-gradient(135deg, var(--cor-primaria) 0%, var(--cor-secundaria) 100%);
    min-height: 100vh;
    position: relative;
    overflow: hidden;
  }

  .hero-background {
    position: absolute;
    inset: 0;
    width: 120%;
    height: 120%;
    background: url('css/imagens/banner.jpg') center/cover no-repeat;
    will-change: transform;
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(26, 27, 58, 0.8) 0%, rgba(184, 134, 11, 0.6) 100%);
  }

  .title-dynamic {
    color: var(--cor-fundo-texto-claro) !important;
  }

  .creator-photo {
    width: 120px;
    height: 120px;
    border: 4px solid var(--cor-secundaria);
    box-shadow: 0 4px 15px rgba(184, 134, 11, 0.3);
  }

  .github-btn {
    background: linear-gradient(45deg, #333, #555);
    transition: all 0.3s ease;
  }

  .github-btn:hover {
    background: linear-gradient(45deg, #555, #777);
    transform: translateY(-2px);
    color: white;
  }

  @media (max-width: 767px) {
    .creator-photo {
      width: 100px;
      height: 100px;
    }
  }
</style>

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center text-white">
  <div class="hero-background" id="heroBackground"></div>
  <div class="hero-overlay"></div>

  <div class="container position-relative" style="z-index: 4;">
    <div class="text-center">
      <div class="mb-4" style="height: 70px;">
        <h1 class="display-2 fw-bold mb-4">
          <span class="title-static font-alta">Alta</span>
          <span class="title-dynamic fw-bold" id="fantasiaText">Fantasia</span>
        </h1>
      </div>
      <p class="lead fs-3 mb-4">Um RPG de Mesa Épico e Ambicioso</p>
      <p class="fs-5 mb-5">Mergulhe em um mundo virtual onde a fantasia encontra a realidade</p>

      <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
        <a href="#sobre-projeto" class="btn btn-secondary btn-lg">
          <i class="fas fa-scroll me-2"></i>Descobrir Mais
        </a>
        <a href="https://github.com/Kawatos/alta-fantasia-client-beta"
          class="btn github-btn text-white text-decoration-none rounded-pill px-4 py-2" target="_blank">
          <i class="fab fa-github me-2"></i>Ver no GitHub
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-6 col-md-3">
        <h2 class="display-4 fw-bold text-warning">100</h2>
        <h3 class="text-muted">Níveis Máximos</h3>
      </div>
      <div class="col-6 col-md-3">
        <h2 class="display-4 fw-bold text-warning">18</h2>
        <h3 class="text-muted">Classes Jogáveis</h3>
      </div>
      <div class="col-6 col-md-3">
        <h2 class="display-4 fw-bold text-warning">12</h2>
        <h3 class="text-muted">Raças Disponíveis</h3>
      </div>
      <div class="col-6 col-md-3">
        <h2 class="display-6 fw-bold text-warning">Editor</h2>
        <h3 class="text-muted">Online de Fichas</h3>
      </div>
    </div>
  </div>
</section>

<!-- Sobre o Projeto -->
<section id="sobre-projeto" class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4 p-4">
          <div class="card-body text-center">
            <img src="css/imagens/Foto de Perfil Reduzida.png"
              alt="Foto de Kauã Mattos"
              class="creator-photo rounded-circle object-fit-cover mx-auto d-block mb-4">

            <h2 class="text-primary mb-4">Sobre mim, o Criador</h2>
            <p class="lead mb-4">
              Me chamo <strong>Kauã Mattos</strong>, sou um geek de carteirinha, programador e apaixonado por RPGs de mesa!
            </p>
            <p class="text-muted">
              Também sou fã de Tormenta, D&D e tudo que envolva dados e narração com bons amigos,
              Alta Fantasia é o meu terceiro RPG criado, desenvolvido com o objetivo de superar
              meu primeiro projeto - uma versão home-made de Sword Art Online que,
              infelizmente, nunca teve uma sessão completa com todos os players reunidos.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Desenvolvimento -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card border-0 shadow-lg rounded-4 h-100">
          <div class="card-body text-center p-4">
            <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
              style="width: 60px; height: 60px;">
              <i class="fas fa-rocket text-white fs-4"></i>
            </div>
            <h3 class="text-success mb-4">Desenvolvimento Ambicioso</h3>

            <div class="text-start">
              <div class="border-start border-warning border-3 ps-3 mb-3">
                <h6 class="fw-bold mb-1">Maio 2025</h6>
                <p class="mb-0 small">Início do desenvolvimento do Alta Fantasia</p>
              </div>
              <div class="border-start border-warning border-3 ps-3 mb-3">
                <h6 class="fw-bold mb-1">Proposta Atual</h6>
                <p class="mb-0 small">RPG que vai até o nível 100, balanceado e desafiador</p>
              </div>
              <div class="border-start border-warning border-3 ps-3">
                <h6 class="fw-bold mb-1">Sistema Inovador</h6>
                <p class="mb-0 small">100 pontos de experiência para cada nível - progressão rápida e equilibrada</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card border-0 shadow-lg rounded-4 h-100">
          <div class="card-body text-center p-4">
            <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
              style="width: 60px; height: 60px;">
              <i class="fas fa-dice-d20 text-white fs-4"></i>
            </div>
            <h3 class="text-info mb-4">Sistema de Jogo</h3>

            <ul class="list-unstyled text-start">
              <li class="mb-3">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong>Balanceamento Ativo:</strong> Sem classes super fortes e super fracas
              </li>
              <li class="mb-3">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong>Progressão Rápida:</strong> 100 XP por nível
              </li>
              <li class="mb-3">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong>Desafio Constante:</strong> Para jogadores e mestres
              </li>
              <li class="mb-3">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong>100 Níveis, 10 Ranks:</strong> Jornada épica e duradoura, com progressão paupável
              </li>
              <li class="mb-3">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong>Baseado em d10:</strong> 1d10 a cada 10 níveis ao invés do d20 a campanha inteira
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- História do Mundo -->
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card border-0 shadow-lg rounded-4 p-4">
          <div class="card-body">
            <div class="text-center mb-4">
              <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                style="width: 60px; height: 60px;">
                <i class="fas fa-globe-americas text-white fs-4"></i>
              </div>
              <h2 class="text-warning">O Mundo de Alta Fantasia</h2>
            </div>

            <div class="row g-4">
              <div class="col-md-6">
                <h4 class="text-primary mb-3">🌍 O Cenário</h4>
                <p class="mb-4">
                  Inspirado na narrativa de SAO, Alta Fantasia segue a premissa de jogadores
                  presos em um mundo de Fantasia Online super realista. Uma réplica perfeita
                  do mundo real, construída no ano de <strong>2079</strong>.
                </p>
                <h4 class="text-secondary mb-3">GhostMachines</h4>
                <p>
                  O Projeto Alta, foi criado pela empresa GhostMachines com suporte financeiro de governos,
                  instituições e pessoas ao redor do mundo. Um projeto verdadeiramente global.
                </p>
              </div>
              <div class="col-md-6">
                <h4 class="text-info mb-3">Isekai? Não?</h4>
                <p class="mb-4">
                  Os servidores (sem jogadores) pesam mais de <strong>800 Hexabytes</strong>,
                  abrigando centenas de milhões de habitantes que são IAs Generalistas -
                  basicamente pessoas virtuais, em um mundo virtual basicamente real.
                </p>
                <h4 class="text-danger mb-3">A Trama</h4>
                <p>
                  A história começa no lançamento do jogo, onde os jogadores, após algumas
                  horas jogando, acabam ficando presos dentro do mundo virtual.
                  <em>E o resto da história? Você decide...</em>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Conteúdo do Jogo -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4 p-4">
          <div class="card-body text-center">
            <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
              style="width: 60px; height: 60px;">
              <i class="fas fa-book-open text-white fs-4"></i>
            </div>
            <h2 class="text-secondary mb-4">Conteúdo Sólido</h2>
            <p class="lead mb-4">
              Alta Fantasia possui inicialmente <strong>18 classes jogáveis</strong> e
              <strong>12 raças</strong> únicas para você explorar.
            </p>
            <p class="mb-4">
              Você poderá descobrir mais na Wiki, aqui mesmo no site, incluindo regras detalhadas,
              sistema de dano, magias, mecânicas de acerto e tudo mais que um RPG completo precisa para existir.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-2">
              <span class="badge bg-primary fs-6 px-3 py-2">Classes</span>
              <span class="badge bg-success fs-6 px-3 py-2">Raças</span>
              <span class="badge bg-info fs-6 px-3 py-2">Magias</span>
              <span class="badge bg-warning fs-6 px-3 py-2">Regras</span>
              <span class="badge bg-danger fs-6 px-3 py-2">Sistema de Combate</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Open Source -->
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4 p-4">
          <div class="card-body text-center">
            <div class="bg-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
              style="width: 60px; height: 60px;">
              <i class="fab fa-github text-white fs-4"></i>
            </div>
            <h2 class="mb-4">🚀 Projeto Open Source</h2>
            <p class="lead mb-4">
              Este site é um projeto <strong>Open Source</strong>! Você pode reutilizar
              o sistema para criar a ficha do seu próprio RPG também.
            </p>
            <p class="mb-4">
              Explore o código, contribua com melhorias, ou use como base para seus próprios projetos.
              A comunidade RPG cresce quando compartilhamos conhecimento!
            </p>
            <a href="https://github.com/Kawatos/alta-fantasia-client-beta"
              class="btn github-btn text-white text-decoration-none rounded-pill px-4 py-2" target="_blank">
              <i class="fab fa-github me-2"></i>Ver no GitHub<i class="fas fa-star ms-2"></i>
            </a>
            <p class="mt-3 text-muted small">
              <i class="fas fa-heart text-danger"></i>
              Não esqueça de deixar uma estrelinha se gostar!
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  let fonteDinamicaAtiva = false; // variável persistente fora da função

  function iniciarFonteDinamica(elementId) {
    if (fonteDinamicaAtiva) return; // Proteção real contra múltiplos intervals
    fonteDinamicaAtiva = true;

    const element = document.getElementById(elementId);
    if (!element) return;

    const fonts = [
      'font-alta', 'font-cursive', 'font-times', 'font-script',
      'font-palatino', 'font-elegant', 'font-garamond', 'font-royal',
      'font-book', 'font-century'
    ];
    let currentFont = '';
    let fontIndex = 0;

    setInterval(() => {
      if (currentFont) {
        element.classList.remove(currentFont);
      }

      const nextFont = fonts[fontIndex];
      element.classList.add(nextFont);
      currentFont = nextFont;

      fontIndex = (fontIndex + 1) % fonts.length; // Avança para a próxima fonte, volta ao início se chegar ao fim
    }, 500);
}

  document.addEventListener('DOMContentLoaded', iniciarFonteDinamicaOnce);

  function iniciarFonteDinamicaOnce() {
    document.removeEventListener('DOMContentLoaded', iniciarFonteDinamicaOnce);
    iniciarFonteDinamica('fantasiaText');
  }


  // Parallax simples
  function updateParallax() {
    const scrolled = window.pageYOffset;
    const bg = document.getElementById('heroBackground');
    if (bg) bg.style.transform = `translate3d(0, ${scrolled * 0.3}px, 0)`;
  }

  window.addEventListener('scroll', updateParallax);
</script>


<?php include('footer.php'); ?>