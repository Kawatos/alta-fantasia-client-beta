<?php
$bodyClass = 'af-page';
$landingNav = true;
include('header.php');
?>

<link rel="stylesheet" href="css/alta-landing.css">

<div class="af-progress" aria-hidden="true"></div>

<main class="af">

  <!-- ===================== HERO ===================== -->
  <section class="af-hero" aria-labelledby="af-titulo">
    <div class="af-bg" role="presentation"></div>
    <canvas class="af-embers" aria-hidden="true"></canvas>

    <div class="af-container">
      <span class="af-eyebrow af-reveal"><i class="fas fa-dice-d20"></i> RPG de Mesa &bull; Online</span>

      <h1 class="af-title af-reveal" id="af-titulo" style="--d:1">
        <span class="af-title__a font-alta">Alta</span>
        <span class="af-title__b fw-bold" id="fantasiaText">Fantasia</span>
      </h1>

      <p class="af-lead af-reveal" style="--d:2">Um RPG de Mesa Épico e Ambicioso</p>
      <p class="af-sub af-reveal" style="--d:3">Mergulhe em um mundo virtual onde a fantasia encontra a realidade</p>

      <div class="af-cta af-reveal" style="--d:4">
        <a href="home.php" class="af-btn" data-auth-required><i class="fas fa-scroll"></i> Vamos lá!</a>
        <a href="https://github.com/Kawatos/alta-fantasia-client-beta" class="af-btn af-btn--ghost" target="_blank" rel="noopener">
          <i class="fab fa-github"></i> Ver no GitHub
        </a>
      </div>
    </div>

    <span class="af-scroll" aria-hidden="true"></span>
  </section>

  <!-- ===================== MARQUEE ===================== -->
  <div class="af-marquee" aria-hidden="true">
    <div class="af-marquee__track">
      <?php for ($i = 0; $i < 2; $i++): ?>
        <div class="af-marquee__item">
          <span>100 Níveis</span><i class="fas fa-star"></i>
          <span>10 Ranks</span><i class="fas fa-star"></i>
          <span>Baseado em d10</span><i class="fas fa-star"></i>
          <span>Editor Online de Fichas</span><i class="fas fa-star"></i>
          <span>Open Source</span><i class="fas fa-star"></i>
          <span>Ano 2079</span><i class="fas fa-star"></i>
        </div>
      <?php endfor; ?>
    </div>
  </div>

  <!-- ===================== STATS ===================== -->
  <section class="af-section" aria-label="Números do sistema">
    <div class="af-container">
      <div class="af-stats">
        <div class="af-card af-stat af-reveal" style="--d:0">
          <div class="af-stat__num" data-count="100" data-prefix="+">+100</div>
          <div class="af-stat__label">Níveis Máximos</div>
        </div>
        <div class="af-card af-stat af-reveal" style="--d:1">
          <div class="af-stat__num" data-count="18" data-prefix="+">+18</div>
          <div class="af-stat__label">Classes Jogáveis</div>
        </div>
        <div class="af-card af-stat af-reveal" style="--d:2">
          <div class="af-stat__num" data-count="12" data-prefix="+">+12</div>
          <div class="af-stat__label">Raças Disponíveis</div>
        </div>
        <div class="af-card af-stat af-reveal" style="--d:3">
          <div class="af-stat__num">Editor</div>
          <div class="af-stat__label">Online de Fichas</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== SISTEMA ===================== -->
  <section class="af-section af-section--alt" id="sistema" aria-labelledby="af-sistema">
    <div class="af-container">
      <header class="af-heading af-reveal">
        <span class="af-heading__kicker">Regras</span>
        <h2 id="af-sistema">Um sistema <em>ambicioso</em></h2>
        <p>Progressão rápida, balanceamento ativo e uma jornada feita para durar.</p>
        <div class="af-divider"><i class="fas fa-gem"></i></div>
      </header>

      <div class="af-grid-2">
        <article class="af-card af-reveal af-left">
          <span class="af-icon"><i class="fas fa-rocket"></i></span>
          <h3>Desenvolvimento Ambicioso</h3>
          <ol class="af-timeline">
            <li>
              <h4>Maio 2025</h4>
              <p>Início do desenvolvimento do Alta Fantasia</p>
            </li>
            <li>
              <h4>Proposta Atual</h4>
              <p>RPG que vai até o nível 100, balanceado e desafiador</p>
            </li>
            <li>
              <h4>Sistema Inovador</h4>
              <p>100 pontos de experiência para cada nível - progressão rápida e equilibrada</p>
            </li>
          </ol>
        </article>

        <article class="af-card af-reveal af-right">
          <span class="af-icon"><i class="fas fa-dice-d20"></i></span>
          <h3>Sistema de Jogo</h3>
          <ul class="af-features">
            <li><i class="fas fa-check-circle"></i><span><strong>Balanceamento Ativo:</strong> Sem classes super fortes e super fracas</span></li>
            <li><i class="fas fa-check-circle"></i><span><strong>Progressão Rápida:</strong> 100 XP por nível</span></li>
            <li><i class="fas fa-check-circle"></i><span><strong>Desafio Constante:</strong> Para jogadores e mestres</span></li>
            <li><i class="fas fa-check-circle"></i><span><strong>100 Níveis, 10 Ranks:</strong> Jornada épica e duradoura, com progressão palpável</span></li>
            <li><i class="fas fa-check-circle"></i><span><strong>Baseado em d10:</strong> 1d10 a cada 10 níveis ao invés do d20 a campanha inteira</span></li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <!-- ===================== MUNDO ===================== -->
  <section class="af-world" id="mundo" aria-labelledby="af-mundo">
    <div class="af-bg" role="presentation"></div>
    <div class="af-container">
      <header class="af-heading af-reveal">
        <span class="af-heading__kicker">Cenário</span>
        <h2 id="af-mundo">O Mundo de <em>Alta Fantasia</em></h2>
        <div class="af-divider"><i class="fas fa-globe-americas"></i></div>
      </header>

      <div class="af-world-grid">
        <article class="af-card af-reveal" style="--d:0">
          <span class="af-tag">🌍 O Cenário</span>
          <p>
            Inspirado na narrativa de SAO, Alta Fantasia segue a premissa de jogadores
            presos em um mundo de Fantasia Online super realista. Uma réplica perfeita
            do mundo real, construída no ano de <strong>2079</strong>.
          </p>
        </article>

        <article class="af-card af-reveal" style="--d:1">
          <span class="af-tag">Progressive Technologies</span>
          <p>
            O Projeto Alta, foi criado pela empresa Progressive Technologies com suporte financeiro de governos,
            instituições e pessoas ao redor do mundo. Um projeto verdadeiramente global.
          </p>
        </article>

        <article class="af-card af-reveal" style="--d:2">
          <span class="af-tag">Isekai? Não?</span>
          <p>
            Os servidores (sem jogadores) pesam mais de <strong>800 Hexabytes</strong>,
            abrigando centenas de milhões de habitantes que são IAs Generalistas -
            basicamente pessoas virtuais, em um mundo virtual basicamente real.
          </p>
        </article>

        <article class="af-card af-reveal" style="--d:3">
          <span class="af-tag">A Trama</span>
          <p>
            A história começa no lançamento do jogo, onde os jogadores, após algumas
            horas jogando, acabam ficando presos dentro do mundo virtual.
            <em>E o resto da história? Você decide...</em>
          </p>
        </article>
      </div>
    </div>
  </section>

  <!-- ===================== EQUIPE ===================== -->
  <section class="af-section af-people" id="equipe" aria-labelledby="af-equipe">
    <div class="af-container">
      <header class="af-heading af-reveal">
        <span class="af-heading__kicker">Comunidade</span>
        <h2 id="af-equipe">Quem faz o <em>Alta</em></h2>
        <p>Eu e meus jogadores</p>
        <div class="af-divider"><i class="fas fa-users"></i></div>
      </header>

      <div class="af-grid-2">
        <article class="af-card af-card--center af-reveal af-left">
          <div class="af-avatar">
            <img src="css/imagens/Foto de Perfil Reduzida.png" alt="Foto de Kauã Mattos" loading="lazy">
          </div>
          <h3>Sobre o Criador</h3>
          <p>Me chamo <strong>Kauã Mattos</strong>, programador e apaixonado por RPGs de mesa.</p>
          <p>
            Sou fã de sistemas como Tormenta e D&amp;D. O <strong>Alta Fantasia</strong> é meu
            terceiro projeto de RPG, criado com o objetivo de desenvolver um sistema
            profundo, equilibrado e duradouro para campanhas épicas.
          </p>
          <p>
            O projeto nasceu da evolução de ideias antigas e da vontade de criar
            um sistema próprio que realmente pudesse ser jogado por longos períodos.
          </p>
        </article>

        <article class="af-card af-card--center af-reveal af-right">
          <span class="af-icon"><i class="fab fa-github"></i></span>
          <h3>Projeto Open Source</h3>
          <p>
            O sistema do site é <strong>Open Source</strong>. Desenvolvedores e
            mestres de RPG podem reutilizar o código como base para criar
            sistemas próprios de fichas ou ferramentas de campanha.
          </p>
          <p>
            A ideia é incentivar a comunidade a compartilhar ferramentas,
            melhorar o código e expandir o ecossistema de RPGs independentes.
          </p>
          <p style="margin-top:1.6rem">
            <a href="https://github.com/Kawatos/alta-fantasia-client-beta" class="af-btn af-btn--ghost" target="_blank" rel="noopener">
              <i class="fab fa-github"></i> Ver no GitHub <i class="fas fa-star"></i>
            </a>
          </p>
          <p style="margin-top:1rem; font-size:.9rem">
            <i class="fas fa-heart" style="color:#e05a6d"></i> Se gostar do projeto, deixe uma estrela!
          </p>
        </article>
      </div>
    </div>
  </section>

  <!-- ===================== CTA FINAL ===================== -->
  <section class="af-final" aria-labelledby="af-final">
    <div class="af-container">
      <i class="fas fa-dice-d20 af-dice" aria-hidden="true"></i>
      <h2 class="af-reveal" id="af-final">Pronto para rolar os dados?</h2>
      <p class="af-reveal" style="--d:1">Crie sua ficha, monte sua campanha e comece sua jornada.</p>
      <div class="af-reveal" style="--d:2">
        <a href="home.php" class="af-btn" data-auth-required><i class="fas fa-scroll"></i> Vamos lá!</a>
      </div>
    </div>
  </section>

</main>

<script src="js/alta-landing.js" defer></script>

<?php include('footer.php'); ?>