// ==========================================
// ARQUIVO: assets/js/home/api.js
// ==========================================

// --- CAMPANHAS ---

export function listarCampanhas() {
    return $.ajax({
        url: 'backend/listar_campanhas.php',
        method: 'GET',
        dataType: 'json'
    });
}

export function buscarCampanhaDetalhes(campanhaId) {
    // Usar $.ajax em vez de $.get para garantir o dataType
    return $.ajax({
        url: 'backend/buscar_campanha_detalhes.php',
        method: 'GET',
        data: { campanha_id: campanhaId },
        dataType: 'json' // <--- CRUCIAL
    });
}

export function criarCampanha(formData) {
    return $.ajax({
        url: 'backend/criar_campanha.php',
        method: 'POST',
        data: formData, // Aqui passamos o $(this).serialize()
        dataType: 'json'
    });
}

export function entrarCampanha(formData) {
    return $.ajax({
        url: 'backend/entrar_campanha.php',
        method: 'POST',
        data: formData, // Aqui passamos o $(this).serialize()
        dataType: 'json'
    });
}

export function editarCampanha(campanhaId, nome, descricao) {
    return $.ajax({
        url: 'backend/editar_campanha.php',
        method: 'POST',
        data: { campanha_id: campanhaId, nome: nome, descricao: descricao },
        dataType: 'json'
    });
}

export function excluirCampanha(campanhaId) {
    return $.ajax({
        url: 'backend/excluir_campanha.php',
        method: 'POST',
        data: { campanha_id: campanhaId },
        dataType: 'json'
    });
}

export function sairCampanha(campanhaId) {
    return $.ajax({
        url: 'backend/sair_campanha.php',
        method: 'POST',
        data: { campanha_id: campanhaId },
        dataType: 'json'
    });
}


// --- CHAT ---

export function listarMensagens(campanhaId, ultimoId = 0) {
    return $.ajax({
        url: 'backend/listar_mensagens.php',
        method: 'GET',
        data: { 
            campanha_id: campanhaId,
            ultimo_id: ultimoId // <-- Novo parâmetro sendo enviado
        },
        dataType: 'json' 
    });
}

export function enviarMensagem(mensagem, campanhaId) {
    return $.ajax({
        url: 'backend/enviar_mensagem.php',
        method: 'POST',
        data: { mensagem: mensagem, campanha_id: campanhaId },
        dataType: 'json'
    });
}

export function excluirMensagem(mensagemId, campanhaId) {
    return $.ajax({
        url: 'backend/excluir_mensagem.php',
        method: 'POST',
        data: { mensagem_id: mensagemId, campanha_id: campanhaId },
        dataType: 'json'
    });
}


// --- JOGADORES E FICHAS ---

export function buscarFichasUsuario(usuarioId, campanhaId) {
    return $.ajax({
        url: 'backend/buscar_fichas_usuario.php',
        method: 'GET',
        data: {
            usuario_id: usuarioId,
            campanha_id: campanhaId
        },
        dataType: 'json' 
    });
}

export function buscarMinhasFichasParaAdicionar(campanhaId) {
    return $.ajax({
        url: 'backend/buscar_fichas.php',
        method: 'GET',
        data: { 
            campanha_id: campanhaId 
        },
        dataType: 'json'
    });
}

export function adicionarFichasCampanha(campanhaId, fichasIds) {
    return $.ajax({
        url: 'backend/adicionar_fichas_campanha.php',
        method: 'POST',
        data: {
            campanha_id: campanhaId,
            fichas: fichasIds
        },
        dataType: 'json' // O segredo para a tela atualizar
    });
}

export function removerFichaCampanha(fichaId, campanhaId) {
    return $.ajax({
        url: 'backend/remover_ficha_campanha.php',
        method: 'POST',
        data: {
            ficha_id: fichaId,
            campanha_id: campanhaId
        },
        dataType: 'json'
    });
}

export function removerJogadorCampanha(usuarioId, campanhaId) {
    return $.ajax({
        url: 'backend/remover_jogador_campanha.php',
        method: 'POST',
        data: {
            usuario_id: usuarioId,
            campanha_id: campanhaId
        },
        dataType: 'json'
    });
}
// Nota: No seu código original você usou fetch puro para criar a ficha.
// Mantive a estrutura com fetch, mas devolvendo ele para o main.js tratar.
export function criarFicha(nomePersonagem, tipoFicha) {
    return fetch('backend/criar_ficha.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            nome_personagem: nomePersonagem,
            tipo_ficha: tipoFicha
        })
    }).then(resp => resp.json());
}

export function duplicarFicha(fichaId) {
    return $.ajax({
        url: 'backend/duplicar_ficha.php',
        method: 'POST',
        data: { id: fichaId },
        dataType: 'json'
    });
}