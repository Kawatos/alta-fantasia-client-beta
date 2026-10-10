<?php
// A tela de login foi substituída por um modal (auth-modal.php).
// Este arquivo existe apenas para não quebrar links/favoritos antigos; pode ser removido.
header('Location: alta.php?auth=login', true, 301);
exit;