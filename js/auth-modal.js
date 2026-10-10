/* Alta Fantasia — comportamento do modal de autenticação */
(function () {
  'use strict';

  const modalEl = document.getElementById('authModal');
  if (!modalEl || typeof bootstrap === 'undefined') return; // usuário logado ou sem Bootstrap

  const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
  const tabs = modalEl.querySelector('.afa-tabs');
  const alertBox = document.getElementById('afaAlert');
  const social = document.getElementById('afaSocial');
  const views = {
    login: document.getElementById('afa-view-login'),
    registro: document.getElementById('afa-view-registro'),
    recuperar: document.getElementById('afa-view-recuperar')
  };
  const titles = { login: 'Olá novamente!', registro: 'Novo por aqui?', recuperar: 'Recuperar acesso' };
  const googleClient = modalEl.dataset.googleClient || '';
  const turnstileKey = modalEl.dataset.turnstileKey || '';
  let turnstileToken = '';
  let turnstileId = null;
  let currentView = 'login';

  /* ---------- Troca de views ---------- */
  function setView(name) {
    if (!views[name]) name = 'login';
    currentView = name;
    Object.keys(views).forEach((k) => {
      const active = k === name;
      views[k].hidden = !active;
      views[k].classList.toggle('is-active', active);
    });
    tabs.dataset.active = name;
    tabs.querySelectorAll('[data-afa-view]').forEach((b) => {
      const on = b.dataset.afaView === name;
      b.classList.toggle('is-active', on);
      b.setAttribute('aria-selected', on ? 'true' : 'false');
    });
    social.classList.toggle('is-hidden', name === 'recuperar');
    modalEl.setAttribute('aria-labelledby', name === 'login' ? 'afaTitle' : '');
    clearAlert();
    modalEl.querySelectorAll('.afa-field.is-error').forEach((f) => f.classList.remove('is-error'));
  }

  function open(view) {
    setView(view);
    modal.show();
  }

  /* ---------- Gatilhos globais ---------- */
  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('[data-auth-open], [data-auth-required]');
    if (trigger) {
      // Se o usuário já estiver autenticado no SPA, ignora requisições de auth-required
      if (window.AF_SPA && window.AF_SPA.isLoggedIn) {
        if (trigger.hasAttribute('data-auth-required') || trigger.getAttribute('href') === '#app' || trigger.dataset.afViewTrigger === 'app') {
          return;
        }
      }

      e.preventDefault();
      // fecha o menu mobile, se estiver aberto
      const menu = document.getElementById('afMenu');
      if (menu && menu.classList.contains('show')) bootstrap.Collapse.getOrCreateInstance(menu).hide();
      open(trigger.dataset.authOpen === 'registro' ? 'registro' : 'login');
      return;
    }
    const switcher = e.target.closest('[data-afa-view]');
    if (switcher && modalEl.contains(switcher)) setView(switcher.dataset.afaView);
  });

  // Abre via ?auth=login|registro
  const params = new URLSearchParams(location.search);
  if (params.has('auth')) {
    open(params.get('auth') === 'registro' ? 'registro' : 'login');
    params.delete('auth');
    const qs = params.toString();
    history.replaceState(null, '', location.pathname + (qs ? '?' + qs : '') + location.hash);
  }

  /* ---------- Mostrar/ocultar senha ---------- */
  modalEl.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-afa-toggle]');
    if (!btn) return;
    const input = btn.parentElement.querySelector('input');
    const show = input.type === 'password';
    input.type = show ? 'text' : 'password';
    btn.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
    btn.setAttribute('aria-label', show ? 'Ocultar senha' : 'Mostrar senha');
  });

  /* ---------- Utilidades ---------- */
  function showAlert(msg, type) {
    alertBox.textContent = msg;
    alertBox.className = 'afa-alert is-' + (type || 'error');
    alertBox.hidden = false;
  }
  function clearAlert() { alertBox.hidden = true; alertBox.textContent = ''; }

  function flagEmpty(form) {
    let firstBad = null;
    form.querySelectorAll('.afa-field').forEach((f) => {
      const input = f.querySelector('input');
      const bad = !input.value.trim();
      f.classList.toggle('is-error', bad);
      if (bad && !firstBad) firstBad = input;
    });
    if (firstBad) { firstBad.focus(); return false; }
    return true;
  }

  modalEl.addEventListener('input', (e) => {
    const f = e.target.closest('.afa-field');
    if (f) f.classList.remove('is-error');
  });

  async function post(url, data) {
    const res = await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams(data),
      credentials: 'same-origin'
    });
    const text = await res.text();
    try { return JSON.parse(text); }
    catch (_) { console.error('Resposta inválida de ' + url + ':', text); throw new Error('invalid-json'); }
  }

  function setLoading(btn, on) {
    btn.classList.toggle('is-loading', on);
    btn.disabled = on;
  }

  function enterApp(userData) {
    showAlert('Tudo certo! Entrando…', 'ok');
    if (window.AF_SPA && typeof window.AF_SPA.onLoginSuccess === 'function') {
      window.AF_SPA.onLoginSuccess(userData || {});
    } else {
      window.location.href = './#app';
    }
  }

  /* ---------- Formulários ---------- */
  function bindForm(id, handler) {
    const form = document.getElementById(id);
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearAlert();
      if (!flagEmpty(form)) { showAlert('Preencha todos os campos.'); return; }
      const btn = form.querySelector('.afa-btn');
      setLoading(btn, true);
      try {
        await handler(form);
      } catch (err) {
        showAlert('Erro na conexão. Tente novamente mais tarde.');
      } finally {
        if (!document.body.classList.contains('afa-redirecting')) {
          setLoading(btn, turnstileKey !== '' && !turnstileToken);
        }
      }
    });
  }

  bindForm('afaLoginForm', async (form) => {
    const fd = new FormData(form);
    const res = await post('backend/login_process.php', {
      username: fd.get('username'),
      password: fd.get('password'),
      cf_token: turnstileToken
    });
    if (res.success) { enterApp(res.user); }
    else showAlert(res.message || 'Usuário ou senha inválidos.');
  });

  bindForm('afaRegistroForm', async (form) => {
    const fd = new FormData(form);
    if (fd.get('new_password') !== fd.get('confirm_password')) {
      form.querySelectorAll('.afa-field')[2].classList.add('is-error');
      showAlert('As senhas não conferem.');
      return;
    }
    const res = await post('backend/registro_process.php', {
      new_username: fd.get('new_username'),
      new_password: fd.get('new_password'),
      cf_token: turnstileToken
    });
    if (res.success) { enterApp(res.user); }
    else showAlert(res.message || 'Ocorreu um erro. Tente novamente.');
  });

  bindForm('afaRecuperarForm', async (form) => {
    const fd = new FormData(form);
    const res = await post('backend/recuperar_senha.php', {
      usuario: fd.get('usuario'),
      email: fd.get('email')
    });
    if (res.success) showAlert(res.nova_senha || 'Senha enviada para o seu e-mail!', 'ok');
    else showAlert(res.message || 'Erro ao recuperar senha.');
  });

  /* ---------- Login com Google ---------- */
  let googleStarted = false;

  async function handleGoogle(response) {
    clearAlert();
    try {
      const res = await post('backend/google-login.php', { credential: response.credential });
      if (res.success) { enterApp(res.user); }
      else showAlert('Login com Google falhou: ' + (res.message || 'tente novamente.'));
    } catch (_) {
      showAlert('Erro ao conectar ao servidor.');
    }
  }

  function startGoogle() {
    if (!googleClient || !window.google || !google.accounts || !google.accounts.id) return;
    if (!googleStarted) {
      google.accounts.id.initialize({
        client_id: googleClient,
        callback: handleGoogle,
        auto_select: false,
        cancel_on_tap_outside: true
      });
      googleStarted = true;
    }
    renderGoogleButton();
  }

  function renderGoogleButton() {
    if (!googleStarted) return;
    const holder = document.getElementById('afaGoogle');
    holder.innerHTML = '';
    const width = Math.min(Math.max(holder.clientWidth || 300, 200), 400);
    google.accounts.id.renderButton(holder, {
      theme: 'filled_black',
      size: 'large',
      shape: 'pill',
      text: 'continue_with',
      logo_alignment: 'left',
      width: width
    });
  }

  window.afaGoogleReady = startGoogle; // chamado pelo onload do script do Google

  /* ---------- Turnstile (opcional) ---------- */
  function startTurnstile() {
    if (!turnstileKey || !window.turnstile || turnstileId !== null) return;
    turnstileId = turnstile.render('#afaTurnstile', {
      sitekey: turnstileKey,
      theme: 'dark',
      callback: (t) => {
        turnstileToken = t;
        modalEl.querySelectorAll('.afa-btn').forEach((b) => (b.disabled = false));
      },
      'expired-callback': () => {
        turnstileToken = '';
        modalEl.querySelectorAll('#afaLoginForm .afa-btn, #afaRegistroForm .afa-btn').forEach((b) => (b.disabled = true));
      },
      'error-callback': () => {
        turnstileToken = '';
      }
    });
  }

  /* ---------- Ciclo de vida do modal ---------- */
  modalEl.addEventListener('shown.bs.modal', () => {
    startGoogle();
    startTurnstile();
    const first = views[currentView].querySelector('input');
    if (first) first.focus();
  });

  modalEl.addEventListener('hidden.bs.modal', () => {
    modalEl.querySelectorAll('form').forEach((f) => f.reset());
    modalEl.querySelectorAll('.afa-field input[type="text"][name$="password"]').forEach((i) => (i.type = 'password'));
    clearAlert();
    setView('login');
  });
})();
