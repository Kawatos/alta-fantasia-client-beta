<?php include('header.php'); ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body text-primary">
          <h1 class="display-5 fw-bold mb-4 text-primary text-center">
            <span class="font-alta">Alta</span>
            <span class="title-dynamic font-fantasia fw-bold" id="fantasiaText">Fantasia</span>
          </h1>
          <!-- Abas de navegação -->
          <ul class="nav nav-tabs nav-fill mb-4" id="loginTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-selected="true">
                <i class="fas fa-sign-in-alt me-2 text-primary"></i>Login
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="registro-tab" data-bs-toggle="tab" data-bs-target="#registro" type="button" role="tab" aria-selected="false">
                <i class="fas fa-user-plus me-2 text-primary"></i>Cadastrar
              </button>
            </li>
          </ul>

          <!-- Conteúdo das abas -->
          <div class="tab-content" id="loginTabsContent">
            <!-- Aba de Login -->
            <div class="tab-pane fade show active text-primary" id="login" role="tabpanel">
              <h3 class="text-center mb-4">Olá novamente!</h3>
              <form id="loginForm">
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Usuário" required>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                      <i class="fas fa-eye text-primary"></i>
                    </button>

                  </div>
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Entrar
                  </button>
                  <div class="text-center mt-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalRecuperarSenha">Esqueci minha senha</a>
                  </div>
                </div>
              </form>
              <script src="https://accounts.google.com/gsi/client" async defer></script>

              <div class="mt-3" style="
                                          display: flex;
                                          flex-direction: column;
                                          align-content: center;
                                          align-items: center;
                                          justify-content: center;
                                          flex-wrap: nowrap;
                                      ">

                <span class="me-3 text-muted">ou</span>

                <div>
                  <div id="g_id_onload"
                    data-client_id="550263584056-ajf5der4epo9ipld0qofi8b1g7qc4jtq.apps.googleusercontent.com"
                    data-callback="handleGoogleLogin">
                  </div>
                  <div class="g_id_signin" data-type="standard"></div>

                </div>

              </div>


            </div>


            <!-- Modal para recuperação -->
            <div class="modal fade" id="modalRecuperarSenha" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Recuperar Acesso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <form id="recuperarForm">
                      <div class="mb-3">
                        <label for="recuperar_email" class="form-label">Digite seu Usuário</label>
                        <input type="name" class="form-control" id="recuperar_usuario" name="recuperar_usuario" required>
                      </div>
                      <div class="mb-3">
                        <label for="recuperar_email" class="form-label">Digite seu e-mail</label>
                        <input type="email" class="form-control" id="recuperar_email" name="recuperar_email" required>
                      </div>
                      <button type="submit" class="btn btn-primary w-100">Recuperar</button>
                    </form>
                    <div id="recuperar-feedback" class="mt-3"></div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Aba de Registro -->
            <div class="tab-pane fade" id="registro" role="tabpanel">
              <h3 class="text-center mb-4 text-primary">Você é novo(a) por aqui? Vamos jogar juntos!</h3>
              <form id="registroForm">
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="new_username" id="new_username" placeholder="Escolha um usuário" required>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Escolha uma senha" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_password">
                      <i class="fas fa-eye text-primary"></i>
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirme a senha" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="confirm_password">
                      <i class="fas fa-eye text-primary"></i>
                    </button>
                  </div>
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-success">
                    <i class="fas fa-user-plus me-2"></i>Cadastrar
                  </button>
                </div>
              </form>
            </div>


          </div>

          <!-- Mensagem de feedback -->
          <div id="mensagem" class="alert mt-3 d-none"></div>
        </div>
      </div>
    </div>
  </div>
</div>





<!-- Estilos customizados -->


<script>
  function handleGoogleLogin(response) {
    const token = response.credential;

    $.ajax({
        url: 'backend/google-login.php', // Verifique este caminho
        method: 'POST',
        data: {
          credential: token
        },
        dataType: 'json'
      })
      .done((res) => {
        console.log("RESPOSTA DO PHP:", res);
        if (res.success) {
          window.location.href = res.redirect;
        } else {
          alert("Login falhou: " + res.message);
        }
      })
      .fail((err) => {
        console.log("ERRO AJAX:", err);
        alert("Erro ao conectar ao servidor.");
      });
  }



  $(document).ready(function() {
    $('#loginForm, #registroForm').on('submit', function(e) {
      e.preventDefault();

      const isLogin = $(this).attr('id') === 'loginForm';
      const url = isLogin ? 'backend/login_process.php' : 'backend/registro_process.php';

      const formData = isLogin ? {
        username: $('#username').val(),
        password: $('#password').val()
      } : {
        new_username: $('#new_username').val(),
        new_password: $('#new_password').val()
      };


      // Requisição AJAX
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            if (isLogin) {
              window.location.href = 'editor.php';
            } else {
              $('#registroForm')[0].reset();
              window.location.href = 'editor.php';
            }
          } else {
            alert(response.message || 'Ocorreu um erro. Tente novamente.');
          }
        },
        error: function(xhr) {
          console.log("ERRO AJAX:", xhr.responseText);
          alert('Erro na conexão. Tente novamente mais tarde.');
        }
      });

    });

    document.querySelectorAll('.toggle-password').forEach(button => {
      button.addEventListener('click', function() {
        const targetId = this.dataset.target;
        const input = document.getElementById(targetId);
        const icon = this.querySelector('i');

        if (input.type === 'password') {
          input.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          input.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      });
    });

    $('#recuperarForm').on('submit', function(e) {
      e.preventDefault();

      const email = $('#recuperar_email').val();
      const usuario = $('#recuperar_usuario').val();
      const feedback = $('#recuperar-feedback');

      $.ajax({
        url: 'backend/recuperar_senha.php',
        type: 'POST',
        data: {
          usuario: usuario,
          email: email
        },
        success: function(response) {
          if (response.success) {
            feedback.html('<div class="text-success">' + response.nova_senha + '</div>');
          } else {
            feedback.html('<div class="text-danger">' + (response.message || 'Erro ao recuperar senha') + '</div>');
          }
        },
        error: function() {
          feedback.html('<div class="text-danger">Erro na conexão com o servidor.</div>');
        }
      });
    });

  });
</script>

<?php include('footer.php'); ?>