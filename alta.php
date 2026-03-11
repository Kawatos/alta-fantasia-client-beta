<?php include('header.php'); ?>

<link rel="stylesheet" href="css/style.css">

<style>
  /* Ajuste para o container pai */
  /* 1. Ajuste nas Seções: Elas agora servem como janelas */
  .hero-section,
  .outra-secao-com-fundo {
    position: relative;
    min-height: fit-content;

    overflow: hidden;
    /* Cria a "janela" que recorta o fundo fixo */
    clip-path: inset(0 0 0 0);
  }

  /* 2. Ajuste nos Backgrounds: Eles ficam presos dentro da janela */
  .heroBackground {
    position: fixed;
    /* Trava a imagem na tela */
    inset: 0;
    /* Ocupa a tela toda */
    width: 100%;
    min-height: fit-content;
    height: 100vh;
    background-size: cover;
    background-position: center;
    z-index: -1;
    pointer-events: none;
    /* Importante: a imagem só aparece quando o clip-path do pai permite */
  }

  .card {
    background-color: rgba(255, 255, 255, 0.8);
  }

  /* IDs específicos para as imagens */
  #hero-background1 {
    background-image: url('css/imagens/templo.jpg');
  }

  #hero-background2 {
    background-image: url('css/imagens/AFP6.jpg');
  }

  #hero-background3 {
    background-image: url('css/imagens/AFP3.jpg');
  }

  #hero-background4 {
    background-image: url('css/imagens/AFP4.jpg');
  }

  /* 3. Seções de transição (Stats, Desenvolvimento) */
  /* Elas precisam ter fundo sólido e z-index alto para "tampar" as imagens fixas */
  .bg-light {
    position: relative;
    z-index: 2;
    /* importante para ficar acima do parallax */
    background-color: #f8f9fa !important;
    height: 25vh;
    overflow: visible;
  }

  /* fade superior */
  .bg-light::before {
    content: "";
    position: absolute;
    left: 0;
    top: -10%;
    width: 100%;
    height: 10%;
    pointer-events: none;
    z-index: 3;
    background: linear-gradient(to bottom, rgba(248, 249, 250, 0) 0%, #f8f9fa 100%);
  }

  /* fade inferior */
  .bg-light::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -10%;
    /* aqui está o ponto chave */
    width: 100%;
    height: 10%;
    pointer-events: none;
    z-index: 3;
    background: linear-gradient(to top, rgba(248, 249, 250, 0) 0%, #f8f9fa 100%);
  }

  /* Garante que o conteúdo da hero fique acima do fundo fixo */
  .hero-section .container {
    min-height: fit-content;
    height: 70vh;
    display: flex;
    z-index: 4;
    align-content: center;
    justify-content: center;
    align-items: center;
    margin-top: 10vh;
    margin-bottom: 10vh;
    position: relative;

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


  .tituloInicial {
    text-shadow: 2px 1px 2px rgba(0, 0, 0, 0.25);
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
  <div class=" heroBackground" id="hero-background1"></div>
  <div class="hero-overlay"></div>

  <div class="container position-relative" style="z-index: 4;">
    <div class="text-center">
      <div class="mb-4" style="height: 70px;">
        <h1 class="display-2 fw-bold mb-4">
          <span class="title-static font-alta tituloInicial">Alta</span>
          <span class="title-dynamic fw-bold tituloInicial" id="fantasiaText">Fantasia</span>
        </h1>
      </div>
      <p class="lead fs-3 mb-4 tituloInicial">Um RPG de Mesa Épico e Ambicioso</p>
      <p class="fs-5 mb-5 tituloInicial">Mergulhe em um mundo virtual onde a fantasia encontra a realidade</p>

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
<section class="py-5 bg-light" style="height: fit-content;">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-6 col-md-3">
        <h2 class="display-4 fw-bold text-warning">+100</h2>
        <h3 class="text-muted">Níveis Máximos</h3>
      </div>
      <div class="col-6 col-md-3">
        <h2 class="display-4 fw-bold text-warning">+18</h2>
        <h3 class="text-muted">Classes Jogáveis</h3>
      </div>
      <div class="col-6 col-md-3">
        <h2 class="display-4 fw-bold text-warning">+12</h2>
        <h3 class="text-muted">Raças Disponíveis</h3>
      </div>
      <div class="col-6 col-md-3">
        <h2 class="display-4 fw-bold text-warning">+Editor</h2>
        <h3 class="text-muted">Online de Fichas</h3>
      </div>
    </div>
  </div>
</section>


<section class="hero-section d-flex align-items-center text-white">
  <div class="heroBackground" id="hero-background2"></div>
  <div class="hero-overlay"></div>

  <div class="container position-relative" style="z-index: 1;">
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














<!-- Stats Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-12 text-center">
        <h2 class="display-4 fw-bold text-warning">O Mundo de Alta Fantasia</h2>
        <h3 class="text-muted">Níveis Máximos</h3>
      </div>
    </div>
  </div>
</section>





<section class="hero-section d-flex align-items-center text-white">
  <div class="heroBackground" id="hero-background3"></div>
  <div class="hero-overlay"></div>

  <div class="container position-relative" style="z-index: 4;">
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
                <h4 class="text-secondary mb-3">Progressive Technologies</h4>
                <p>
                  O Projeto Alta, foi criado pela empresa Progressive Technologies com suporte financeiro de governos,
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








<!-- Stats Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-12 text-center">
        <h2 class="display-4 fw-bold text-warning">Quem Faz o Alta</h2>
        <h3 class="text-muted">Eu e meus jogadores</h3>
      </div>
    </div>
  </div>
</section>

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center text-white">
  <div class="heroBackground" id="hero-background4"></div>
  <div class="hero-overlay"></div>


  <div class="container position-relative" style="z-index: 4;">
    <div class="row g-4">

      <!-- Criador -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-lg rounded-4 h-100">
          <div class="card-body text-center p-4">

            <img src="css/imagens/Foto de Perfil Reduzida.png"
              alt="Foto de Kauã Mattos"
              class="rounded-circle object-fit-cover mx-auto d-block mb-3"
              style="width:120px;height:120px;">

            <h3 class="text-primary mb-3">Sobre o Criador</h3>

            <p class="mb-3">
              Me chamo <strong>Kauã Mattos</strong>, programador e apaixonado por RPGs de mesa.
            </p>

            <p class="text-muted small">
              Sou fã de sistemas como Tormenta e D&D. O <strong>Alta Fantasia</strong> é meu
              terceiro projeto de RPG, criado com o objetivo de desenvolver um sistema
              profundo, equilibrado e duradouro para campanhas épicas.
            </p>

            <p class="text-muted small mb-0">
              O projeto nasceu da evolução de ideias antigas e da vontade de criar
              um sistema próprio que realmente pudesse ser jogado por longos períodos.
            </p>

          </div>
        </div>
      </div>

      <!-- Open Source -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-lg rounded-4 h-100 ">
          <div class="card-body text-center p-4">

            <div class="bg-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
              style="width: 60px; height: 60px;">
              <i class="fab fa-github text-white fs-4"></i>
            </div>

            <h3 class="mb-3">Projeto Open Source</h3>

            <p class="mb-3">
              O sistema do site é <strong>Open Source</strong>. Desenvolvedores e
              mestres de RPG podem reutilizar o código como base para criar
              sistemas próprios de fichas ou ferramentas de campanha.
            </p>

            <p class="text-muted small mb-4">
              A ideia é incentivar a comunidade a compartilhar ferramentas,
              melhorar o código e expandir o ecossistema de RPGs independentes.
            </p>

            <a href="https://github.com/Kawatos/alta-fantasia-client-beta"
              class="btn github-btn text-white text-decoration-none rounded-pill px-4 py-2"
              target="_blank">

              <i class="fab fa-github me-2"></i>
              Ver no GitHub
              <i class="fas fa-star ms-2"></i>

            </a>

            <p class="mt-3 text-muted small">
              <i class="fas fa-heart text-danger"></i>
              Se gostar do projeto, deixe uma estrela!
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
</script>


<?php include('footer.php'); ?>