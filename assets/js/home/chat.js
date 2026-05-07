// ==========================================
// ARQUIVO: assets/js/home/chat.js
// ==========================================

import * as API from './api.js';
import * as TPL from './templates.js';

let estadoChat = {
    campanhaAtual: null,
    intervalo: null,
    ultimoIdMensagem: 0,   // <--- NOVA VARIÁVEL: Guarda o ID da última mensagem lida
    totalMensagensLocal: 0,
    isPrimeiroCarregamento: true, // <--- Flag para saber se limpa a tela ou adiciona
    taxaAtualizacao: 1000, 
    ticksSemMensagem: 0,   
    usuarioLogado: document.body.dataset.userId,
    papelCampanha: null
};

// -- INICIALIZAÇÃO E CONTROLE --

export function iniciar(campanhaId, papel) {
    parar(); 
    estadoChat.campanhaAtual = campanhaId;
    estadoChat.papelCampanha = papel;
    estadoChat.ultimoIdMensagem = 0; // Reseta o ID ao entrar na campanha
    estadoChat.totalMensagensLocal = 0;
    estadoChat.isPrimeiroCarregamento = true; 
    estadoChat.taxaAtualizacao = 1000;
    estadoChat.ticksSemMensagem = 0;

    $(document).off('submit', '#formChat').on('submit', '#formChat', function(e) {
        e.preventDefault();
        processarEnvio();
    });

    $(document).off('click', '.btn-lixeira').on('click', '.btn-lixeira', function() {
        excluirMensagem($(this).data('id'), this);
    });

    loopBuscarMensagens();
}

export function parar() {
    if (estadoChat.intervalo) {
        clearTimeout(estadoChat.intervalo);
        estadoChat.intervalo = null;
    }
    estadoChat.campanhaAtual = null;
}


// -- SMART POLLING E RENDERIZAÇÃO INCREMENTAL --

function loopBuscarMensagens() {
    if (!estadoChat.campanhaAtual) return;

    API.listarMensagens(estadoChat.campanhaAtual, estadoChat.ultimoIdMensagem).done(function(res) {
        if (res.status !== 'sucesso') return agendarProximaBusca();

        // 1. A MÁGICA DA SINCRONIZAÇÃO DE EXCLUSÃO
        if (res.total_mensagens < estadoChat.totalMensagensLocal) {
            // O servidor tem menos mensagens que nós. Alguém apagou algo!
            // Vamos resetar nossa memória e pedir o chat inteiro de novo na mesma hora.
            estadoChat.ultimoIdMensagem = 0;
            estadoChat.isPrimeiroCarregamento = true;
            estadoChat.totalMensagensLocal = 0;
            
            clearTimeout(estadoChat.intervalo);
            loopBuscarMensagens(); 
            return; 
        }

        // 2. LÓGICA NORMAL DE MENSAGENS NOVAS
        if (res.mensagens.length > 0) {
            estadoChat.ultimoIdMensagem = res.mensagens[res.mensagens.length - 1].id;
            estadoChat.totalMensagensLocal = res.total_mensagens; // Atualiza nosso total
            
            estadoChat.ticksSemMensagem = 0; 
            estadoChat.taxaAtualizacao = 1000; 
            
            renderizar(res.mensagens);
            estadoChat.isPrimeiroCarregamento = false;
        } else {
            estadoChat.totalMensagensLocal = res.total_mensagens;
            estadoChat.ticksSemMensagem++;
            if (estadoChat.ticksSemMensagem > 10) {
                estadoChat.taxaAtualizacao = 3000; 
            }
        }

        agendarProximaBusca();
    }).fail(() => agendarProximaBusca());
}

function agendarProximaBusca() {
    estadoChat.intervalo = setTimeout(loopBuscarMensagens, estadoChat.taxaAtualizacao);
}

