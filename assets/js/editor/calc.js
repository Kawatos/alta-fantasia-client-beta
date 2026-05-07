// ==========================================
// ARQUIVO: assets/js/editor/calc.js
// ==========================================

// --- UTILITÁRIOS GERAIS ---
export const getNivel = () => parseInt(document.getElementById("nivel-atual")?.textContent) || 1;
export const getAtributoValor = (atributo) => parseInt(document.querySelector(`.${atributo}`)?.value) || 0;

// --- NÍVEL E XP ---
export function atualizarNivelEBarra() {
    const inputXp = document.getElementById("ficha-xp");
    const spanNivel = document.getElementById("nivel-atual");
    const barraXp = document.getElementById("barra-xp");
    const spanRank = document.querySelector(".rank-personagem-span");
    const spanNivelClass = document.querySelector(".nivel-personagem-span");
    const barraProgressoTotal = document.getElementById("barra-progresso-total");
    const textoProgressoTotal = document.getElementById("progresso-total-texto");

    if (!inputXp) return;

    const xp = parseInt(inputXp.value) || 0;
    const nivel = Math.floor(xp / 100);
    const rank = Math.ceil(nivel / 10);
    const progresso = xp % 100;

    // Atualiza nível e barra do nível atual
    if (spanNivel) spanNivel.textContent = nivel;
    if (barraXp) {
        barraXp.style.width = `${progresso}%`;
        barraXp.textContent = `${progresso}%`;
    }

    // Atualiza barra de progresso total (máx 100 níveis)
    const totalMaxXp = 100 * 100; 
    const progressoTotal = Math.min(100, ((xp / totalMaxXp) * 100).toFixed(2));
    if (barraProgressoTotal) {
        barraProgressoTotal.style.width = `${progressoTotal}%`;
        barraProgressoTotal.textContent = `${progressoTotal}%`;
    }
    if (textoProgressoTotal) textoProgressoTotal.textContent = `${progressoTotal}%`;

    if (spanNivelClass) spanNivelClass.textContent = nivel;
    if (spanRank) spanRank.textContent = rank;

    // Dispara evento para quem quiser ouvir (ex: renderClasses)
    const event = new CustomEvent("nivelProgressao", { detail: { nivel, rank, xp } });
    document.dispatchEvent(event);

    getValorMaxInventarioInterno();
}


// --- ATRIBUTOS E PERÍCIAS ---
export function atualizarAtributos() {
    const atributos = ["vigor", "forca", "destreza", "espirito", "carisma", "intelecto"];
    let totalModNivel = 0;
    const nivelAtual = (parseInt(document.getElementById("nivel-atual")?.textContent) || 1) + 6;

    atributos.forEach(attr => {
        const modBase = parseInt(document.querySelector(`.${attr}_mod`)?.value) || 0;
        const modNivel = parseInt(document.querySelector(`.${attr}_mod_nv`)?.value) || 0;

        totalModNivel += modNivel;
        const total = modBase + modNivel;
        
        const inputAtributo = document.querySelector(`.${attr}`);
        const spanAtributo = document.querySelector(`.${attr}-txt`);
        const spanAtrbutoMod = document.querySelector(`.${attr}_mod-txt`);
        const spanAtrbutoModNivel = document.querySelector(`.${attr}_mod_nv-txt`);
        
        if (inputAtributo) inputAtributo.value = total;
        if (spanAtributo) spanAtributo.textContent = total;
        if (spanAtrbutoMod) spanAtrbutoMod.textContent = modBase;
        if (spanAtrbutoModNivel) spanAtrbutoModNivel.textContent = modNivel;
    });

    // Cascateia as atualizações necessárias
    calcularPericias();
    verificarLimiteDeCarga();

    // Validação de limite de pontos gastos
    const totalModNivelElement = document.getElementById("total-mod-nivel");
    if (totalModNivelElement) {
        totalModNivelElement.textContent = totalModNivel;
        const pontosPorNivelElement = document.getElementById("pontos-por-nivel");
        if (pontosPorNivelElement) pontosPorNivelElement.textContent = nivelAtual;

        const h5Container = totalModNivelElement.closest("p");
        if (h5Container) {
            h5Container.style.color = (totalModNivel > nivelAtual) ? "red" : "";
        }
    }
}

