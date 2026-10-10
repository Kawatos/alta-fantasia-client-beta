// ==========================================
// ARQUIVO: assets/js/home/templates.js
// Visual Moderno, RPG Glassmorphism & Alta Legibilidade
// ==========================================

export function templateSidebarCampanha(c) {
    const inicial = c.nome ? c.nome.charAt(0).toUpperCase() : 'M';
    const descricao = c.descricao ? c.descricao : 'Campanha de RPG';

    return `
        <a href="#" class="campanha-item text-decoration-none text-white p-3 mb-2.5 d-flex align-items-center rounded-3" data-id="${c.id}" style="background: rgba(255, 255, 255, 0.04); border: 1px solid var(--af-glass-border); transition: all 0.2s ease;">
            <div class="avatar-campanha rounded-circle d-flex justify-content-center align-items-center me-3.5 flex-shrink-0 shadow-sm" style="width: 46px; height: 46px; background: linear-gradient(135deg, rgba(240, 199, 94, 0.25), rgba(18, 20, 58, 0.9)); border: 1px solid var(--af-gold-soft); color: var(--af-gold-soft); font-weight: 700; font-size: 1.15rem;">
                ${inicial}
            </div>
            <div class="flex-grow-1 overflow-hidden ms-1">
                <h6 class="mb-1 text-truncate fw-bold text-white" style="font-size: 0.95rem;">${c.nome}</h6>
                <small class="text-white-50 text-truncate d-block mt-0.5" style="font-size: 0.76rem;"><i class="bi bi-compass me-1.5 text-warning"></i>${descricao}</small>
            </div>
            <i class="bi bi-chevron-right text-white-50 fs-6 ms-2 opacity-75"></i>
        </a>
    `;
}

