// ==========================================
// ARQUIVO: assets/js/home/templates.js
// ==========================================

export function templateSidebarCampanha(c) {
    const inicial = c.nome.charAt(0).toUpperCase();
    const descricao = c.descricao ? c.descricao : 'Sem descrição';
    
    return `
        <a href="#" class="campanha-item text-decoration-none text-dark p-2 d-flex align-items-center" data-id="${c.id}">
            <div class="avatar-campanha rounded-circle d-flex justify-content-center align-items-center me-3 flex-shrink-0">
                ${inicial}
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h6 class="mb-0 text-truncate fw-bold">${c.nome}</h6>
                <small class="text-muted text-truncate d-block">${descricao}</small>
            </div>
        </a>
    `;
}

export function templateEsqueletoCampanha() {
    return `
        <div class="bg-white border-bottom p-2 d-flex align-items-center justify-content-between shadow-sm z-1 flex-shrink-0">
            <div class="d-flex align-items-center gap-2 overflow-hidden">
                <button class="btn btn-light d-md-none px-2" id="btnVoltarLista">
                    <span class="fs-5">←</span>
                </button>
                <div class="avatar-campanha rounded-circle d-flex justify-content-center align-items-center" style="width:40px; height:40px; font-size:1rem;" id="headerAvatar"></div>
                <div class="overflow-hidden">
                    <h5 class="mb-0 fw-bold text-truncate" id="headerNome">Carregando...</h5>
                </div>
            </div>
            <div id="headerActions"></div>
        </div>

        <ul class="nav nav-tabs bg-white px-3 pt-2 flex-shrink-0" id="campanhaTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold text-dark" id="tab-chat" data-bs-toggle="tab" data-bs-target="#pane-chat" type="button" role="tab">💬 Chat</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold text-dark" id="tab-jogadores" data-bs-toggle="tab" data-bs-target="#pane-jogadores" type="button" role="tab">⚔️ Jogadores</button>
            </li>
        </ul>

        <div class="tab-content flex-grow-1 bg-white" id="campanhaTabsContent" style="min-height: 0; overflow: hidden;">
            
            <div class="tab-pane fade show active h-100" id="pane-chat" role="tabpanel">
                <div class="d-flex flex-column h-100 w-100">
                    <div id="chatMensagens" class="flex-grow-1 p-3 d-flex flex-column" style="overflow-y: auto; min-height: 0;"></div>
                    
                    <div class="p-2 bg-light border-top flex-shrink-0">
                        <form id="formChat" class="d-flex gap-2 mb-0">
                            <input type="text" id="chatInput" class="form-control rounded-pill" placeholder="Digite uma mensagem..." autocomplete="off">
                            <button type="submit" class="btn btn-primary px-3 fw-bold">➤</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade h-100 overflow-auto p-3 bg-light" id="pane-jogadores" role="tabpanel">
                <div id="listaJogadores" class="row g-2"></div>
            </div>

        </div>
    `;
}

export function templateJogador(j, idLogado, papelCampanha) {
    const badge = j.papel === 'mestre' 
        ? '<span class="badge bg-success">Mestre</span>' 
        : '<span class="badge bg-secondary">Jogador</span>';

    let botoes = '';
    
    // Botões para o próprio usuário
    if (j.id == idLogado) {
        botoes += `
            <button class="btn btn-sm btn-outline-success btn-add-ficha py-0 px-2" data-user="${j.id}" title="Adicionar da sua lista" style="font-size:0.9rem;">+ Adicionar</button>
            <button class="btn btn-sm btn-primary btn-criar-ficha-campanha py-0 px-2" style="font-size:0.9rem;">Criar</button>
        `;
    }
    
    // Botão de remover (Apenas mestre pode remover outros que não sejam ele mesmo)
    if (papelCampanha === 'mestre' && j.id != idLogado && j.papel != 'mestre') {
        botoes += `<button class="btn btn-sm btn-outline-danger py-0 px-2 remover-jogador" data-id="${j.id}" title="Remover Jogador">✖</button>`;
    }

    return `
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm jogador-item" data-id="${j.id}" style="cursor: pointer;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h6 class="mb-0 fw-bold">${j.username}</h6>
                            ${badge}
                        </div>
                        <div class="d-flex gap-1 flex-wrap justify-content-end">
                            ${botoes}
                        </div>
                    </div>
                    <div class="fichas-usuario mt-2 pt-2 border-top" id="fichas-user-${j.id}" style="display:none;"></div>
                </div>
            </div>
        </div>
    `;
}

