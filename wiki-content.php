<?php
/**
 * Seção de Wiki (Alta Fantasia)
 * Renderizada no componente SPA como a visão #afWikiView.
 * Otimizada para ocupar 100% da tela sem rolagem externa e com máxima responsividade mobile.
 */
?>
<section class="af-wiki-view af-view d-none" id="afWikiView">
  <div class="container-fluid py-1 py-md-2 px-2 px-md-3 d-flex flex-column h-100 flex-grow-1">
    <div class="af-wiki-card p-2 p-md-3 mx-auto w-100 d-flex flex-column">
      
      <!-- Cabeçalho Compacto da Wiki -->
      <div class="d-flex justify-content-between align-items-center gap-2 pb-2 mb-2 border-bottom flex-shrink-0">
        <div class="d-flex align-items-baseline gap-2">
          <h2 class="h5 fw-bold text-white mb-0 d-flex align-items-center gap-1">
            <span class="font-alta">Alta</span>
            <span class="font-fantasia fw-bold">Fantasia: Wiki</span>
          </h2>
          <small class="text-muted d-none d-md-inline" style="font-size: 0.8rem;">Documentos Oficiais &amp; Regras</small>
        </div>

        <div class="d-flex align-items-center gap-1 gap-sm-2 flex-shrink-0">
          <button type="button" id="wikiFullscreenBtn" class="af-btn af-btn--ghost py-1 px-2 px-sm-3" style="font-size: 0.8rem;" title="Alternar Tela Cheia">
            <i class="fas fa-expand me-1" id="wikiFsIcon"></i> <span class="d-none d-sm-inline">Tela Cheia</span><span class="d-sm-none">Cheia</span>
          </button>
          <a id="wikiOpenTabBtn" href="https://docs.google.com/document/d/1-dYIwjynW6hpmpf4KKyI0GBvd3GMqbq3KzDQTfTHjd0/preview" target="_blank" rel="noopener" class="af-btn af-btn--ghost py-1 px-2 px-sm-3" style="font-size: 0.8rem;" title="Abrir em Nova Aba">
            <i class="fas fa-external-link-alt me-1"></i> <span class="d-none d-sm-inline">Nova Guia</span><span class="d-sm-none">Guia</span>
          </a>
        </div>
      </div>

      <!-- Abas da Wiki (Carrossel Horizontal Touch-Friendly no Mobile) -->
      <div class="nav nav-pills af-wiki-pills mb-2 flex-shrink-0" id="spaWikiTabs">
        <button type="button" class="nav-link active tab-btn-wiki" data-link="https://docs.google.com/document/d/1-dYIwjynW6hpmpf4KKyI0GBvd3GMqbq3KzDQTfTHjd0/preview">
          📜 Regras
        </button>
        <button type="button" class="nav-link tab-btn-wiki" data-link="https://docs.google.com/document/d/1LdaIOfIW-4iWjrjTvWAVBEDMNwe7MvNh7hK94zxTr8k/preview">
          🧝 Raças
        </button>
        <button type="button" class="nav-link tab-btn-wiki" data-link="https://docs.google.com/document/d/1xnNnLiTzGFw3DPBGknZAd44UDZU0BeY7qclgq7xn1Yg/preview">
          ⚔️ Classes
        </button>
        <button type="button" class="nav-link tab-btn-wiki" data-link="https://docs.google.com/document/d/1K7STSBAg2L10GbwqkU20yJKU_3W9R8Pwn_cU_wQnlTE/preview">
          ✨ Habilidades
        </button>
        <button type="button" class="nav-link tab-btn-wiki" data-link="https://docs.google.com/document/d/1hL5SbQ5o-70p795EoLCwkdf7DJgKIexY0SlIkAxZ7ec/preview">
          🔮 Magias
        </button>
        <button type="button" class="nav-link tab-btn-wiki" data-link="https://docs.google.com/document/d/1wsE5m0ImTtOV3GyXeEI_8HkFvNI1TaQ_hBhOvziyy4o/preview">
          💎 Itens
        </button>
      </div>

      <!-- Div Container do Leitor: limita o iframe e permite movimentação/rolagem normal -->
      <div class="af-wiki-frame-container position-relative flex-grow-1" id="spaWikiFrameContainer">
        <!-- Botão Flutuante de Sair da Tela Cheia (Indispensável no Mobile) -->
        <button type="button" id="wikiExitFullscreenBtn" class="af-wiki-close-fs-btn d-none" aria-label="Sair da Tela Cheia" title="Sair da Tela Cheia">
          <i class="fas fa-times me-1"></i> Sair da Tela Cheia
        </button>

        <iframe class="af-normal-wiki-iframe" id="spaWikiFrame"
          src="https://docs.google.com/document/d/1-dYIwjynW6hpmpf4KKyI0GBvd3GMqbq3KzDQTfTHjd0/preview"
          scrolling="yes"
          allowfullscreen
          loading="lazy">
        </iframe>
      </div>

    </div>
  </div>