export function templateEsqueletoCampanha() {
    return `
        <div class="border-bottom p-2.5 p-md-3 d-flex align-items-center justify-content-between shadow-sm z-1 flex-shrink-0" style="background: rgba(14, 16, 44, 0.95); border-color: var(--af-glass-border) !important;">
            <div class="d-flex align-items-center gap-3 overflow-hidden">
                <button class="btn btn-sm btn-outline-primary d-md-none me-1 d-flex align-items-center justify-content-center flex-shrink-0" id="btnVoltarLista" title="Voltar para a lista" style="height: 36px; width: 36px;">
                    <i class="bi bi-arrow-left fs-5"></i>
                </button>
                <div class="avatar-campanha rounded-circle d-flex justify-content-center align-items-center flex-shrink-0 shadow-sm me-1" style="width:46px; height:46px; font-size:1.15rem; background: linear-gradient(135deg, rgba(240,199,94,0.3), rgba(18,20,58,0.9)); border: 1px solid var(--af-gold-soft); color: var(--af-gold-soft); font-weight: 700;" id="headerAvatar">🎲</div>
                <div class="overflow-hidden">
                    <h5 class="mb-1 fw-bold text-truncate text-white" id="headerNome">Carregando...</h5>
                    <small class="text-white-50 d-block lh-sm" style="font-size: 0.74rem;"><i class="bi bi-shield-check me-1.5 text-success"></i>Mesa de RPG Ativa</small>
                </div>
            </div>
            <div id="headerActions" class="d-flex align-items-center gap-2"></div>
        </div>

        <!-- Abas da Mesa de RPG (Pills Modernas) -->
        <ul class="nav nav-pills gap-2.5 px-3 pt-2 pb-2 flex-shrink-0 border-bottom" id="campanhaTabs" role="tablist" style="background: rgba(12, 14, 40, 0.95); border-color: var(--af-glass-border) !important;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-3.5 py-2 fw-bold d-flex align-items-center" id="tab-chat" data-bs-toggle="pill" data-bs-target="#pane-chat" type="button" role="tab">
                    <i class="bi bi-chat-dots-fill text-warning me-2 fs-6"></i>
                    <span>Chat da Mesa</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-3.5 py-2 fw-bold d-flex align-items-center" id="tab-jogadores" data-bs-toggle="pill" data-bs-target="#pane-jogadores" type="button" role="tab">
                    <i class="bi bi-people-fill text-info me-2 fs-6"></i>
                    <span>Jogadores &amp; Fichas</span>
                </button>
            </li>
        </ul>

        <div class="tab-content flex-grow-1" id="campanhaTabsContent" style="min-height: 0; overflow: hidden; background: transparent;">
            
            <!-- Painel do Chat -->
            <div class="tab-pane fade show active h-100" id="pane-chat" role="tabpanel">
                <div class="d-flex flex-column h-100 w-100">
                    <div id="chatMensagens" class="flex-grow-1 p-3 d-flex flex-column" style="overflow-y: auto; min-height: 0; gap: 4px;"></div>
                    
                    <div class="p-2 p-md-3 border-top flex-shrink-0" style="background: rgba(12, 14, 40, 0.95); border-color: var(--af-glass-border) !important;">
                        <form id="formChat" class="d-flex gap-2 mb-0 align-items-center">
                            <input type="text" id="chatInput" class="form-control rounded-pill px-3" placeholder="Envie uma mensagem para a mesa..." autocomplete="off" style="background: rgba(0,0,0,0.4); border: 1px solid var(--af-glass-border); color: #fff;">
                            <button type="submit" class="btn btn-success rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 42px; height: 42px;" title="Enviar Mensagem">
                                <i class="fas fa-paper-plane" style="font-size: 0.95rem;"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Painel de Jogadores e Fichas (Lista em Coluna Única com Mestre no Topo) -->
            <div class="tab-pane fade h-100 overflow-auto p-3" id="pane-jogadores" role="tabpanel" style="background: transparent;">
                <div class="d-flex align-items-center justify-content-between mb-3 px-1" style="max-width: 820px; margin: 0 auto;">
                    <div>
                        <h6 class="mb-1 fw-bold text-white d-flex align-items-center gap-2">
                            <i class="bi bi-shield-shaded text-warning"></i> Membros da Mesa
                        </h6>
                        <small class="text-white-50" style="font-size: 0.75rem;">Toque em qualquer jogador para visualizar suas fichas</small>
                    </div>
                </div>
                <div id="listaJogadores" class="d-flex flex-column gap-3 pb-4" style="max-width: 820px; margin: 0 auto;"></div>
            </div>

        </div>
    `;
}

export function templateJogador(j, idLogado, papelCampanha) {
    const isMestre = (j.papel === 'mestre');
    const roleBadge = isMestre
        ? '<span class="badge py-1 px-2.5 ms-2" style="background: linear-gradient(135deg, #d4a017, #b8860b); color: #101235; font-weight: 700; box-shadow: 0 2px 6px rgba(212,160,23,0.3); font-size: 0.72rem;"><i class="fas fa-crown me-1"></i>Mestre</span>'
        : '<span class="badge py-1 px-2.5 ms-2" style="background: rgba(255,255,255,0.1); color: #e9eaf5; border: 1px solid rgba(255,255,255,0.18); font-size: 0.72rem;"><i class="fas fa-shield-alt me-1"></i>Jogador</span>';

    let btnRemover = '';
    // Botão de remover (Apenas mestre pode remover outros jogadores)
    if (papelCampanha === 'mestre' && j.id != idLogado && !isMestre) {
        btnRemover = `<button class="btn btn-sm btn-outline-danger py-1 px-2.5 remover-jogador flex-shrink-0" data-id="${j.id}" title="Remover Jogador da Mesa" style="font-size:0.78rem; border-radius: 6px;"><i class="bi bi-person-x"></i></button>`;
    }

    const inicial = j.username ? j.username.charAt(0).toUpperCase() : 'J';

    return `
        <div class="card border-0 shadow-sm jogador-item w-100" data-id="${j.id}" data-username="${j.username || 'Jogador'}" data-papel="${j.papel || 'jogador'}" style="cursor: pointer; background: rgba(18, 20, 52, 0.75); backdrop-filter: blur(10px); border: 1px solid var(--af-glass-border) !important; border-radius: 12px; transition: all 0.25s var(--af-ease);">
            <div class="card-body p-3.5 d-flex align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center flex-grow-1 overflow-hidden" style="min-width: 0;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0 shadow-sm me-3.5" style="width: 46px; height: 46px; background: rgba(240,199,94,0.15); border: 1px solid var(--af-gold-soft); color: var(--af-gold-soft); font-size: 1.15rem;">
                        ${inicial}
                    </div>
                    <div class="overflow-hidden flex-grow-1 p-2" style="min-width: 0;">
                        <div class="d-flex align-items-center flex-wrap ">
                            <h6 class="mb-0 fw-bold text-white text-truncate" style="font-size: 0.95rem;">${j.username}</h6>
                            ${roleBadge}
                        </div>
                        <small class="text-white-50 d-flex align-items-center gap-1.5 mt-1.5" style="font-size: 0.75rem;">
                            <i class="bi bi-person-lines-fill text-warning"></i> Toque para ver as fichas
                        </small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    ${btnRemover}
                    <i class="bi bi-chevron-right text-white-50 fs-6"></i>
                </div>
            </div>
        </div>
    `;
}

