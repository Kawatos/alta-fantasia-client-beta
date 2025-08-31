<?php include('header.php'); ?>

<style>
  .wiki-header {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: #fff;
    padding: 2rem 1rem;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    margin-bottom: 1rem;
  }

  .wiki-header h1 {
    font-size: 2rem;
    font-weight: 700;
  }

  .wiki-header i {
    color: #ffd700;
  }

  .search-container .alert {
    background: rgba(255,255,255,0.2);
    color: #fff;
    border: none;
    font-size: 0.9rem;
  }

  /* Estilo do iframe */
  .wiki-frame {
    width: 100%;
    height: 80vh; /* ocupa 80% da altura da tela */
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  /* Mobile */
  @media (max-width: 768px) {
    .wiki-header {
      padding: 1.5rem 1rem;
    }

    .wiki-header h1 {
      font-size: 1.5rem;
    }

    .wiki-frame {
      height: 70vh; /* menos altura no celular */
    }
  }
</style>

<div class="wiki-header text-center">
  <h1>
    <i class="fas fa-book-open me-2"></i>
    Wiki - Alta Fantasia Online
  </h1>
  <div class="search-container mt-2">
    <div class="alert">
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