</section>

<script>
  (function() {
    function initWikiComponent() {
      const tabs = document.querySelectorAll('#spaWikiTabs .tab-btn-wiki');
      const frame = document.getElementById('spaWikiFrame');
      const container = document.getElementById('spaWikiFrameContainer');
      const extLink = document.getElementById('wikiOpenTabBtn');
      const fsBtn = document.getElementById('wikiFullscreenBtn');
      const fsIcon = document.getElementById('wikiFsIcon');
      const exitFsBtn = document.getElementById('wikiExitFullscreenBtn');

      if (!tabs.length || !frame) return;

      tabs.forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          tabs.forEach(b => b.classList.remove('active'));
          this.classList.add('active');

          // Centraliza a aba horizontalmente no scroll do mobile
          if (typeof this.scrollIntoView === 'function') {
            this.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
          }

          const link = this.dataset.link;
          if (link) {
            frame.src = link;
            if (extLink) extLink.href = link;
          }
        });
      });

      if (fsBtn && container) {
        function updateFsState(isFullscreen) {
          if (fsIcon) {
            if (isFullscreen) {
              fsIcon.classList.remove('fa-expand');
              fsIcon.classList.add('fa-compress');
            } else {
              fsIcon.classList.remove('fa-compress');
              fsIcon.classList.add('fa-expand');
            }
          }
          if (exitFsBtn) {
            exitFsBtn.classList.toggle('d-none', !isFullscreen);
          }
        }

        function exitFs() {
          if (document.fullscreenElement && document.exitFullscreen) {
            document.exitFullscreen().catch(() => {});
          }
          container.classList.remove('af-fullscreen-fallback');
          updateFsState(false);
        }

        window.AF_WIKI = { exitFullscreen: exitFs };

        fsBtn.addEventListener('click', function() {
          const isNativeFs = !!document.fullscreenElement;
          const isFallbackFs = container.classList.contains('af-fullscreen-fallback');

          if (!isNativeFs && !isFallbackFs) {
            if (container.requestFullscreen) {
              container.requestFullscreen().then(() => updateFsState(true)).catch(() => {
                container.classList.add('af-fullscreen-fallback');
                updateFsState(true);
              });
            } else if (container.webkitRequestFullscreen) {
              container.webkitRequestFullscreen();
              updateFsState(true);
            } else {
              container.classList.add('af-fullscreen-fallback');
              updateFsState(true);
            }
          } else {
            exitFs();
          }
        });

        if (exitFsBtn) {
          exitFsBtn.addEventListener('click', exitFs);
        }

        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape' && container.classList.contains('af-fullscreen-fallback')) {
            exitFs();
          }
        });

        document.addEventListener('fullscreenchange', function() {
          updateFsState(!!document.fullscreenElement);
        });
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initWikiComponent);
    } else {
      initWikiComponent();
    }
  })();
</script>
