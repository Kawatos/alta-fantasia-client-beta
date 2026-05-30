// ==========================================
// ARQUIVO: assets/js/editor/templates.js
// ==========================================

// --- CARD PRINCIPAL NA LISTA DE FICHAS ---

export function cardFicha(ficha) {
    const nomeExibicao = ficha.nome_personagem 
        ? (ficha.nome_personagem.length > 20 ? ficha.nome_personagem.slice(0, 20) + '…' : ficha.nome_personagem) 
        : 'Sem nome';

    const imagem = ficha.personagem_imagem || 'uploads/perfil-vazio.png';
    const imagemEstilo = ficha.personagem_imagem ? '' : 'opacity: 0.5;';
    const tipoFicha = ficha.tipo_ficha || 'padrao';

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

    return `
        <div class="mb-3" style="width: 400px;">
            <div class="card h-100 d-flex flex-row align-items-center cardPersonagem p-2" data-id="${ficha.id}" data-tipo="${tipoFicha}" style="min-height: 120px; cursor:pointer;">
                <img src="${imagem}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 12px; ${imagemEstilo}">
                
                <div class="flex-grow-1 mx-3 d-flex flex-column justify-content-center align-items-start">
                    <span class="badge ${badgeEstilo} mb-1">${badgeTexto}</span>
                    <h5 class="card-title mb-1">${nomeExibicao}</h5>
                    
                    <div class="d-flex gap-2 flex-wrap mt-2">
                        <button class="btn btn-secondary btn-sm btn-editar" data-id="${ficha.id}" data-tipo="${tipoFicha}">Editar</button>
                        

                        <button class="btn btn-sm btn-info fw-bold duplicar-ficha" data-id="${ficha.id} title="Duplicar Ficha">
                            <i class="bi bi-files me-1"></i><span class="d-none d-md-inline">Duplicar</span>
                        </button>
                        <button class="btn btn-danger btn-sm excluir-ficha" data-id="${ficha.id}"><i class="fas fa-trash-alt me-1"></i>Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// --- RENDERS DE SUB-LISTAS DENTRO DA FICHA ---

export function renderizarHabilidades(resposta, fichaId) {
    const container = document.querySelector('#habilidadesContainer');
    if (!container) return;
    
    container.innerHTML = '';

    if (resposta.status === 'sucesso' && resposta.habilidades.length > 0) {
        resposta.habilidades.slice().reverse().forEach((hab) => {
            container.insertAdjacentHTML('beforeend', `
                <div class="card mb-2">
                    <div class="card-header" role="button" data-bs-toggle="collapse" data-bs-target="#habilidade${hab.id_habilidade}">
                        <strong>${hab.nome}</strong>
                    </div>
                    <div class="collapse" id="habilidade${hab.id_habilidade}">
                        <div class="card-body p-3">
                            <div class="mb-3">
                                <label class="form-label">Nome:</label>
                                <input type="text" class="form-control" value="${hab.nome}" data-id="${hab.id_habilidade}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Requisitos:</label>
                                <input type="text" class="form-control" value="${hab.requisitos}" data-id="${hab.id_habilidade}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descrição:</label>
                                <textarea class="form-control" rows="5" data-id="${hab.id_habilidade}">${hab.descricao}</textarea>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary btn-sm me-2 salvar-habilidade" data-id="${hab.id_habilidade}">Salvar</button>
                                <button class="btn btn-danger btn-sm excluir-habilidade" data-id="${hab.id_habilidade}">Excluir</button>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        });
    } else {
        container.innerHTML = '<div class="text-muted p-2">Nenhuma habilidade encontrada.</div>';
    }
}


