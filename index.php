<?php
/**
 * Alta Fantasia — Single Page Application (SPA)
 * Unifica a Landing (Apresentação) e o Painel do RPG (Fichas, Campanhas, Chat, Editor).
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$bodyClass = 'af-page af';
$landingNav = true;

include('header.php');
?>

<div class="af-progress" aria-hidden="true"></div>

<div id="af-spa-container" class="af-spa-container">
    <!-- VISÃO 1: APRESENTAÇÃO / LANDING PAGE -->
    <?php include('landing-content.php'); ?>

    <!-- VISÃO 2: PAINEL DO RPG (FICHAS, CAMPANHAS, CHAT, EDITOR) -->
    <?php include('app-dashboard.php'); ?>

    <!-- VISÃO 3: WIKI OFICIAL INTEGRADA -->
    <?php include('wiki-content.php'); ?>
</div>

<script src="js/alta-landing.js" defer></script>
<script src="js/spa-router.js" defer></script>

<?php include('footer.php'); ?>