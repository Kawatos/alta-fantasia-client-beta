<?php
$usuarioConfig = ['username' => '', 'email' => '', 'imagem' => ''];
if (isset($_SESSION['usuario_id'])) {
    if (!isset($conn)) {
        require_once __DIR__ . '/backend/conexao.php';
    }
    $idUsuarioConfig = $_SESSION['usuario_id'];
    $stmtConfig = $conn->prepare("SELECT username, email, imagem FROM usuarios WHERE id = :id");
    $stmtConfig->bindParam(':id', $idUsuarioConfig);
    $stmtConfig->execute();
    $dbUser = $stmtConfig->fetch(PDO::FETCH_ASSOC);
    if ($dbUser) {
        $usuarioConfig = $dbUser;
    }
}
?>
<div class="modal fade af" id="userConfigModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: rgba(18, 20, 52, 0.95); backdrop-filter: blur(10px); border: 1px solid var(--af-glass-border); border-radius: var(--af-radius); box-shadow: 0 20px 50px -20px rgba(0, 0, 0, 0.8);">
            
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-white mb-0" style="font-family: 'Poppins', sans-serif;">
                    <i class="fas fa-user-cog me-2" style="color: var(--af-gold-soft);"></i> Configurações da Conta
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar" style="opacity: 0.8;"></button>
            </div>

            <div class="modal-body p-4">
                <form id="form-configuracoes-usuario" enctype="multipart/form-data">
                    <div class="row g-4 flex-column-reverse flex-md-row">
                        <!-- Campos do usuário (esquerda) -->
                        <div class="col-md-7 col-lg-8">
                            <div class="mb-3">
                                <label for="novo_username" class="form-label text-white-50 mb-1" style="font-size: 0.9rem;">Nome de Usuário</label>
                                <input type="text" class="form-control" id="novo_username" name="novo_username"
                                    value="<?= htmlspecialchars($usuarioConfig['username']) ?>"
                                    style="background: rgba(0,0,0,0.2); border: 1px solid var(--af-glass-border); color: #fff; border-radius: 0.5rem; padding: 0.75rem;">
                            </div>

                            <div class="mb-3">
                                <label for="novo_email" class="form-label text-white-50 mb-1" style="font-size: 0.9rem;">Email</label>
                                <input type="email" class="form-control" id="novo_email" name="novo_email"
                                    value="<?= htmlspecialchars($usuarioConfig['email'] ?? '') ?>"
                                    style="background: rgba(0,0,0,0.2); border: 1px solid var(--af-glass-border); color: #fff; border-radius: 0.5rem; padding: 0.75rem;">
                            </div>

                            <div class="mb-3">
                                <label for="nova_senha" class="form-label text-white-50 mb-1" style="font-size: 0.9rem;">Nova Senha</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="nova_senha" name="nova_senha" placeholder="Deixe em branco para não alterar"
                                        style="background: rgba(0,0,0,0.2); border: 1px solid var(--af-glass-border); color: #fff; border-radius: 0.5rem 0 0 0.5rem; padding: 0.75rem; border-right: none;">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="nova_senha"
                                        style="background: rgba(0,0,0,0.2); border: 1px solid var(--af-glass-border); border-radius: 0 0.5rem 0.5rem 0; border-left: none; color: var(--af-gold-soft);">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Imagem de perfil (direita) -->
                        <div class="col-md-5 col-lg-4 d-flex flex-column align-items-center justify-content-center">
                            <label class="form-label text-white-50 mb-2" style="font-size: 0.9rem;">Imagem de Perfil</label>
                            
                            <div class="position-relative mb-3" style="width: 160px; height: 160px;">
                                <div style="position: absolute; inset: -4px; border-radius: 50%; background: conic-gradient(from 0deg, var(--af-gold-soft), transparent 30%, var(--af-gold-deep), transparent 70%, var(--af-gold-soft)); animation: af-spin 6s linear infinite; z-index: 1;"></div>
                                <img id="preview_imagem_usuario"
                                    src="backend/uploads_usuario/<?= !empty($usuarioConfig['imagem']) ? $usuarioConfig['imagem'] : 'perfil-vazio.png' ?>"
                                    alt="Preview da Imagem"
                                    style="position: relative; width: 100%; height: 100%; object-fit: cover; border-radius: 50%; cursor: pointer; border: 4px solid var(--af-ink-2); z-index: 2; background: var(--af-ink);">
                                <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; z-index: 3; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.5);" onclick="document.getElementById('imagem_usuario').click()">
                                    <i class="fas fa-camera text-white"></i>
                                </div>
                            </div>
                            
                            <input type="file" class="d-none" id="imagem_usuario" name="imagem_usuario" accept="image/*">
                            <small class="text-white-50">Máximo 2 MB</small>
                        </div>
                    </div>

                    <!-- Mensagem de feedback -->
                    <div id="mensagem-feedback" class="mt-3 p-3 rounded" style="display: none; background: rgba(0,0,0,0.2); border: 1px solid var(--af-glass-border);"></div>

                    <div class="d-flex justify-content-end mt-4 pt-3" style="border-top: 1px solid var(--af-glass-border);">
                        <button type="button" class="btn btn-link text-white-50 text-decoration-none me-3" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="af-btn border-0 py-2 px-4" style="font-size: 1rem;">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const inputImagem = document.getElementById('imagem_usuario');
    const previewImagem = document.getElementById('preview_imagem_usuario');

    if (inputImagem && previewImagem) {
        inputImagem.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            if (file.size > 2 * 1024 * 1024) { // 2 MB
                alert('A imagem deve ter no máximo 2 MB.');
                this.value = ''; // limpa o input
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImagem.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        previewImagem.addEventListener('click', () => {
            inputImagem.click();
        });
    }

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

    const formConfig = document.getElementById('form-configuracoes-usuario');
    if (formConfig) {
        formConfig.addEventListener('submit', function(e) {
            e.preventDefault();

            const feedback = document.getElementById('mensagem-feedback');
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Salvando...';
            submitBtn.disabled = true;

            const formData = new FormData();
            formData.append('novo_username', document.getElementById('novo_username').value);
            formData.append('novo_email', document.getElementById('novo_email').value);
            formData.append('nova_senha', document.getElementById('nova_senha').value);

            const imagemFile = document.getElementById('imagem_usuario').files[0];
            if (imagemFile) {
                formData.append('imagem_usuario', imagemFile);
            }

            fetch('backend/atualizar_usuario.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    feedback.style.display = 'block';
                    if (data.success) {
                        feedback.innerHTML = '<i class="fas fa-check-circle text-success me-2"></i>' + 'Alterações salvas com sucesso!';
                        feedback.style.borderColor = 'rgba(25, 135, 84, 0.5)';
                        // Reload page after a short delay to update avatars in header
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        feedback.innerHTML = '<i class="fas fa-exclamation-circle text-danger me-2"></i>' + (data.message || 'Erro ao atualizar usuário.');
                        feedback.style.borderColor = 'rgba(220, 53, 69, 0.5)';
                    }
                })
                .catch(() => {
                    feedback.style.display = 'block';
                    feedback.innerHTML = '<i class="fas fa-exclamation-circle text-danger me-2"></i>Erro de comunicação com o servidor.';
                    feedback.style.borderColor = 'rgba(220, 53, 69, 0.5)';
                })
                .finally(() => {
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                });
        });
    }
</script>