export function renderizarMagias(resposta, fichaId) {
    const containerArcana = document.querySelector('#magias-arcanas');
    const containerDivina = document.querySelector('#magias-divinas');
    
    if (!containerArcana || !containerDivina) return;

    containerArcana.innerHTML = '';
    containerDivina.innerHTML = '';

    if (resposta.status === 'sucesso' && resposta.magias.length > 0) {
        resposta.magias.slice().reverse().forEach(magia => {
            const isArcana = magia.tipo_magia === 'arcana';
            const html = `
                <div class="card mb-2">
                    <div class="card-header" role="button" data-bs-toggle="collapse" data-bs-target="#magia${magia.id_magias}">
                        <strong>${magia.nome_magia}</strong> - Nível ${magia.nivel} - Custo ${magia.custo_pm} PM
                    </div>
                    <div class="collapse" id="magia${magia.id_magias}">
                        <div class="card-body p-3">
                            <div class="row g-3">
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Nome:</label>
                                    <input type="text" class="form-control nome-magia" value="${magia.nome_magia}" data-id="${magia.id_magias}">
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Tipo:</label>
                                    <select class="form-select tipo-magia" data-id="${magia.id_magias}">
                                        <option value="arcana" ${isArcana ? 'selected' : ''}>Arcana</option>
                                        <option value="divina" ${!isArcana ? 'selected' : ''}>Divina</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Nível:</label>
                                    <input type="number" class="form-control nivel-magia" value="${magia.nivel}" data-id="${magia.id_magias}">
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Custo (PM):</label>
                                    <input type="number" class="form-control custo-magia" value="${magia.custo_pm}" data-id="${magia.id_magias}">
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Alcance:</label>
                                    <input type="text" class="form-control alcance-magia" value="${magia.alcance}" data-id="${magia.id_magias}">
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Duração:</label>
                                    <input type="text" class="form-control duracao-magia" value="${magia.duracao}" data-id="${magia.id_magias}">
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Descritor:</label>
                                    <input type="text" class="form-control descritor-magia" value="${magia.descritor}" data-id="${magia.id_magias}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Descrição:</label>
                                    <textarea class="form-control descricao-magia" rows="5" data-id="${magia.id_magias}">${magia.descricao}</textarea>
                                </div>
                                <div class="col-12 text-end mt-3">
                                    <button class="btn btn-primary btn-sm me-2 salvar-magia" data-id="${magia.id_magias}">Salvar</button>
                                    <button class="btn btn-danger btn-sm excluir-magia" data-id="${magia.id_magias}">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            if (isArcana) containerArcana.insertAdjacentHTML('beforeend', html);
            else containerDivina.insertAdjacentHTML('beforeend', html);
        });
    } else {
        containerArcana.innerHTML = '<div class="text-muted p-2">Nenhuma magia arcana encontrada.</div>';
        containerDivina.innerHTML = '<div class="text-muted p-2">Nenhuma magia divina encontrada.</div>';
    }
}


export function renderizarItens(resposta, fichaId) {
    const container = document.querySelector('#itensContainer');
    if (!container) return;
    
    container.innerHTML = '';

    if (resposta.status === 'sucesso' && resposta.itens.length > 0) {
        resposta.itens.slice().reverse().forEach((item) => {
            const isEquipado = item.equipado === 'sim';
            const isInterno = item.inventario_interno === 'sim';

            container.insertAdjacentHTML('beforeend', `
                <div class="card mb-2">
                    <div class="card-header" role="button" data-bs-toggle="collapse" data-bs-target="#item${item.id_item}">
                        <strong>${item.nome}</strong> - Equipado: ${isEquipado ? 'Sim' : 'Não'} - Interno: ${isInterno ? 'Sim' : 'Não'} - Peso: ${item.peso} kg
                    </div>
                    <div class="collapse" id="item${item.id_item}">
                        <div class="card-body p-3">
                            <div class="row g-3 item-details">
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Nome:</label>
                                    <input type="text" class="form-control item-nome" value="${item.nome}" data-id="${item.id_item}">
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Rank:</label>
                                    <input type="number" class="form-control item-rank" value="${item.rank}" data-id="${item.id_item}">
                                </div>
                                <div class="col-4 col-md-4">
                                    <label class="form-label">Quantidade:</label>
                                    <input type="number" class="form-control item-quantidade" value="${item.quantidade}" data-id="${item.id_item}">
                                </div>
                                <div class="col-4 col-md-4">
                                    <label class="form-label">Peso (kg):</label>
                                    <input type="number" class="form-control item-peso" value="${item.peso}" data-id="${item.id_item}">
                                </div>
                                <div class="col-4 col-md-4">
                                    <label class="form-label">Conjunto:</label>
                                    <select class="form-control item-conjunto" data-id="${item.id_item}">
                                        <option value="sim" ${item.conjunto === 'sim' ? 'selected' : ''}>Sim</option>
                                        <option value="nao" ${item.conjunto === 'nao' ? 'selected' : ''}>Não</option>
                                    </select>
                                </div>
                                <div class="col-4 col-md-4">
                                    <label class="form-label">Ignorar Peso:</label>
                                    <select class="form-control item-ignorar-peso" data-id="${item.id_item}">
                                        <option value="sim" ${item.ignorar_peso === 'sim' ? 'selected' : ''}>Sim</option>
                                        <option value="nao" ${item.ignorar_peso === 'nao' ? 'selected' : ''}>Não</option>
                                    </select>
                                </div>
                                <div class="col-4 col-md-4">
                                    <label class="form-label">Volume:</label>
                                    <select class="form-control item-volume" data-id="${item.id_item}">
                                        <option value="minimo" ${item.volume === 'minimo' ? 'selected' : ''}>Mínimo</option>
                                        <option value="pequeno" ${item.volume === 'pequeno' ? 'selected' : ''}>Pequeno</option>
                                        <option value="medio" ${item.volume === 'medio' ? 'selected' : ''}>Médio</option>
                                        <option value="grande" ${item.volume === 'grande' ? 'selected' : ''}>Grande</option>
                                    </select>
                                </div>
                                <div class="col-4 col-md-4">
                                    <label class="form-label">Equipado:</label>
                                    <select class="form-control item-equipado" data-id="${item.id_item}">
                                        <option value="sim" ${item.equipado === 'sim' ? 'selected' : ''}>Sim</option>
                                        <option value="nao" ${item.equipado === 'nao' ? 'selected' : ''}>Não</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Interno:</label>
                                    <select class="form-control item-inventario_interno" data-id="${item.id_item}">
                                        <option value="sim" ${item.inventario_interno === 'sim' ? 'selected' : ''}>Sim</option>
                                        <option value="nao" ${item.inventario_interno === 'nao' ? 'selected' : ''}>Não</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label">Estado:</label>
                                    <select class="form-control item-estado" data-id="${item.id_item}">
                                        <option value="intacto" ${item.estado === 'intacto' ? 'selected' : ''}>Intacto</option>
                                        <option value="danificado" ${item.estado === 'danificado' ? 'selected' : ''}>Danificado</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Descrição:</label>
                                    <textarea class="form-control item-descricao" rows="5" data-id="${item.id_item}">${item.descricao}</textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button class="btn btn-primary btn-sm me-2 salvar-item" data-id="${item.id_item}">Salvar</button>
                                    <button class="btn btn-danger btn-sm excluir-item" data-id="${item.id_item}">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        });
    } else {
        container.innerHTML = '<div class="text-muted p-2">Nenhum item encontrado.</div>';
    }
}


// --- LÓGICA EXCLUSIVA DE TEMPLATE DAS CLASSES ---