export function templateFichaUsuario(f, idLogado, papelCampanha) {
    const donoFicha = f.usuario_id;
    const podeEditar = (idLogado == donoFicha || papelCampanha === 'mestre');
    
    const imagem = f.personagem_imagem ? f.personagem_imagem : 'uploads/perfil-vazio.png';
    const imagemEstilo = f.personagem_imagem ? '' : 'opacity:0.5;';
    const tipoFicha = f.tipo_ficha || 'padrao';
    
    let badgeEstilo = '';
    let badgeTexto = '';
    
    if (tipoFicha === 'bloco') {
        badgeEstilo = 'bg-warning';
        badgeTexto = 'Bloco de Notas';
    } else if (tipoFicha === 'arquivo') {
        badgeEstilo = 'bg-info';
        badgeTexto = 'PDF';
    } else {
        badgeEstilo = 'bg-primary';
        badgeTexto = 'Padrão Alta';
    }

    const classeEditavel = podeEditar ? 'editar-ficha ficha-hover' : '';
    const cursorStyle = podeEditar ? 'cursor: pointer;' : '';
    const nomePersonagem = f.nome_personagem || 'Sem nome';

    let botoes = '';
    if (podeEditar) {
        botoes += `
            <button class="btn btn-light btn-sm py-0" style="font-size:0.8rem; pointer-events: none;">Editar</button>
            <button class="btn btn-outline-danger btn-sm py-0 remover-ficha" data-id="${f.id}" style="font-size:0.8rem;">Remover</button>
        `;
    }

    return `
        <div class="d-flex align-items-center gap-2 mb-2 bg-white p-2 rounded border ${classeEditavel}" data-id="${f.id}" data-tipo="${tipoFicha}" style="${cursorStyle} transition: background-color 0.2s;">
            <img src="${imagem}" style="width:36px;height:36px;object-fit:cover;border-radius:6px;${imagemEstilo}">
            
            <div class="flex-grow-1 overflow-hidden">
                <div class="mb-1">
                    <span class="badge ${badgeEstilo}" style="font-size: 0.65rem;">${badgeTexto}</span>
                </div>
                <div class="fw-bold small text-truncate">${nomePersonagem}</div>
                <div class="d-flex gap-1 mt-1">
                    ${botoes}
                </div>
            </div>
        </div>
    `;
}

export function templateMensagem(m, dataFormatada, idLogado, papelCampanha) {
    const podeExcluir = (idLogado == m.usuario_id || papelCampanha === 'mestre');
    const btnExcluir = podeExcluir 
        ? `<button class="btn-lixeira ms-2" data-id="${m.id}" title="Excluir mensagem">🗑️</button>` 
        : '';

    return `
        <div class="w-100 d-flex flex-column align-items-start">
            <div class="chat-bubble d-flex flex-column" style="min-width: 120px;">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <small class="fw-bold text-primary flex-shrink-0" style="font-size: 0.75rem; white-space: nowrap;">
                        ${m.username}
                    </small>
                    ${btnExcluir}
                </div>
                <div class="chat-text">${m.mensagem}</div>
                <span class="chat-timestamp flex-shrink-0">${dataFormatada}</span>
            </div>
        </div>
    `;
}

export function templateItemMinhasFichas(f) {
    const checked = f.na_campanha ? 'checked' : '';
    const disabled = f.na_campanha ? 'disabled' : '';
    const avisoNaCampanha = f.na_campanha 
        ? '<small class="text-success d-block" style="font-size:0.8rem;">(Já na campanha)</small>' 
        : '';

    return `
        <label class="list-group-item d-flex gap-2 align-items-center">
            <input class="form-check-input flex-shrink-0 check-ficha" type="checkbox" value="${f.id}" ${checked} ${disabled}>
            <span>
                ${f.nome_personagem}
                ${avisoNaCampanha}
            </span>
        </label>
    `;
}