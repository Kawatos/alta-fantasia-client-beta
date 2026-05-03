<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: bemvindo.php");
    exit;
}
?>

<?php include('header.php'); ?>




<div class="container text-center mt-4">
    <div class="row g-2">
        <div class="col-12">
            <h1 class="display-5 fw-bold">
                <span class="font-alta">Alta</span>
                <span class="title-dynamic font-fantasia fw-bold" id="fantasiaText">Fantasia</span>
            </h1>
            <div class="text-center mt-2 mb-4">
                <i class="fas fa-dice-d20 me-1"></i>
                <i class="fas fa-dice-d20 ms-1"></i>
                <p id="mensagem" class="mb-0 text-muted fade">

                    <em></em>
                </p>
            </div>
            <h3 class="text-center mb-4">Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>

            <div class="d-grid gap-2 col-6 mx-auto mb-5">
                <button id="botaoCriarFicha" class="btn btn-primary">Criar Novo Personagem</button>
            </div>

            <h2 class="mb-4">Seus Personagens</h2>

            <div class="container mt-4">
                <div id="lista-fichas" class="row row-cols-1 row-cols-lg-5 justify-content-center">
                    <!-- Fichas serão inseridas aqui -->
                </div>
            </div>

        </div>
    </div>
</div>



<script>

</script>



<?php include('footer.php'); ?>