function renderizar(mensagens) {
    const html = mensagens.map(m => {
        const dataFormatada = formatarDataChat(m.data_envio);
        return TPL.templateMensagem(m, dataFormatada, estadoChat.usuarioLogado, estadoChat.papelCampanha);
    }).join('');

    const chatBox = $('#chatMensagens');
    if(chatBox.length === 0) return; 

    const isScrolledToBottom = chatBox[0].scrollHeight - chatBox[0].clientHeight <= chatBox[0].scrollTop + 50;

    // A MÁGICA ESTÁ AQUI: 
    // Se for a primeira vez que abriu a campanha, ele injeta o HTML inteiro (.html)
    // Se for mensagem chegando em tempo real, ele só adiciona embaixo (.append)
    if (estadoChat.isPrimeiroCarregamento) {
        chatBox.html(html);
    } else {
        chatBox.append(html);
    }

    // Se o usuário estava lá embaixo, rola a tela para mostrar a mensagem nova
    if (isScrolledToBottom || estadoChat.isPrimeiroCarregamento) {
        chatBox.scrollTop(chatBox[0].scrollHeight);
    }
}


// -- ENVIO E ROLAGEM DE DADOS --

function processarEnvio() {
    const input = $('#chatInput');
    let msg = input.val().trim();
    if (!msg) return;

    if (msg.toLowerCase().startsWith('/r ')) {
        msg = rolarDados(msg.substring(3).trim());
    }

    API.enviarMensagem(msg, estadoChat.campanhaAtual).done(function() {
        // Acelera o chat para pegar a mensagem que você mesmo enviou instantaneamente
        estadoChat.taxaAtualizacao = 1000; 
        estadoChat.ticksSemMensagem = 0;
        // Repare que NÃO zeramos o ultimoIdMensagem. Ele vai baixar só essa mensagem que você mandou!
    });
    
    input.val('');
}

function excluirMensagem(mensagemId, btnElement) {
    if (!confirm('Deseja realmente excluir esta mensagem?')) return;

    API.excluirMensagem(mensagemId, estadoChat.campanhaAtual).done(function(res) {
        if (res.status === 'sucesso') {
            // Em vez de baixar o chat inteiro de novo para ver a mensagem sumir, 
            // nós removemos ela diretamente da tela (da DOM)!
            $(btnElement).closest('.w-100').fadeOut(300, function() {
                $(this).remove();
            });
        } else {
            alert(res.mensagem || 'Erro ao excluir mensagem.');
        }
    });
}

// O ROLADOR DE DADOS
function rolarDados(formula) {
    const regex = /^(\d*)d(\d+)(?:\s*([\+\-])\s*(\d+))?$/i;
    const match = formula.match(regex);

    if (!match) return `🎲 Tentou rolar '${formula}', mas a fórmula é inválida. Use ex: /r 1d20+5`;

    const qtde = parseInt(match[1]) || 1;
    const faces = parseInt(match[2]);
    const sinal = match[3] || '+';
    const mod = parseInt(match[4]) || 0;

    if (qtde > 50 || faces > 100) return `🎲 Tentou rolar '${formula}'. O limite é 50 dados de 100 lados!`;

    let rolagens = [];
    let somaDados = 0;

    for (let i = 0; i < qtde; i++) {
        const rolagem = Math.floor(Math.random() * faces) + 1;
        rolagens.push(rolagem);
        somaDados += rolagem;
    }

    let total = somaDados;
    let textoMod = '';

    if (match[4]) {
        if (sinal === '+') total += mod;
        if (sinal === '-') total -= mod;
        textoMod = ` ${sinal} ${mod}`;
    }

    return `🎲 Rolou ${formula} ➔ [${rolagens.join(', ')}]${textoMod} = <b>${total}</b>`;
}

// -- UTILITÁRIOS --

function formatarDataChat(dataString) {
    if (!dataString) return '';
    const dataMsg = new Date(dataString.replace(/-/g, '/'));
    const dataHoje = new Date();
    const hr = String(dataMsg.getHours()).padStart(2, '0');
    const min = String(dataMsg.getMinutes()).padStart(2, '0');

    if (dataMsg.getDate() === dataHoje.getDate() && dataMsg.getMonth() === dataHoje.getMonth() && dataMsg.getFullYear() === dataHoje.getFullYear()) {
        return `${hr}:${min}`;
    } else {
        const dia = String(dataMsg.getDate()).padStart(2, '0');
        const mes = String(dataMsg.getMonth() + 1).padStart(2, '0');
        return `${dia}/${mes} ${hr}:${min}`;
    }
}