export function calcularPericias() {
    const nivel = getNivel();
    const escalaNivel = Math.ceil(nivel / 10);
    const pericias = document.querySelectorAll(".pericia");

    pericias.forEach(pericia => {
        const modBase = parseInt(pericia.querySelector(".pericia-mod")?.value) || 0;
        const valorTreinamento = parseInt(pericia.querySelector(".treinado")?.value) || 0;
        const valorProeficiencia = parseInt(pericia.querySelector(".proeficiente")?.value) || 0;
        const atributo = pericia.dataset.atributo;
        const valorAtributo = getAtributoValor(atributo);
        
        const bonusTreinamento = valorTreinamento > 0 ? (2 * escalaNivel) + valorTreinamento : 0;
        const bonusProeficiencia = 2 * valorProeficiencia;

        const resultado = modBase + bonusTreinamento + bonusProeficiencia + valorAtributo;

        const elModBase = pericia.querySelector(".modbase-valor");
        const elTreinado = pericia.querySelector(".treinado-valor");
        const elProeficiente = pericia.querySelector(".proeficiente-valor");
        const elAtributoInput = pericia.querySelector(".atributo-valor");
        const elAtributoTxt = pericia.querySelector(".atributotxt-valor");
        const elFinal = pericia.querySelector(".pericia-final");

        if(elModBase) elModBase.textContent = modBase;
        if(elTreinado) elTreinado.textContent = bonusTreinamento;
        if(elProeficiente) elProeficiente.textContent = bonusProeficiencia;
        if(elAtributoInput) elAtributoInput.value = valorAtributo;
        if(elAtributoTxt) elAtributoTxt.textContent = valorAtributo;
        if(elFinal) elFinal.textContent = resultado;
    });
}


// --- INVENTÁRIO E CARGA ---
export function atualizarPesoTotal() {
    let totalPeso = 0;
    let itensInventarioInterno = 0;

    document.querySelectorAll('.item-details').forEach(details => {
        const inputPeso = details.querySelector('.item-peso');
        const inputQuantidade = details.querySelector('.item-quantidade');
        const selectInventarioInterno = details.querySelector('.item-inventario_interno');
        const selectConjunto = details.querySelector('.item-conjunto');
        const selectIgnorarPeso = details.querySelector('.item-ignorar-peso');
        const selectEquipado = details.querySelector('.item-equipado');

        const peso = (parseFloat(inputPeso?.value || 0) * (parseFloat(inputQuantidade?.value || 0))) || 0;
        const inventarioInterno = selectInventarioInterno?.value || "nao";
        const itemConjunto = selectConjunto?.value || "nao";
        const itemIgnorarPeso = selectIgnorarPeso?.value || "nao";
        const equipado = selectEquipado?.value || "nao";

        // Lógica de Peso
        if (inventarioInterno !== 'sim' && itemIgnorarPeso !== 'sim') {
            totalPeso += (equipado === 'sim') ? (peso * 0.5) : peso;
        }

        // Lógica de Volume Interno
        if (inventarioInterno === 'sim') {
            itensInventarioInterno += (itemConjunto === 'sim') ? 1 : (parseInt(inputQuantidade?.value) || 0);
        }
    });

    const spanInternoAtual = document.getElementById('inventario-interno-atual-span');
    const spanPesoTotal = document.getElementById('peso-total-carregado');
    
    if (spanInternoAtual) spanInternoAtual.textContent = itensInventarioInterno;
    if (spanPesoTotal) spanPesoTotal.textContent = totalPeso.toFixed(2);
    
    verificarLimiteDeCarga();
}

export function getValorMaxInventarioInterno() {
    const nivel = getNivel();
    const modInterno = parseInt(document.getElementById('ficha-inventario_interno_mod')?.value) || 0;
    const totalEspaco = ((Math.floor(nivel / 10) * 10) + modInterno) + 10;
    
    const spanTotal = document.getElementById('inventario-interno-total-span');
    if (spanTotal) spanTotal.textContent = totalEspaco;
}

export function verificarLimiteDeCarga() {
    const pesoAtual = parseFloat(document.getElementById('peso-total-carregado')?.textContent) || 0;
    const itensInternosAtual = parseInt(document.getElementById('inventario-interno-atual-span')?.textContent) || 0;
    const itensInternosMax = parseInt(document.getElementById('inventario-interno-total-span')?.textContent) || 0;
    
    const inputForca = document.querySelector('.forca');
    const inputCargaMod = document.getElementById('ficha-carga_suportada_mod');
    
    const forca = parseInt(inputForca?.value) || 0;
    const cargaMod = parseFloat(inputCargaMod?.value) || 0;

    const limite = (forca * 3) + cargaMod + 15;
    
    const pesoMaximoSpan = document.getElementById('peso-maximo-carregavel');
    if (pesoMaximoSpan) pesoMaximoSpan.textContent = limite.toFixed(2);

    const itensTotaisH5 = document.getElementById('itens-totais-h5');
    if (itensTotaisH5) {
        itensTotaisH5.style.color = (itensInternosAtual > itensInternosMax) ? 'red' : '';
    }

    const pesoTotalH5 = document.getElementById('peso-total-h5');
    if (pesoTotalH5) {
        pesoTotalH5.style.color = (pesoAtual > limite) ? 'red' : '';
    }
}


