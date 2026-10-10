/**
 * Alta Fantasia — SPA Orchestrator & Router
 * Unifica a Landing (#landing), o Painel do RPG (#app) e a Wiki (#wiki)
 * sem recarregar a página, com transições suaves e reatividade total.
 */
(function () {
  'use strict';

  const spa = {
    currentView: null,
    isLoggedIn: false,

    init() {
      this.isLoggedIn = !!(document.body.dataset.userId && document.body.dataset.userId.trim() !== '');
      this.syncAuthState(this.isLoggedIn);

      const initialRoute = this.detectInitialRoute();
      this.navigateTo(initialRoute, { replaceState: true, immediate: true });

      // Suporte a voltar/avançar no histórico (#landing, #app, #wiki)
      window.addEventListener('hashchange', () => {
        const route = location.hash.replace('#', '') || (this.isLoggedIn ? 'app' : 'landing');
        if (route === 'app' || route === 'landing' || route === 'wiki') {
          this.navigateTo(route, { pushHistory: false });
        }
      });

      // Interceptador global de cliques para alternar visões
      document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-af-view-trigger]');
        if (!trigger) return;

        const targetView = trigger.dataset.afViewTrigger;

        // Se o usuário estiver fora da rota principal, redireciona para a raiz com o hash
        const currentPath = window.location.pathname.toLowerCase();
        if (currentPath.indexOf('wiki.php') !== -1 || currentPath.indexOf('home.php') !== -1 || currentPath.indexOf('alta.php') !== -1) {
          window.location.href = './#' + targetView;
          return;
        }

        // Fecha menu mobile se estiver aberto
        const menu = document.getElementById('afMenu');
        if (menu && menu.classList.contains('show') && typeof bootstrap !== 'undefined') {
          bootstrap.Collapse.getOrCreateInstance(menu).hide();
        }

        if (targetView) {
          e.preventDefault();
          this.navigateTo(targetView);
        }
      });

      // Intercepta cliques nos links de âncoras da landing quando estiver no App ou Wiki
      document.addEventListener('click', (e) => {
        const anchor = e.target.closest('a[href^="#sistema"], a[href^="#mundo"], a[href^="#equipe"], a[href^="#lore"], a[href^="#af-final"]');
        if (!anchor) return;

        if (this.currentView !== 'landing') {
          e.preventDefault();
          const targetId = anchor.getAttribute('href');
          this.navigateTo('landing');
          setTimeout(() => {
            const targetEl = document.querySelector(targetId);
            if (targetEl) targetEl.scrollIntoView({ behavior: 'smooth' });
          }, 320);
        }
      });

      // Intercepta cliques de logout
      document.addEventListener('click', (e) => {
        const logoutTrigger = e.target.closest('#afLogoutBtn, .af-spa-logout');
        if (!logoutTrigger) return;

        e.preventDefault();
        this.logout();
      });

      // Fecha menu mobile ao clicar fora dele
      document.addEventListener('click', (e) => {
        const menu = document.getElementById('afMenu');
        const burger = document.querySelector('.af-burger');
        if (!menu || !menu.classList.contains('show')) return;

        if (!menu.contains(e.target) && (!burger || !burger.contains(e.target))) {
          if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
            const bsCollapse = bootstrap.Collapse.getInstance(menu) || bootstrap.Collapse.getOrCreateInstance(menu);
            bsCollapse.hide();
          } else {
            menu.classList.remove('show');
          }
        }
      });

      // Fecha menu mobile ao pressionar ESC
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          const menu = document.getElementById('afMenu');
          if (menu && menu.classList.contains('show') && typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
            bootstrap.Collapse.getOrCreateInstance(menu).hide();
          }
        }
      });
    },

    detectInitialRoute() {
      const hash = location.hash.replace('#', '');
      if (hash === 'app' || hash === 'landing' || hash === 'wiki') return hash;

      const urlParams = new URLSearchParams(location.search);
      if (urlParams.get('view') === 'app') return 'app';
      if (urlParams.get('view') === 'landing') return 'landing';
      if (urlParams.get('view') === 'wiki') return 'wiki';

      // Usuário logado inicia direto no app; visitante inicia na landing
      return this.isLoggedIn ? 'app' : 'landing';
    },

    navigateTo(viewName, options = {}) {
      // Bloqueia acesso ao app para deslogados e abre o modal de login
      if (viewName === 'app' && !this.isLoggedIn) {
        const authModal = document.getElementById('authModal');
        if (authModal && typeof bootstrap !== 'undefined') {
          bootstrap.Modal.getOrCreateInstance(authModal).show();
        }
        return;
      }

      if (viewName !== 'app' && viewName !== 'landing' && viewName !== 'wiki') {
        viewName = 'landing';
      }

      if (this.currentView === viewName && !options.immediate) return;

      const landingEl = document.getElementById('afLandingView');
      const appEl = document.getElementById('afAppView');
      const wikiEl = document.getElementById('afWikiView');
      const footerEl = document.getElementById('afLandingFooter');

      const views = {
        landing: landingEl,
        app: appEl,
        wiki: wikiEl
      };

      const prevView = this.currentView;
      this.currentView = viewName;

      // Se estava em tela cheia na wiki e navegou para outra visão, restaura o viewport
      if (prevView === 'wiki' && viewName !== 'wiki') {
        if (window.AF_WIKI && typeof window.AF_WIKI.exitFullscreen === 'function') {
          window.AF_WIKI.exitFullscreen();
        } else if (document.fullscreenElement && document.exitFullscreen) {
          document.exitFullscreen().catch(() => {});
        }
      }

      // Oculta e exibe as visões
      Object.keys(views).forEach(key => {
        const el = views[key];
        if (!el) return;

        if (key === viewName) {
          el.classList.remove('d-none');
          if (options.immediate) {
            el.classList.remove('af-fade-out');
            el.classList.add('af-fade-in');
          } else {
            el.classList.add('af-fade-out');
            requestAnimationFrame(() => {
              el.classList.remove('af-fade-out');
              el.classList.add('af-fade-in');
            });
          }
        } else {
          el.classList.add('d-none');
          el.classList.remove('af-fade-in');
        }
      });

      // Configuração do body, html e footer
      document.body.classList.remove('af-in-landing', 'af-in-app', 'af-in-wiki');
      document.body.classList.add('af-in-' + viewName);
      if (document.documentElement) {
        document.documentElement.classList.toggle('af-no-scroll', viewName === 'app' || viewName === 'wiki');
      }

      if (footerEl) {
        if (viewName === 'landing') {
          footerEl.classList.remove('d-none');
        } else {
          footerEl.classList.add('d-none');
        }
      }

      if (viewName === 'landing' && !options.immediate) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      this.updateNavbar(viewName);

      // Normaliza rota na barra de endereços para remover 'index.php' e manter elegância
      const cleanPath = this.getCleanPath();
      const newUrl = cleanPath + '#' + viewName;

      if (options.replaceState) {
        history.replaceState(null, '', newUrl);
      } else if (options.pushHistory !== false) {
        history.pushState(null, '', newUrl);
      }

      window.dispatchEvent(new CustomEvent('af:view-change', {
        detail: { from: prevView, to: viewName }
      }));
    },

    getCleanPath() {
      // Remove '/index.php' do final do pathname para manter a URL limpa
      const path = window.location.pathname;
      return path.replace(/\/index\.php\/?$/i, '/') || '/';
    },

    updateNavbar(viewName) {
      // Alterna links do menu desktop
      document.querySelectorAll('.af-nav-landing').forEach((el) => {
        el.classList.toggle('d-none', viewName !== 'landing');
      });
      document.querySelectorAll('.af-nav-app').forEach((el) => {
        el.classList.toggle('d-none', viewName === 'landing');
      });

      // Alterna links do menu mobile
      document.querySelectorAll('.af-mobile-landing').forEach((el) => {
        el.classList.toggle('d-none', viewName !== 'landing');
      });
      document.querySelectorAll('.af-mobile-app').forEach((el) => {
        el.classList.toggle('d-none', viewName === 'landing');
      });

      // Destaque visual nos botões de alternância
      document.querySelectorAll('[data-af-view-trigger]').forEach((link) => {
        const isActive = link.dataset.afViewTrigger === viewName;
        link.classList.toggle('is-active', isActive);
        link.classList.toggle('active', isActive);
      });
    },

    syncAuthState(isLoggedIn, userData) {
      this.isLoggedIn = !!isLoggedIn;

      // Dropdown de perfil (Desktop: d-none no mobile, d-lg-block no desktop)
      const userDropdown = document.getElementById('afUserDropdown');
      if (userDropdown) {
        if (this.isLoggedIn) {
          userDropdown.classList.remove('d-none');
          userDropdown.classList.add('d-none', 'd-lg-block');
        } else {
          userDropdown.classList.remove('d-lg-block');
          userDropdown.classList.add('d-none');
        }
      }

      // Botão Entrar principal (Desktop)
      const authBtn = document.getElementById('afAuthBtn');
      if (authBtn) {
        authBtn.classList.toggle('d-none', this.isLoggedIn);
      }

      // Menu mobile: alterna blocos autenticados e blocos de visitante
      const mobileMenu = document.getElementById('afMenu');
      if (mobileMenu) {
        mobileMenu.querySelectorAll('.af-user-menu').forEach((el) => {
          if (this.isLoggedIn) {
            el.classList.remove('d-none');
            el.classList.add('d-flex');
          } else {
            el.classList.remove('d-flex');
            el.classList.add('d-none');
          }
        });

        mobileMenu.querySelectorAll('.af-auth-btn').forEach((el) => {
          if (this.isLoggedIn) {
            el.classList.remove('d-flex');
            el.classList.add('d-none');
          } else {
            el.classList.remove('d-none');
            el.classList.add('d-flex');
          }
        });
      }

      // Atualiza avatar se fornecido
      if (userData && userData.imagem) {
        const avatarImg = document.getElementById('afUserAvatarImg');
        const avatarIcon = document.getElementById('afUserAvatarIcon');
        const mobileAvatar = document.getElementById('afMobileUserAvatar');
        const mobileIcon = document.getElementById('afMobileUserIcon');

        if (avatarImg) {
          avatarImg.src = userData.imagem;
          avatarImg.classList.remove('d-none');
        }
        if (avatarIcon) avatarIcon.classList.add('d-none');

        if (mobileAvatar) {
          mobileAvatar.src = userData.imagem;
          mobileAvatar.classList.remove('d-none');
        }
        if (mobileIcon) mobileIcon.classList.add('d-none');

        const previewConfig = document.getElementById('preview_imagem_usuario');
        if (previewConfig) previewConfig.src = userData.imagem;
      }

      // Atualiza campos de username se fornecido
      if (userData && userData.username) {
        const usernameInput = document.getElementById('novo_username');
        if (usernameInput) usernameInput.value = userData.username;

        const mobileUsername = document.getElementById('afMobileUsername');
        if (mobileUsername) mobileUsername.textContent = userData.username;
      }
    },

    onLoginSuccess(userData) {
      document.body.dataset.userId = (userData && userData.id) ? userData.id : '1';

      // Fecha modal de auth
      const authModal = document.getElementById('authModal');
      if (authModal && typeof bootstrap !== 'undefined') {
        const instance = bootstrap.Modal.getInstance(authModal);
        if (instance) instance.hide();
      }

      this.syncAuthState(true, userData);

      // Transiciona imediatamente para o painel de RPG
      this.navigateTo('app');

      // Avisa os módulos (assets/js/home/main.js) para carregar campanhas e fichas
      window.dispatchEvent(new CustomEvent('af:auth-change', { detail: userData }));
    },

    async logout() {
      try {
        await fetch('backend/logout.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        });
      } catch (_) {
        // Fallback silencioso
      }

      document.body.dataset.userId = '';
      this.syncAuthState(false);

      // Notifica módulos do app
      window.dispatchEvent(new CustomEvent('af:auth-change', { detail: null }));

      // Transiciona de volta para a apresentação
      this.navigateTo('landing');
    }
  };

  window.AF_SPA = spa;

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => spa.init());
  } else {
    spa.init();
  }
})();
