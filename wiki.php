<?php include('header.php'); ?>



<style>
  .wiki-header {
    position: relative;
    background: url('css/imagens/biblioteca.jpg') center/cover no-repeat;
    padding: 1rem;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-left: 3vw;
    margin-right: 3vw;
    margin-bottom: 2rem;
    overflow: hidden;
    /* garante que a camada respeite o border-radius */
    min-height: fit-content;
    /* altura mínima pra não ficar muito apertado */
  }

  .wiki-header::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* ocupa toda a altura da .wiki-header */
    background: rgba(212, 212, 212, 0.36);
    /* branco semi-transparente */
    z-index: 1;
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

  /* Mobile */
  @media (max-width: 768px) {
    .wiki-header {
      padding: 1.5rem 1rem;
    }

    .wiki-header h1 {
      font-size: 3rem;
    }

    .wiki-frame {
      height: 70vh;
      /* menos altura no celular */
    }
  }
</style>

<div class="wiki-header text-center">
  <h1 class="display-5 fw-bold">
    <span class="font-alta">Alta</span>
    <span class="title-dynamic font-fantasia fw-bold" id="fantasiaText">Fantasia: Wiki</span>
  </h1>
  <div class="search-container mt-2">
    <div class="alert info">
      🔍 Use <strong>CTRL+F</strong> (ou no celular: menu ⋮ → "Localizar na página")
    </div>
  </div>
</div>

<!-- Abas -->
<div class="tabs-container text-center my-3">
  <button class="tab-btn active" data-link="https://docs.google.com/document/d/1VfikbHosH2ZQfpM6VVptKxSCgZJWn1qUYE3Rmc8vAvg/edit?usp=sharing">📜 Regras</button>
  <button class="tab-btn" data-link="https://docs.google.com/document/d/1NvIGwegRqcm4HZvZ3F7pEE1o1ozc7VG-llKL5NsK4wA/edit?usp=sharing">🧝 Raças</button>
  <button class="tab-btn" data-link="https://docs.google.com/document/d/1GN7evCieqB1Bqb36zfCsXodKEpGiQIHjCAs1QwDoXKQ/edit?usp=sharing">⚔️ Classes</button>
  <button class="tab-btn" data-link="https://docs.google.com/document/d/1KIMu0ewx-tBzjHgdOa5sGeDYM8_cxK8xMnGoNJW9dBU/edit?usp=sharing">✨ Habilidades</button>
  <button class="tab-btn" data-link="https://docs.google.com/document/d/1oXr3MXfNyUMsMSMJRI316bW0gxTb3TFeK8jHmxjmS50/edit?usp=sharing">🔮 Magias</button>
  <button class="tab-btn" data-link="https://docs.google.com/document/d/1Nswbcigr1Mr8NYiQkLoF1lWHjqrhaD-E1l3RO-yrRgU/edit?usp=sharing">💎 Itens</button>
</div>

<!-- Conteúdo -->
<div class="container-fluid">
  <iframe class="wiki-frame" id="wikiFrame"
    src="https://docs.google.com/document/d/1VfikbHosH2ZQfpM6VVptKxSCgZJWn1qUYE3Rmc8vAvg/edit?usp=sharing">
  </iframe>
</div>


<script>
  const buttons = document.querySelectorAll(".tab-btn");
  const iframe = document.getElementById("wikiFrame");

  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      // Muda link
      iframe.src = btn.dataset.link;

      // Troca aba ativa
      buttons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
    });
  });
</script>

<?php include('footer.php'); ?>