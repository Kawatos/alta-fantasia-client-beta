<?php include('header.php'); ?>



<style>
    .wiki-header {
        position: relative;
        background: url('css/imagens/rpgcampanha.jpg') center/cover no-repeat;
        padding: 1rem;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin-left: 3vw;
        margin-right: 3vw;
        margin-bottom: 2rem;
        overflow: hidden;
        /* garante que a camada respeite o border-radius */
        min-height: fit-content;
        /* altura mínima pra não ficar muito apertado */
    }

    .wiki-header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* ocupa toda a altura da .wiki-header */
        background: rgba(212, 212, 212, 0.36);
        /* branco semi-transparente */
        z-index: 1;
    }

    .wiki-header h1,
    .wiki-header .search-container {
        position: relative;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
        z-index: 2;
        /* garante que o texto fique acima do overlay */
    }



    /* Estilo do iframe */
    .wiki-frame {
        width: 100%;
        height: 80vh;
        /* ocupa 80% da altura da tela */
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .info {
        background-color: #ffffffe0;
        color: var(--cor-primaria);

        padding: 10px 15px;
        border-radius: 4px;
        font-size: 1rem;
        display: inline-block;
    }

    .tabs-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .tab-btn {
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        background: #eee;
        cursor: pointer;
        font-weight: bold;
        transition: 0.2s;
    }

    .tab-btn:hover {
        background: #ddd;
    }

    .tab-btn.active {
        background: var(--cor-primaria);
        color: white;
    }

    /* Desktop / Telas maiores */
    @media (min-width: 769px) {
        .wiki-header {
            
            min-height: 25vh;
            
        }
    }

    /* Mobile */
    @media (max-width: 768px) {
        .wiki-header {
            padding: 1.5rem 1rem;
        }

        .wiki-header h1 {
            font-size: 3rem;
        }

        .wiki-frame {
            height: 70vh;
            /* menos altura no celular */
        }
    }
</style>

<div class="wiki-header text-center">
    <h1 class="display-5 fw-bold">
        <span class="font-alta">Alta</span>
        <span class="title-dynamic font-fantasia fw-bold" id="fantasiaText">Fantasia: Campanhas Oficiais</span>
    </h1>
    <div class="search-container mt-2">
        <div class="alert info">
            Essa página lista as campanhas oficiais de Alta Fantasia. <br>
            Acompanhe as histórias épicas criadas pelos nossos jogadores e participe das aventuras!
        </div>
    </div>
</div>

<div class="tabs-container text-center my-3">

    <button class="tab-btn active" data-link="https://ordinary-marimba-72e.notion.site/ebd/2b3821efea8c80b39dd7efeeb628f671">O Grupo 1</button>
    
</div>

<div class="container-fluid">
    <iframe class="wiki-frame" id="wikiFrame"
        src="https://ordinary-marimba-72e.notion.site/ebd/2b3821efea8c80b39dd7efeeb628f671"
        width="100%" height="50vh" frameborder="0" allowfullscreen>
    </iframe>
</div>

<script>
    const buttons = document.querySelectorAll(".tab-btn");
    const iframe = document.getElementById("wikiFrame");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            // Muda link
            iframe.src = btn.dataset.link;

            // Troca aba ativa
            buttons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
        });
    });
</script>


<?php include('footer.php'); ?>