export function templateFichaUsuario(f, idLogado, papelCampanha) {
    const donoFicha = f.usuario_id;
    const podeEditar = (idLogado == donoFicha || papelCampanha === 'mestre');

    const imagem = f.personagem_imagem ? f.personagem_imagem : 'uploads/perfil-vazio.png';
    const tipoFicha = f.tipo_ficha || 'padrao';

    // 🎨 Configuração visual dos tipos de ficha idêntica à barra lateral
    const configTipos = {
        'padrao': { nome: '⚔️ Padrão', cor: 'bg-primary text-white' },
        'bloco': { nome: '📝 Bloco', cor: 'bg-warning text-dark' },
        'arquivo': { nome: '📄 PDF', cor: 'bg-info text-dark' }
    };
    const estiloTipo = configTipos[tipoFicha] || { nome: tipoFicha, cor: 'bg-secondary text-white' };

    let infoProgressao = '';
    if (tipoFicha === 'padrao') {
        const xp = parseInt(f.nivel || f.experiencia_total || 0, 10);
        const nivelAtual = Math.floor(xp / 100);
        const rankAtual = Math.floor((nivelAtual - 1) / 10) + 1;
        infoProgressao = `<small class="text-white-50 d-flex align-items-center gap-1 mt-1" style="font-size:0.74rem;"><span class="text-warning fw-bold">Nv ${nivelAtual}</span> • <span>Rank ${rankAtual}</span></small>`;
    } else {
        infoProgressao = `<small class="text-white-50 d-block mt-1" style="font-size:0.72rem;">Ficha Personalizada</small>`;
    }

    const nomePersonagem = f.nome_personagem || 'Sem nome';

    let dropdownOpcoes = '';
    if (podeEditar) {
        dropdownOpcoes = `
            <div class="dropdown flex-shrink-0 ms-2">
                <button class="btn btn-sm btn-link text-muted p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Opções" style="line-height: 1;">
                    <i class="bi bi-three-dots-vertical fs-5"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="z-index:1070;">
                    <li>
                        <button class="dropdown-item d-flex align-items-center gap-2 editar-ficha" data-id="${f.id}" data-tipo="${tipoFicha}">
                            <i class="bi bi-pencil text-secondary"></i> Editar Ficha
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center gap-2 duplicar-ficha-campanha" data-id="${f.id}">
                            <i class="bi bi-files text-info"></i> Duplicar Ficha
                        </button>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center gap-2 text-danger remover-ficha" data-id="${f.id}">
                            <i class="bi bi-trash"></i> Remover da Mesa
                        </button>
                    </li>
                </ul>
            </div>
        `;
    }

    return `
        <div class="sidebar-ficha-item d-flex align-items-center justify-content-between p-2 m-2 rounded-3" data-id="${f.id}" data-tipo="${tipoFicha}" style="background: rgba(255, 255, 255, 0.04); border: 1px solid var(--af-glass-border); cursor: pointer; transition: all 0.2s ease;">
            <div class="editar-ficha d-flex align-items-center flex-grow-1 overflow-hidden" data-id="${f.id}" data-tipo="${tipoFicha}" style="min-width: 0;">
                <img src="${imagem}" class="rounded shadow-sm flex-shrink-0 me-3" style="width: 44px; height: 44px; object-fit: cover; border: 1px solid rgba(255,255,255,0.15);">
                <div class="flex-grow-1 overflow-hidden" style="min-width: 0;">
                    <div class="d-flex align-items-center justify-content-between gap-2">
                        <h6 class="mb-0 text-truncate fw-bold text-white flex-grow-1 me-2.5" style="font-size: 0.92rem;">${nomePersonagem}</h6>
                        <span class="badge ${estiloTipo.cor} flex-shrink-0" style="font-size: 0.65rem; font-weight: 600; padding: 0.35em 0.6em;">
                            ${estiloTipo.nome}
                        </span>
                    </div>
                    ${infoProgressao}
                </div>
            </div>
            ${dropdownOpcoes}
        </div>
    `;
}

