<?php include('header.php'); ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body">
          <!-- Abas de navegação -->
          <ul class="nav nav-tabs nav-fill mb-4" id="loginTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-selected="true">
                <i class="fas fa-sign-in-alt me-2"></i>Login
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="registro-tab" data-bs-toggle="tab" data-bs-target="#registro" type="button" role="tab" aria-selected="false">
                <i class="fas fa-user-plus me-2"></i>Cadastrar
              </button>
            </li>
          </ul>

          <!-- Conteúdo das abas -->
          <div class="tab-content" id="loginTabsContent">
            <!-- Aba de Login -->
            <div class="tab-pane fade show active" id="login" role="tabpanel">
              <h3 class="text-center mb-4">Bem-vindo(a) ao Editor de Fichas</h3>
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
                  </div>
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Entrar
                  </button>
                </div>
              </form>
            </div>

            <!-- Aba de Registro -->
            <div class="tab-pane fade" id="registro" role="tabpanel">
              <h3 class="text-center mb-4">Criar Nova Conta</h3>
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
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirme a senha" required>
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
<style>
  .card {
    border: none;
    border-radius: 15px;
  }

  .nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    padding: 15px;
    transition: all 0.3s;
  }

  .nav-tabs .nav-link.active {
    color: #0d6efd;
    border-bottom: 2px solid #0d6efd;
    background: none;
  }

  .nav-tabs .nav-link:hover {
    border-color: transparent;
    color: #0d6efd;
  }

  .input-group-text {
    background-color: #f8f9fa;
    border-right: none;
  }

  .form-control {
    border-left: none;
  }

  .form-control:focus {
    box-shadow: none;
    border-color: #ced4da;
  }

  .btn {
    padding: 12px;
    font-weight: 500;
  }
</style>

<script>
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
        success: function(response) {
          if (response.success) {
            if (isLogin) {
              window.location.href = 'editor.php';
            } else {
              // Limpa o formulário e mostra mensagem de sucesso
              $('#registroForm')[0].reset();
              window.location.href = 'editor.php';
            }
          } else {
            alert(response.message || 'Ocorreu um erro. Tente novamente.');
          }
        },
        error: function() {
          alert('Erro na conexão. Tente novamente mais tarde.');
        }
      });
    });
  });
</script>

<?php include('footer.php'); ?>