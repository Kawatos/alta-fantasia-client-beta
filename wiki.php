<?php include('header.php'); ?>



<style>
  #wikiSearch {
    width: 50%;
  }

  .wiki-header {
    position: -webkit-sticky;
    position: sticky;
    top: 70px;
    z-index: 999;

    background: url('css/imagens/biblioteca.jpg') center/cover no-repeat;
    padding: 1rem;

    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

    margin-bottom: 2rem;
    overflow: visible;

    min-height: auto;
    height: auto;
    inline-size: 100%;
    block-size: auto;
    /* Safari fix: faz com que a altura se ajuste ao conteúdo */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
  }

  .wiki-header h1,
  .wiki-header .search-container {
    position: relative;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
    z-index: 2;
    /* garante que o texto fique acima do overlay */
  }

  /* Estilo do iframe */
  .wiki-frame {
    width: 100%;
    height: 80vh;
    /* ocupa 80% da altura da tela */
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .info {
    background-color: #ffffffe0;
    color: var(--cor-primaria);

    padding: 10px 15px;
    border-radius: 4px;
    font-size: 1rem;
    display: inline-block;
  }

  .tabs-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.5rem;
  }

  .tab-btn {
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    background: #eee;
    cursor: pointer;
    font-weight: bold;
    transition: 0.2s;
  }

  .tab-btn:hover {
    background: #ddd;
  }

  .tab-btn.active {
    background: var(--cor-primaria);
    color: white;
  }

  @media (min-width: 769px) {
    .wiki-header {
      min-height: auto !important;
      height: auto !important;
      inline-size: 100%;
      block-size: auto;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  }

  /* Mobile */
  @media (max-width: 768px) {
    #wikiFrame {
      width: 100%;
    }



    .wiki-header {
      padding: 1.5rem 1rem;
      min-height: auto !important;
      height: auto !important;

      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .wiki-header h1 {
      font-size: 3rem;
    }

    .wiki-frame {
      height: 100vh;
      width: 100vw;
      /* menos altura no celular */
    }
  }

  #wikiMenu {
    display: none;
  }

  #wikiMenu.open {
    display: block;
  }

  .wiki-frame.fullscreen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;
    background: #000;
  }
</style>
<!-- Safari Fix JS: força a altura a se ajustar ao conteúdo -->
<script>
  // Correção de altura para o Safari caso o flexbox ainda não baste
  document.addEventListener("DOMContentLoaded", function() {
    function adjustWikiHeaderHeight() {
      const el = document.querySelector('.wiki-header');
      if (el) {
        el.style.height = 'auto';
        el.style.minHeight = 'auto';
        // Ajuda especialmente em caso de sticky + background cover + flex no Safari/iOS
        const realHeight = el.scrollHeight;
        el.style.height = realHeight + 'px';
      }
    }
    adjustWikiHeaderHeight();
    window.addEventListener('resize', adjustWikiHeaderHeight);
  });
</script>

<div class="wiki-header text-center">

  <div class="d-flex justify-content-between align-items-center px-3">

    <!-- Título -->
    <h1 class="display-6 fw-bold m-0">
      <span class="font-alta">Alta</span>
      <span class="title-dynamic font-fantasia fw-bold">Fantasia: Wiki</span>
      <button id="menuToggle" class=" ml-2 btn btn-sm btn-primary">☰</button>
    </h1>

  </div>

  <!-- Menu (colapsável) -->
  <div id="wikiMenu" class="tabs-container text-center mt-3">

    <button class="tab-btn active" data-link="https://docs.google.com/document/d/1-dYIwjynW6hpmpf4KKyI0GBvd3GMqbq3KzDQTfTHjd0/preview">📜 Regras</button>

    <button class="tab-btn" data-link="https://docs.google.com/document/d/1LdaIOfIW-4iWjrjTvWAVBEDMNwe7MvNh7hK94zxTr8k/preview">🧝 Raças</button>

    <button class="tab-btn" data-link="https://docs.google.com/document/d/1xnNnLiTzGFw3DPBGknZAd44UDZU0BeY7qclgq7xn1Yg/preview">⚔️ Classes</button>

    <button class="tab-btn" data-link="https://docs.google.com/document/d/1K7STSBAg2L10GbwqkU20yJKU_3W9R8Pwn_cU_wQnlTE/preview">✨ Habilidades</button>

    <button class="tab-btn" data-link="https://docs.google.com/document/d/1hL5SbQ5o-70p795EoLCwkdf7DJgKIexY0SlIkAxZ7ec/preview">🔮 Magias</button>

    <button class="tab-btn" data-link="https://docs.google.com/document/d/1wsE5m0ImTtOV3GyXeEI_8HkFvNI1TaQ_hBhOvziyy4o/preview">💎 Itens</button>

  </div>

</div>


<div class="container-fluid">
  <iframe class="wiki-frame mt-3" id="wikiFrame"
    src="https://docs.google.com/document/d/1-dYIwjynW6hpmpf4KKyI0GBvd3GMqbq3KzDQTfTHjd0/edit?usp=sharing"
    width="100%" height="50vh" frameborder="0" allowfullscreen>
  </iframe>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".tab-btn");
    const iframe = document.getElementById("wikiFrame");
    const menu = document.getElementById("wikiMenu");
    const toggle = document.getElementById("menuToggle");
    const fullscreenBtn = document.getElementById("fullscreenBtn");

    // Tabs
    buttons.forEach(btn => {
      btn.addEventListener("click", () => {
        buttons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        iframe.src = btn.getAttribute("data-link");

        // fecha menu no mobile
        menu.classList.remove("open");
      });
    });

    // Menu hambúrguer
    toggle.addEventListener("click", () => {
      menu.classList.toggle("open");
    });
    

    function isFullscreen() {
      return document.fullscreenElement != null;
    }

    fullscreenBtn.addEventListener("click", async () => {
      if (!isFullscreen()) {
        await iframe.requestFullscreen();
      } else {
        await document.exitFullscreen();
      }
    });

    // Atualiza botão corretamente (ESC, resize, etc)
    document.addEventListener("fullscreenchange", () => {
      if (isFullscreen()) {
        fullscreenBtn.textContent = "✕";
      } else {
        fullscreenBtn.textContent = "⛶";
      }
    });

  });
</script>


<?php include('footer.php'); ?>