// --- BARRAS DE VIDA E MANA ---

export function interpolarMultiplasCores(percentual, coresHex) {
    const hexToRgb = hex => {
        const bigint = parseInt(hex.replace("#", ""), 16);
        return { r: (bigint >> 16) & 255, g: (bigint >> 8) & 255, b: bigint & 255 };
    };
    const lerp = (a, b, t) => Math.round(a + (b - a) * t);

    const total = coresHex.length - 1;
    const intervalo = 1 / total;
    let index = Math.floor(percentual / intervalo);

    if (index >= total) index = total - 1;

    const localT = (percentual - (index * intervalo)) / intervalo;
    const c1 = hexToRgb(coresHex[index]);
    const c2 = hexToRgb(coresHex[index + 1]);

    const r = lerp(c1.r, c2.r, localT);
    const g = lerp(c1.g, c2.g, localT);
    const b = lerp(c1.b, c2.b, localT);

    return `rgb(${r}, ${g}, ${b})`;
}

export function atualizarBarraDeStatus({ inputMaxId, inputAtualId, barraId, spanId, bgBarraId, tipo = "vida", exibirAlerta = false }) {
    const inputMax = document.getElementById(inputMaxId);
    const inputAtual = document.getElementById(inputAtualId);
    const barra = document.getElementById(barraId);
    const span = document.getElementById(spanId);
    const bgBarra = document.getElementById(bgBarraId);

    if (!barra || !span) return;

    const max = parseInt(inputMax?.value) || 1;
    const atual = parseInt(inputAtual?.value) || 0;

    const percentual = Math.round((atual / max) * 100);
    const novoPercentual = Math.max(0, percentual); 
    
    barra.style.width = `${novoPercentual}%`;
    span.textContent = `${percentual}%`;

    // Reset de estilos
    barra.classList.remove('bg-success', 'bg-warning', 'bg-danger', 'bg-dark');
    barra.style.backgroundColor = '';
    if (bgBarra) {
        bgBarra.classList.remove('bg-dark');
        bgBarra.style.backgroundColor = '';
    }

    if (tipo === "mana") {
        if (atual > max) {
            barra.style.backgroundColor = '#b8860b'; // Dourado
        } else if (atual > 0) {
            barra.style.backgroundColor = interpolarMultiplasCores((100 - percentual) / 100, ['#4b0082', '#00e0ff']);
            span.style.color = '';
        } else {
            span.style.color = 'red';
        }
    } else {
        if (atual <= 0) {
            barra.classList.add('bg-dark');
            span.style.color = 'red';
        } else if (atual > max) {
            barra.style.backgroundColor = '#b8860b';
            span.style.color = '';
        } else {
            barra.style.backgroundColor = interpolarMultiplasCores((100 - percentual) / 100, ['#006400', '#8b8000', '#8b0000', '#000000']);
            span.style.color = '';
        }
    }
}

export function atualizarBarraDeVida(exibirAlerta = true) {
    if (exibirAlerta === 'false') exibirAlerta = false;
    atualizarBarraDeStatus({
        inputMaxId: "ficha-pontos_de_vida",
        inputAtualId: "ficha-pvs_atuais",
        barraId: "barra-pv",
        spanId: "barra-vida-span",
        bgBarraId: "barra-vida",
        tipo: "vida",
        exibirAlerta: exibirAlerta
    });
}

export function atualizarBarraDeMana() {
    atualizarBarraDeStatus({
        inputMaxId: "ficha-pontos_de_mana",
        inputAtualId: "ficha-pms_atuais",
        barraId: "barra-pm",
        spanId: "barra-mana-span",
        bgBarraId: "barra-mana",
        tipo: "mana",
        exibirAlerta: false
    });
}

// Funções Auxiliares de Atalho (Dano/Cura)
export function aplicarAjusteStatus(inputId, ajusteId, operacao) {
    const inputAtual = document.getElementById(inputId);
    const inputAjuste = document.getElementById(ajusteId);
    
    if(!inputAtual || !inputAjuste) return;

    let atual = parseInt(inputAtual.value) || 0;
    const valor = parseInt(inputAjuste.value) || 0;

    atual = (operacao === '+') ? (atual + valor) : (atual - valor);
    inputAtual.value = atual;
    
    // Dispara manualmente o evento de input para a barra ser atualizada
    inputAtual.dispatchEvent(new Event('input', { bubbles: true }));
}