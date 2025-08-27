
<!-- Footer -->
<footer class="bg-primary text-white py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <!-- Informações do Projeto -->
            <div class="col-lg-4 mb-4">
                <h1 class="h5 fw-bold text-">
                    <span class="font-alta">Alta</span>
                    <span class="font-fantasia fw-bold" id="">Fantasia</span>
                </h1>
                <p class="mb-3">
                    Um sistema de RPG de mesa épico e ambicioso, criado com paixão para aventuras inesquecíveis.
                </p>
                <div class="d-flex align-items-center">
                    <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                        <i class="fas fa-code-branch me-1"></i>Versão V 1.0 Alfa
                    </span>
                </div>
            </div>

            <!-- Contatos -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-envelope me-2"></i>Contato
                </h5>
                <div class="d-flex flex-column gap-2">
                    <a href="https://github.com/Kawatos" class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fab fa-github me-2"></i>GitHub - Kawatos
                    </a>
                    <a href="mailto:kauasilavamattos0000@gmail.com" class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fas fa-envelope me-2"></i>kauasilavamattos0000@gmail.com
                    </a>
                    <a href="https://discord.gg/5dUCkfHspN" class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fab fa-discord me-2"></i>Discord - Alta Fantasia
                    </a>
                    <a href="https://www.instagram.com/kawatoslife/" class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fab fa-instagram me-2"></i>@kawatoslife
                    </a>
                </div>
            </div>

            <!-- Agradecimentos -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-heart me-2"></i>Agradecimentos
                </h5>

                <!-- Consulta de Código -->
                <div class="mb-3">
                    <h6 class="text-warning fw-semibold mb-2">
                        <i class="fas fa-code me-1"></i>Consulta de Código
                    </h6>
                    <p class="mb-0 small">
                        <i class="fas fa-user me-1"></i>Adriano Campos
                    </p>
                </div>

                <!-- Feedback de Sistema -->
                <div>
                    <h6 class="text-warning fw-semibold mb-2">
                        <i class="fas fa-comments me-1"></i>Feedback de Sistema e Players
                    </h6>
                    <div class="small">
                        <p class="mb-0"><i class="fas fa-user me-1"></i>Jooj <span class="text-muted">(Lucas Khun)</span></p>
                        <p class="mb-1"><i class="fas fa-user me-1"></i>Jaum <span class="text-muted">(João Mendonça)</span></p>
                        <p class="mb-1"><i class="fas fa-user me-1"></i>Matsall <span class="text-muted">(Mateus Reis)</span></p>
                        <p class="mb-1"><i class="fas fa-user me-1"></i>Ike <span class="text-muted">(Henrique A. Griebeler)</span></p>
                        <p class="mb-1"><i class="fas fa-user me-1"></i>Gui <span class="text-muted">(Guilherme A. Paes)</span></p>
                        <p class="mb-0"><i class="fas fa-user me-1"></i>Gado <span class="text-muted">(Gabriel Padilha)</span></p>
                        <p class="mb-0"><i class="fas fa-user me-1"></i>Gãgs <span class="text-muted">(Gadiel Vargas)</span></p>
                        <p class="mb-0"><i class="fas fa-user me-1"></i>Stei <span class="text-muted">(Artur Endres)</span></p>
                        <p class="mb-0"><i class="fas fa-user me-1"></i>Joaobachi <span class="text-muted">(João Bachi)</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Linha divisória -->
        <hr class="my-4 border-secondary">

        <!-- Copyright e Links -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">
                    <i class="fas fa-copyright me-1"></i>
                    2025 Alta Fantasia RPG. Criado por <strong>Kauã Mattos</strong>
                </p>
                <p class="my-2 ">
                    Ad Astra Per Aspera - "Para as estrelas através das dificuldades"
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="d-flex justify-content-center justify-content-md-end gap-3">
                    <a href="https://github.com/Kawatos/alta-fantasia-client-beta"
                        class="text-white text-decoration-none">
                        <i class="fab fa-github me-1"></i>Open Source
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fas fa-shield-alt me-1"></i>Privacidade
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fas fa-file-alt me-1"></i>Termos
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>

    </div>
</footer>

<!-- Botão Voltar ao Topo -->
<button id="backToTop" class="btn btn-warning position-fixed bottom-0 end-0 m-4 rounded-circle d-none"
    style="width: 50px; height: 50px; z-index: 1000;">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Botão voltar ao topo
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopBtn = document.getElementById('backToTop');

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.remove('d-none');
            } else {
                backToTopBtn.classList.add('d-none');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });

    
</script>

</body>
</html>