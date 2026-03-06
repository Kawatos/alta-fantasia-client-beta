<?php include('header.php'); ?>



<style>
  .wiki-header {
    position: -webkit-sticky;
    /* Suporte Safari */
    position: sticky;
    /* IMPORTANTE: Esse valor deve ser a altura do seu header principal */
    /* Se o header principal mudar muito, podemos usar uma variável CSS */
    top: 70px;
    z-index: 999;
    /* Um pouco menor que o do header principal (1000) */

    background: url('css/imagens/biblioteca.jpg') center/cover no-repeat;
    padding: 1rem;

    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

    margin-bottom: 2rem;
    overflow: hidden;
    min-height: fit-content;
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
      /* Define uma altura mínima mais proeminente para telas grandes */
      min-height: fit-content;
      /* Adicione um pouco mais de padding para um visual mais aberto, se desejar */

    }
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
      height: 100vh;
      width: 100vw;
      /* menos altura no celular */
    }
  }
</style>

<div class="wiki-header text-center">
  <h1 class="display-5 fw-bold">
    <span class="font-alta">Alta</span>
    <span class="title-dynamic font-fantasia fw-bold" id="fantasiaText">Fantasia: Wiki</span>
  </h1>
  <div class="search-container mt-2 d-flex align-items-center justify-content-center">
    <input type="text" id="wikiSearch" class="form-control w-50" placeholder="🔍 Pesquisar nesta página...">

    <div id="searchNav" class="ms-2" style="display: none;">
      <span id="searchCount" class="badge bg-secondary me-2">0/0</span>
      <button id="prevSearch" class="btn btn-sm btn-primary">▲</button>
      <button id="nextSearch" class="btn btn-sm btn-primary">▼</button>
    </div>
  </div>
  <div class="tabs-container text-center my-3" style="z-index: 999;">

    <button class="tab-btn active" data-link="wiki_pages/AltaFantasiaRegras.html">📜 Regras</button>
    <button class="tab-btn" data-link="wiki_pages/AltaFantasiaRacas.html">🧝 Raças</button>
    <button class="tab-btn" data-link="wiki_pages/AltaFantasiaClasses.html">⚔️ Classes</button>
    <button class="tab-btn" data-link="wiki_pages/AltaFantasiaHabilidades.html">✨ Habilidades</button>
    <button class="tab-btn" data-link="wiki_pages/AltaFantasiaMagias.html">🔮 Magias</button>
    <button class="tab-btn" data-link="wiki_pages/AltaFantasiaItens.html">💎 Itens</button>
    <button class="tab-btn" data-link="wiki_pages/AltaFantasiaCenario.html">🌍 Cenário</button>

  </div>
</div>


<div class="container-fluid">
  <iframe class="wiki-frame mt-3" id="wikiFrame"
    src="wiki_pages/AltaFantasiaRegras.html"
    width="100%" height="50vh" frameborder="0" allowfullscreen>
  </iframe>
</div>

<script>
  const buttons = document.querySelectorAll(".tab-btn");
  const searchInput = document.getElementById("wikiSearch");
  const iframe = document.getElementById("wikiFrame");
  const searchNav = document.getElementById("searchNav");
  const searchCount = document.getElementById("searchCount");

  let currentMatchIndex = -1;
  let matches = [];

  function performSearch() {
    const searchTerm = searchInput.value.trim();
    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
    const body = iframeDoc.body;

    // 1. Limpeza e Reset
    const markers = body.querySelectorAll('mark');
    markers.forEach(m => {
      const parent = m.parentNode;
      m.replaceWith(...m.childNodes);
      parent.normalize();
    });

    if (searchTerm.length < 2) {
      searchNav.style.display = "none";
      return;
    }

    // 2. Busca e Destaque
    const walk = iframeDoc.createTreeWalker(body, NodeFilter.SHOW_TEXT, null, false);
    const nodesToReplace = [];
    let node;
    while (node = walk.nextNode()) {
      if (node.parentElement.tagName === 'SCRIPT' || node.parentElement.tagName === 'STYLE') continue;
      if (node.textContent.toLowerCase().includes(searchTerm.toLowerCase())) {
        nodesToReplace.push(node);
      }
    }

    const escapedTerm = searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const regex = new RegExp(`(${escapedTerm})`, 'gi');

    nodesToReplace.forEach(node => {
      const span = iframeDoc.createElement('span');
      span.innerHTML = node.textContent.replace(regex, '<mark class="wiki-highlight">$1</mark>');
      node.replaceWith(...span.childNodes);
    });

    // 3. Atualizar Navegação
    matches = Array.from(body.querySelectorAll('.wiki-highlight'));

    if (matches.length > 0) {
      currentMatchIndex = 0;
      searchNav.style.display = "inline-block";
      updateMatchUI();
    } else {
      searchNav.style.display = "none";
    }
  }

  function updateMatchUI() {
    // Remove destaque de "foco" anterior
    matches.forEach(m => m.style.backgroundColor = "#ffcf33"); // Cor padrão

    // Destaca o atual
    const current = matches[currentMatchIndex];
    current.style.backgroundColor = "#ff9900"; // Cor de foco (Laranja)
    current.scrollIntoView({
      behavior: 'smooth',
      block: 'center'
    });

    searchCount.textContent = `${currentMatchIndex + 1}/${matches.length}`;
  }
  
  document.getElementById("nextSearch").addEventListener("click", () => {
    if (matches.length === 0) return;
    currentMatchIndex = (currentMatchIndex + 1) % matches.length;
    updateMatchUI();
  });

  document.getElementById("prevSearch").addEventListener("click", () => {
    if (matches.length === 0) return;
    currentMatchIndex = (currentMatchIndex - 1 + matches.length) % matches.length;
    updateMatchUI();
  });

  searchInput.addEventListener("input", performSearch);
  
  function resetSearch() {
    searchInput.value = "";
    matches = [];
    currentMatchIndex = -1;
    searchNav.style.display = "none";
    searchCount.textContent = "0/0";
  }

  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      resetSearch(); 
      iframe.src = btn.dataset.link;

      buttons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
    });
  });
  
  iframe.onload = () => {
    resetSearch();
  };
</script>


<?php include('footer.php'); ?>