export function templateMensagem(m, dataFormatada, idLogado, papelCampanha) {
    const isMe = (idLogado == m.usuario_id);
    const podeExcluir = isMe || (papelCampanha === 'mestre');
    const btnExcluir = podeExcluir
        ? `<button class="btn-lixeira ms-1 text-danger opacity-75" data-id="${m.id}" title="Excluir mensagem" style="background:none; border:none; padding:0 2px;"><i class="bi bi-trash" style="font-size:0.75rem;"></i></button>`
        : '';

    const bubbleClass = isMe ? 'chat-bubble-me' : 'chat-bubble-other';
    const userTag = isMe
        ? `<span class="badge bg-warning text-dark px-1.5 py-0.5" style="font-size:0.65rem; font-weight:700;">Você</span>`
        : `<span class="fw-bold d-flex align-items-center gap-1" style="color: var(--af-gold-soft); font-size: 0.8rem;"><i class="bi bi-person-circle text-warning opacity-75"></i>${m.username}</span>`;

    return `
        <div class="d-flex flex-column mb-1.5 w-100 ${isMe ? 'align-items-end' : 'align-items-start'}">
            <div class="chat-bubble ${bubbleClass} d-flex flex-column shadow-sm" style="max-width: 85%; min-width: 140px;">
                <div class="d-flex justify-content-between align-items-center gap-2 mb-1 pb-1 border-bottom" style="border-color: rgba(255,255,255,0.08) !important;">
                    ${userTag}
                    <div class="d-flex align-items-center gap-1">
                        <span class="chat-timestamp text-white-50" style="font-size: 0.65rem;">${dataFormatada}</span>
                        ${btnExcluir}
                    </div>
                </div>
                <div class="chat-text text-start text-white">${m.mensagem}</div>
            </div>
        </div>
    `;
}

export function templateItemMinhasFichas(f) {
    const checked = f.na_campanha ? 'checked' : '';
    const disabled = f.na_campanha ? 'disabled' : '';
    const avisoNaCampanha = f.na_campanha
        ? '<small class="text-success d-block" style="font-size:0.8rem;"><i class="bi bi-check-circle me-1"></i>Já adicionada à campanha</small>'
        : '';

    return `
        <label class="list-group-item d-flex gap-2.5 align-items-center py-2.5" style="background: rgba(255, 255, 255, 0.04); border-color: var(--af-glass-border); color: #fff;">
            <input class="form-check-input flex-shrink-0 check-ficha" type="checkbox" value="${f.id}" ${checked} ${disabled}>
            <div class="flex-grow-1 overflow-hidden">
                <span class="fw-bold text-white d-block text-truncate">${f.nome_personagem || 'Sem nome'}</span>
                ${avisoNaCampanha}
            </div>
        </label>
    `;
}