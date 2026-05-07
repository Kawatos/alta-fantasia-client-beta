// ==========================================
// ARQUIVO: assets/js/editor/api.js
// ==========================================

// --- FICHAS (CRUD PRINCIPAL) ---

export function listarFichas() {
    return $.ajax({
        url: 'backend/buscar_fichas.php',
        method: 'GET',
        dataType: 'json'
    });
}

export function criarFicha(nomePersonagem, tipoFicha) {
    return $.ajax({
        url: 'backend/criar_ficha.php',
        method: 'POST',
        data: { nome_personagem: nomePersonagem, tipo_ficha: tipoFicha },
        dataType: 'json'
    });
}

export function buscarDadosFicha(fichaId) {
    return $.ajax({
        url: 'backend/get_dados_ficha.php',
        method: 'POST',
        data: { id_ficha: fichaId },
        dataType: 'json'
    });
}

export function excluirFicha(fichaId) {
    return $.ajax({
        url: 'backend/excluir_ficha.php',
        method: 'POST',
        data: { id: fichaId },
        dataType: 'json'
    });
}

export function salvarFicha(formData) {
    // Como formData pode conter arquivos (imagem), usamos configurações especiais no $.ajax
    return $.ajax({
        url: 'backend/editar_ficha_ajax.php',
        method: 'POST',
        data: formData,
        processData: false, // Necessário para FormData
        contentType: false, // Necessário para FormData
        dataType: 'json'
    });
}

export function salvarFichaSimples(formData) {
    return $.ajax({
        url: 'backend/editar_ficha_simples.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json'
    });
}


// --- HABILIDADES ---

export function getHabilidades(fichaId) {
    return $.ajax({
        url: 'backend/habilidades/get_habilidades.php',
        method: 'POST',
        data: { id_ficha: fichaId },
        dataType: 'json'
    });
}

export function salvarHabilidade(formData) {
    return $.ajax({
        url: 'backend/habilidades/controle_habilidades.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json'
    });
}


// --- MAGIAS ---

export function getMagias(fichaId) {
    return $.ajax({
        url: 'backend/magias/get_magias.php',
        method: 'POST',
        data: { id_ficha: fichaId },
        dataType: 'json'
    });
}

export function salvarMagia(formData) {
    return $.ajax({
        url: 'backend/magias/controle_magias.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json'
    });
}


// --- ITENS ---

export function getItens(fichaId) {
    return $.ajax({
        url: 'backend/itens/get_itens.php',
        method: 'POST',
        data: { id_ficha: fichaId },
        dataType: 'json'
    });
}

export function salvarItem(formData) {
    return $.ajax({
        url: 'backend/itens/controle_itens.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json'
    });
}