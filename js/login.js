$(document).ready(function() {
    // Função para mostrar mensagens
    function showMessage(message, type) {
        const messageDiv = $('#mensagem');
        messageDiv.removeClass('d-none alert-success alert-danger')
            .addClass(`alert-${type}`)
            .text(message);
    }

    // Formulário de Login
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'backend/login_process.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showMessage('Login realizado com sucesso! Redirecionando...', 'success');
                    setTimeout(() => {
                        window.location.href = 'editor.php';
                    }, 1500);
                } else {
                    showMessage(response.message || 'Erro ao fazer login. Tente novamente.', 'danger');
                }
            },
            error: function() {
                showMessage('Erro ao conectar com o servidor. Tente novamente.', 'danger');
            }
        });
    });

    // Formulário de Registro
    $('#registroForm').on('submit', function(e) {
        e.preventDefault();

        // Validação de senha
        const password = $('#new_password').val();
        const confirmPassword = $('#confirm_password').val();

        if (password !== confirmPassword) {
            showMessage('As senhas não coincidem!', 'danger');
            return;
        }

        $.ajax({
            url: 'backend/registro_process.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showMessage('Cadastro realizado com sucesso! Você já pode fazer login.', 'success');
                    // Limpa o formulário
                    $('#registroForm')[0].reset();
                    // Muda para a aba de login
                    $('#login-tab').tab('show');
                } else {
                    showMessage(response.message || 'Erro ao realizar cadastro. Tente novamente.', 'danger');
                }
            },
            error: function() {
                showMessage('Erro ao conectar com o servidor. Tente novamente.', 'danger');
            }
        });
    });
});
    

