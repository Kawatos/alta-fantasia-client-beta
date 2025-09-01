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

<div class="container-fluid">
  <iframe
    class="wiki-frame"
    src="https://docs.google.com/document/d/1Up7cIngHCp_gsipfyryFB47hs_Uv7KNru0Lyk0XQ5Wo/edit?usp=sharing">
  </iframe>
</div>

<?php include('footer.php'); ?>