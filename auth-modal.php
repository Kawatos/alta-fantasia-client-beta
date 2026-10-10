<?php
/**
 * Modal de autenticação (login / cadastro / recuperar senha).
 * Incluído pelo header.php apenas para visitantes (sem sessão).
 *
 * Abrir de qualquer lugar:
 *   <button data-auth-open="login|registro">   -> abre o modal
 *   <a href="home.php" data-auth-required>      -> abre o modal para visitantes
 *   alta.php?auth=login|registro               -> abre ao carregar
 */
require_once __DIR__ . '/env.php';

// Sitekey do Cloudflare Turnstile (configurado no .env). Vazio = desativado (ex.: local).
$turnstileSiteKey = env('CLOUDFLARE_TURNSTILE_SITEKEY', '');
$googleClientId   = env('GOOGLE_CLOUD_PROJECT_ID');
?>
<link rel="stylesheet" href="css/auth-modal.css">

<div class="modal fade afa-modal" id="authModal" tabindex="-1" aria-labelledby="afaTitle" aria-hidden="true"
  data-google-client="<?= htmlspecialchars($googleClientId) ?>"
  data-turnstile-key="<?= htmlspecialchars($turnstileSiteKey) ?>">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content afa-content">

      <span class="afa-glow afa-glow--a" aria-hidden="true"></span>
      <span class="afa-glow afa-glow--b" aria-hidden="true"></span>

      <button type="button" class="afa-close" data-bs-dismiss="modal" aria-label="Fechar">
        <i class="fas fa-xmark"></i>
      </button>

      <div class="afa-body">
        <div class="afa-brand">
          
          <span class="font-alta">Alta</span> <span class="font-fantasia">Fantasia</span>
        </div>

        <div class="afa-tabs" role="tablist" data-active="login">
          <span class="afa-tabs__thumb" aria-hidden="true"></span>
          <button type="button" role="tab" class="is-active" data-afa-view="login" aria-selected="true">
            <i class="fas fa-right-to-bracket"></i> Entrar
          </button>
          <button type="button" role="tab" data-afa-view="registro" aria-selected="false">
            <i class="fas fa-user-plus"></i> Cadastrar
          </button>
        </div>

        <div class="afa-views">

          <!-- LOGIN -->
          <section class="afa-view is-active" id="afa-view-login" aria-labelledby="afaTitle">
            <h2 class="afa-title" id="afaTitle">Olá novamente!</h2>
            <p class="afa-sub">Entre para continuar sua aventura.</p>

            <form id="afaLoginForm" novalidate>
              <label class="afa-field">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Usuário" autocomplete="username" required>
              </label>
              <label class="afa-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Senha" autocomplete="current-password" required>
                <button type="button" class="afa-eye" data-afa-toggle aria-label="Mostrar senha"><i class="fas fa-eye"></i></button>
              </label>

              <button type="submit" class="afa-btn" <?= $turnstileSiteKey !== '' ? 'disabled' : '' ?>>
                <span class="afa-btn__label"><i class="fas fa-right-to-bracket"></i> Entrar</span>
                <span class="afa-spinner" aria-hidden="true"></span>
              </button>

              <button type="button" class="afa-link" data-afa-view="recuperar">Esqueci minha senha</button>
            </form>
          </section>

          <!-- CADASTRO -->
          <section class="afa-view" id="afa-view-registro" hidden>
            <h2 class="afa-title">Novo por aqui?</h2>
            <p class="afa-sub">Crie sua conta e vamos jogar juntos!</p>

            <form id="afaRegistroForm" novalidate>
              <label class="afa-field">
                <i class="fas fa-user"></i>
                <input type="text" name="new_username" placeholder="Escolha um usuário" autocomplete="username" required>
              </label>
              <label class="afa-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="new_password" placeholder="Escolha uma senha" autocomplete="new-password" required>
                <button type="button" class="afa-eye" data-afa-toggle aria-label="Mostrar senha"><i class="fas fa-eye"></i></button>
              </label>
              <label class="afa-field">
                <i class="fas fa-shield-halved"></i>
                <input type="password" name="confirm_password" placeholder="Confirme a senha" autocomplete="new-password" required>
                <button type="button" class="afa-eye" data-afa-toggle aria-label="Mostrar senha"><i class="fas fa-eye"></i></button>
              </label>

              <button type="submit" class="afa-btn" <?= $turnstileSiteKey !== '' ? 'disabled' : '' ?>>
                <span class="afa-btn__label"><i class="fas fa-user-plus"></i> Criar conta</span>
                <span class="afa-spinner" aria-hidden="true"></span>
              </button>
            </form>
          </section>

          <!-- RECUPERAR SENHA -->
          <section class="afa-view" id="afa-view-recuperar" hidden>
            <h2 class="afa-title">Recuperar acesso</h2>
            <p class="afa-sub">Enviaremos uma senha temporária para o seu e-mail.</p>

            <form id="afaRecuperarForm" novalidate>
              <label class="afa-field">
                <i class="fas fa-user"></i>
                <input type="text" name="usuario" placeholder="Seu usuário" required>
              </label>
              <label class="afa-field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Seu e-mail" autocomplete="email" required>
              </label>

              <button type="submit" class="afa-btn">
                <span class="afa-btn__label"><i class="fas fa-paper-plane"></i> Recuperar</span>
                <span class="afa-spinner" aria-hidden="true"></span>
              </button>
              <button type="button" class="afa-link" data-afa-view="login"><i class="fas fa-arrow-left"></i> Voltar ao login</button>
            </form>
          </section>
        </div>

        <div class="afa-alert" id="afaAlert" role="alert" aria-live="polite" hidden></div>

        <div class="afa-social" id="afaSocial">
          <div class="afa-or"><span>ou</span></div>
          <div class="afa-google" id="afaGoogle"></div>
          <?php if ($turnstileSiteKey !== ''): ?>
            <div class="afa-turnstile" id="afaTurnstile"></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="js/auth-modal.js" defer></script>
<script src="https://accounts.google.com/gsi/client" async defer onload="window.afaGoogleReady && window.afaGoogleReady()"></script>
<?php if ($turnstileSiteKey !== ''): ?>
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" async defer></script>
<?php endif; ?>
