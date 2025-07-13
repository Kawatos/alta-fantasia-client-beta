<?php include('header.php'); ?>
<style>
.wiki-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 2rem 0;
}

.search-container {
  max-width: 600px;
  margin: 0 auto;
}

.content-section {
  display: none;
}

.content-section.active {
  display: block;
}

.nav-tabs .nav-link {
  color: #495057;
  border: none;
  border-bottom: 3px solid transparent;
  padding: 0.75rem 1rem;
  font-weight: 500;
}

.nav-tabs .nav-link.active {
  background: none;
  border-bottom: 3px solid #667eea;
  color: #667eea;
  font-weight: bold;
}

.race-card,
.class-card {
  transition: transform 0.2s;
  border: 1px solid #dee2e6;
  margin-bottom: 1rem;
}

.race-card:hover,
.class-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.highlight {
  background-color: yellow;
  padding: 1px 2px;
}

.table-responsive {
  border-radius: 8px;
  overflow: hidden;
  margin: 1.5rem 0;
}

.badge-custom {
  font-size: 0.8em;
  padding: 0.4em 0.8em;
}

.timeline-item {
  border-left: 3px solid #667eea;
  padding-left: 1rem;
  margin-bottom: 1rem;
}

.magic-spell {
  background: #f8f9fa;
  border-left: 4px solid #667eea;
  padding: 1rem;
  margin-bottom: 1rem;
}

/* Melhorias de Tipografia e Layout */
.main-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #2c3e50;
  margin-bottom: 2rem;
  text-align: center;
  border-bottom: 3px solid #667eea;
  padding-bottom: 1rem;
}

.section-title {
  font-size: 2rem;
  font-weight: 600;
  color: #667eea;
  margin: 3rem 0 1.5rem 0;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #e9ecef;
  position: relative;
}

.section-title::before {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 60px;
  height: 2px;
  background: #667eea;
}

.subsection-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #495057;
  margin: 2rem 0 1rem 0;
  padding-left: 1rem;
  border-left: 4px solid #667eea;
  background: #f8f9fa;
  padding: 0.75rem 1rem;
  border-radius: 0 8px 8px 0;
}

.sub-subsection-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #6c757d;
  margin: 1.5rem 0 0.75rem 0;
  padding-bottom: 0.25rem;
  border-bottom: 1px solid #dee2e6;
}

.content-card {
  background: white;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
  margin-bottom: 2rem;
  overflow: hidden;
}

.content-card-body {
  padding: 2rem;
}

.text-content {
  line-height: 1.7;
  font-size: 1rem;
  color: #495057;
  margin-bottom: 1.5rem;
}

.text-content p {
  margin-bottom: 1rem;
}

.text-content ul, .text-content ol {
  margin: 1rem 0;
  padding-left: 2rem;
}

.text-content li {
  margin-bottom: 0.5rem;
  line-height: 1.6;
}

.highlight-box {
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  border-left: 4px solid #667eea;
  padding: 1.5rem;
  margin: 1.5rem 0;
  border-radius: 0 8px 8px 0;
}

.info-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1.5rem;
  margin: 2rem 0;
}

.info-item {
  background: #f8f9fa;
  padding: 1.5rem;
  border-radius: 8px;
  border: 1px solid #e9ecef;
}

.info-item h6 {
  color: #667eea;
  font-weight: 600;
  margin-bottom: 0.75rem;
  font-size: 1.1rem;
}

.table-container {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
  margin: 2rem 0;
}

.table-title {
  background: #667eea;
  color: white;
  padding: 1rem 1.5rem;
  font-weight: 600;
  font-size: 1.1rem;
  margin: 0;
}

.custom-table {
  margin: 0;
  font-size: 0.95rem;
}

.custom-table th {
  background: #f8f9fa;
  font-weight: 600;
  color: #495057;
  border-top: none;
  padding: 1rem 0.75rem;
}

.custom-table td {
  padding: 0.75rem;
  vertical-align: middle;
}

.image-container {
  text-align: center;
  margin: 2rem 0;
  padding: 1rem;
  background: #f8f9fa;
  border-radius: 8px;
}

.image-container img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Responsividade Mobile */
@media (max-width: 768px) {
  .container-fluid {
    padding: 0 1rem;
  }
  
  .main-title {
    font-size: 2rem;
    margin-bottom: 1.5rem;
  }
  
  .section-title {
    font-size: 1.5rem;
    margin: 2rem 0 1rem 0;
  }
  
  .subsection-title {
    font-size: 1.25rem;
    padding: 0.5rem 0.75rem;
  }
  
  .content-card-body {
    padding: 1.5rem;
  }
  
  .nav-tabs {
    flex-wrap: wrap;
  }
  
  .nav-tabs .nav-link {
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
  }
  
  .info-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  
  .info-item {
    padding: 1rem;
  }
  
  .table-responsive {
    font-size: 0.85rem;
  }
  
  .custom-table th,
  .custom-table td {
    padding: 0.5rem 0.25rem;
  }
  
  .example-section {
    padding: 1rem;
  }
  
  .highlight-box {
    padding: 1rem;
  }
  
  .text-content {
    font-size: 0.95rem;
  }
  
  .text-content ul, .text-content ol {
    padding-left: 1.5rem;
  }
}

@media (max-width: 576px) {
  .main-title {
    font-size: 1.75rem;
  }
  
  .section-title {
    font-size: 1.25rem;
  }
  
  .subsection-title {
    font-size: 1.1rem;
  }
  
  .content-card-body {
    padding: 1rem;
  }
  
  .nav-tabs .nav-link {
    padding: 0.5rem;
    font-size: 0.85rem;
  }
  
  .table-title {
    padding: 0.75rem 1rem;
    font-size: 1rem;
  }
  
  .custom-table {
    font-size: 0.8rem;
  }
  
  .text-content {
    font-size: 0.9rem;
  }
}

/* Melhorias de Acessibilidade */
.nav-tabs .nav-link:focus,
.nav-tabs .nav-link:hover {
  border-bottom-color: #667eea;
  color: #667eea;
}

.content-card:focus-within {
  box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
}

/* Animações suaves */
.content-section {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="wiki-header">
  <div class="container">
    <h1 class="text-center mb-4">
      <i class="fas fa-book-open me-2"></i>
      Wiki - Alta Fantasia Online
    </h1>
    <div class="search-container">
      <div class="input-group">
        <input type="text" id="searchInput" class="form-control form-control-lg"
          placeholder="Pesquisar regras, raças, classes, magias...">
        <button class="btn btn-light" type="button" onclick="clearSearch()">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-12">
      <!-- Navigation Tabs -->
      <ul class="nav nav-tabs justify-content-center mb-4" id="mainTabs">
        <li class="nav-item">
          <a class="nav-link active" href="#" onclick="showSection('sistema')">
            <i class="fas fa-cogs me-1"></i>Sistema
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="showSection('racas')">
            <i class="fas fa-users me-1"></i>Raças
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="showSection('classes')">
            <i class="fas fa-sword me-1"></i>Classes
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="showSection('magia')">
            <i class="fas fa-magic me-1"></i>Magia
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="showSection('cronologia')">
            <i class="fas fa-history me-1"></i>Cronologia
          </a>
        </li>
      </ul>

      <!-- Sistema Section -->
<div id="sistema" class="content-section active">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h2 class="main-title">
          <i class="fas fa-cogs me-3"></i>Sistema de Alta Fantasia Online
        </h2>
        
        <!-- Sistema de Níveis -->
        <div class="content-card">
          <div class="content-card-body">
            <h3 class="section-title">Sistema de Níveis</h3>
            
            <div class="text-content">
              <p>Em Alta Fantasia, a progressão dos personagens é feita por <strong>Níveis</strong>, que determinam o poder, habilidade e capacidades gerais dos heróis. E, também em Alta Fantasia Online:</p>
            </div>
            
            <div class="highlight-box">
              <ul class="mb-0">
                <li>O Nível inicial é <strong>1</strong>, e o final é <strong>100</strong></li>
                <li>Ranks são definidos a cada <strong>10 níveis</strong>, existem <strong>10 Ranks</strong></li>
                <li>Ranks são medidas de poder</li>
                <li>O seu nível define inicialmente os dados que você rolará</li>
                <li>Sendo seu nível também quem define inicialmente os pontos que você terá nos seus Atributos</li>
                <li>Já os Atributos servirão como base para as Perícias</li>
                <li>Perícias e Atributos podem receber adições e subtrações externas, momentâneas ou permanentes</li>
                <li>Todos os testes que os heróis e os vilões realizam são testes de perícia</li>
              </ul>
            </div>
            
            <div class="text-content">
              <p>A cada intervalo de 10 níveis ou se preferir, a cada novo Rank, os personagens recebem um Bônus de Perícia crescente, representado por dados (d10), e os atributos associados ao nível evoluem em paralelo.</p>
            </div>
            
            <div class="table-container">
              <h4 class="table-title">Bônus de Perícia por Nível - Sistema de Ranks Beta 2</h4>
              <div class="table-responsive">
                <table class="table custom-table table-striped mb-0">
                  <thead>
                    <tr>
                      <th>Nível (N) / Rank (R)</th>
                      <th>Bônus Base do Dado</th>
                      <th>Bônus Atributo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><td>1 - 10 = Rank 1</td><td>1d10</td><td>1 a 10</td></tr>
                    <tr><td>11 - 20 = Rank 2</td><td>2d10</td><td>11 a 20</td></tr>
                    <tr><td>21 - 30 = Rank 3</td><td>3d10</td><td>21 a 30</td></tr>
                    <tr><td>31 - 40 = Rank 4</td><td>4d10</td><td>31 a 40</td></tr>
                    <tr><td>41 - 50 = Rank 5</td><td>5d10</td><td>41 a 50</td></tr>
                    <tr><td>51 - 60 = Rank 6</td><td>6d10</td><td>51 a 60</td></tr>
                    <tr><td>61 - 70 = Rank 7</td><td>7d10</td><td>61 a 70</td></tr>
                    <tr><td>71 - 80 = Rank 8</td><td>8d10</td><td>71 a 80</td></tr>
                    <tr><td>81 - 90 = Rank 9</td><td>9d10</td><td>81 a 90</td></tr>
                    <tr><td>91 - 100 = Rank 10</td><td>10d10</td><td>91 a 100</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Atributos -->
        <div class="content-card">
          <div class="content-card-body">
            <h3 class="section-title">Atributos</h3>
            
            <div class="text-content">
              <p>Os atributos são divididos em dois grupos principais:</p>
            </div>
            
            <div class="info-grid">
              <div class="info-item">
                <h4 class="subsection-title text-danger mb-3">Corporais</h4>
                <div class="info-item">
                  <h6><i class="fas fa-heart me-2 text-danger"></i>Vigor</h6>
                  <p class="mb-3">Resistência física, saúde e energia vital</p>
                </div>
                <div class="info-item">
                  <h6><i class="fas fa-running me-2 text-danger"></i>Destreza</h6>
                  <p class="mb-3">Agilidade, reflexos e precisão</p>
                </div>
                <div class="info-item">
                  <h6><i class="fas fa-dumbbell me-2 text-danger"></i>Força</h6>
                  <p class="mb-0">Capacidade de levantar, arremessar e causar dano físico</p>
                </div>
              </div>
              
              <div class="info-item">
                <h4 class="subsection-title text-info mb-3">Mentais</h4>
                <div class="info-item">
                  <h6><i class="fas fa-brain me-2 text-info"></i>Espírito</h6>
                  <p class="mb-3">Autocontrole, resiliência emocional, e presença</p>
                </div>
                <div class="info-item">
                  <h6><i class="fas fa-lightbulb me-2 text-info"></i>Intelecto</h6>
                  <p class="mb-3">Inteligência, lógica e conhecimento</p>
                </div>
                <div class="info-item">
                  <h6><i class="fas fa-comments me-2 text-info"></i>Carisma</h6>
                  <p class="mb-0">Desempenho social, persuasão e estética</p>
                </div>
              </div>
            </div>
            
            <div class="highlight-box">
              <p class="mb-0">A evolução dos atributos acompanha os níveis do personagem. Por exemplo, um personagem de nível 12 poderá ter um atributo na faixa de 11 a 20, conforme a tabela. E não, não existem limites máximos aplicáveis em um único atributo.</p>
            </div>
          </div>
        </div>

        <!-- Perícias -->
        <div class="content-card">
          <div class="content-card-body">
  <h3 class="section-title">Perícias</h3>
  
  <div class="highlight-box">
    <p class="mb-0">Por padrão, todos os personagens ganham <strong>1 perícia</strong> de qualquer tipo, tanto corporal quanto mental, a cada <strong>20 níveis</strong>, o que se soma com as definidas por suas classes.</p>
  </div>
  
  <!-- Perícias Corporais -->
  <div class="content-card">
    <div class="content-card-body">
      <h4 class="subsection-title text-danger">Perícias Corporais</h4>
      
      <!-- Baseadas em Vigor -->
      <div class="content-card">
        <div class="content-card-body">
          <h5 class="sub-subsection-title">Baseadas em Vigor</h5>
          
          <div class="info-grid">
            <div class="info-item">
              <h6><i class="fas fa-shield-alt me-2 text-danger"></i><strong>Tenacidade</strong></h6>
              <p><strong>Descrição:</strong> Teste de resistência muscular prolongada.</p>
              <p><strong>Quando usar:</strong> manter esforço físico contínuo por longos períodos.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Caminhar dias seguidos sem descanso</li>
                <li>Subir lentamente um penhasco íngreme</li>
                <li>Manter braçadas constantes ao nadar contra correnteza</li>
              </ul>
            </div>
            
            <div class="info-item">
              <h6><i class="fas fa-fist-raised me-2 text-danger"></i><strong>Fortitude</strong></h6>
              <p><strong>Descrição:</strong> Teste de resistência a danos e agentes nocivos.</p>
              <p><strong>Quando usar:</strong> suportar ferimentos, venenos, doenças ou elementos hostis.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Resistir ao sangramento e choque após levar uma facada</li>
                <li>Suportar os efeitos de um gás alucinógeno</li>
                <li>Aguentar dias em ambiente tóxico (caverna fétida, áreas contaminadas, etc.)</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Baseadas em Destreza -->
      <div class="content-card">
        <div class="content-card-body">
          <h5 class="sub-subsection-title">Baseadas em Destreza</h5>
          
          <div class="info-grid">
            <div class="info-item">
              <h6><i class="fas fa-crosshairs me-2 text-danger"></i><strong>Técnica (possui variantes)</strong></h6>
              <p><strong>Descrição:</strong> Teste de habilidade motora especializada.</p>
              <p><strong>Quando usar:</strong> executar ações que exigem prática e precisão treinada.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Atirar flechas com mira perfeita</li>
                <li>Lacerar um alvo usando uma espada</li>
                <li>Tocar um instrumento musical ou montar um mecanismo delicado</li>
              </ul>
            </div>
            
            <div class="info-item">
              <h6><i class="fas fa-bolt me-2 text-danger"></i><strong>Reflexo</strong></h6>
              <p><strong>Descrição:</strong> Teste de reação imediata a estímulos repentinos.</p>
              <p><strong>Quando usar:</strong> reagir a perigos ou acontecimentos inesperados em frações de segundo.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Desviar de uma lâmina que vem em sua direção</li>
                <li>Pegar um objeto que está caindo</li>
                <li>Saltar para o lado ao ver uma pedra gigante rolando na sua direção</li>
              </ul>
            </div>
            
            <div class="info-item">
              <h6><i class="fas fa-balance-scale me-2 text-danger"></i><strong>Controle</strong></h6>
              <p><strong>Descrição:</strong> Teste de equilíbrio e precisão corporal sob estresse.</p>
              <p><strong>Quando usar:</strong> mover‑se com cuidado e exatidão, especialmente em espaços restritos ou sob pressão.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Esgueirar‑se silenciosamente entre guardas</li>
                <li>Andar sobre um tronco estreito sem perder o equilíbrio</li>
                <li>Manter a postura estável ao atravessar uma ponte estreita e oscilante</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Baseadas em Força -->
      <div class="content-card">
        <div class="content-card-body">
          <h5 class="sub-subsection-title">Baseadas em Força</h5>
          
          <div class="info-grid">
            <div class="info-item">
              <h6><i class="fas fa-running me-2 text-danger"></i><strong>Atletismo</strong></h6>
              <p><strong>Descrição:</strong> Teste de explosão de força em curtos esforços.</p>
              <p><strong>Quando usar:</strong> aplicar grande potência muscular rapidamente.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Empurrar um carro atolado</li>
                <li>Fazer um salto poderoso para alcançar um beiral</li>
                <li>Carregar um objeto muito pesado por alguns metros</li>
              </ul>
            </div>
            
            <div class="info-item">
              <h6><i class="fas fa-fist-raised me-2 text-danger"></i><strong>Corpo-a-corpo</strong></h6>
              <p><strong>Descrição:</strong> Teste de combate e grappling físico.</p>
              <p><strong>Quando usar:</strong> dominar ou resistir a agarrões, imobilizações e golpes corpo a corpo.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Agarrar o braço de um inimigo para imobilizá‑lo</li>
                <li>Romper uma chave de braço</li>
                <li>Acertar ataques marciais certeiros em um adversário</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Perícias Mentais -->
  <div class="content-card">
    <div class="content-card-body">
      <h4 class="subsection-title text-info">Perícias Mentais</h4>
      
      <!-- Baseadas em Espírito -->
      <div class="content-card">
        <div class="content-card-body">
          <h5 class="sub-subsection-title">Baseadas em Espírito</h5>
          
          <div class="info-grid">
            <div class="info-item">
              <h6><i class="fas fa-brain me-2 text-info"></i><strong>Autocontrole</strong></h6>
              <p><strong>Descrição:</strong> Teste de resistência instantâneo a influências externas e a surtos de emoção.</p>
              <p><strong>Quando usar:</strong> refrear impulsos, ignorar pânico ou medo súbito, suportar coerção mental ou compulsões.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Dizer "não" a um manipulador que tenta forçá-lo a trair um amigo</li>
                <li>Manter a calma mesmo sofrendo uma humilhação pública</li>
                <li>Suportar uma ilusão que tenta despertar o terror</li>
              </ul>
            </div>
            
            <div class="info-item">
              <h6><i class="fas fa-heart me-2 text-info"></i><strong>Resiliência</strong></h6>
              <p><strong>Descrição:</strong> Teste de recuperação emocional após choques prolongados ou traumas.</p>
              <p><strong>Quando usar:</strong> recompor-se após perdas, choques ou traumas severos; manter a sanidade em cenários de sofrimento contínuo.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Voltar ao equilíbrio mental após assistir à destruição de seu grupo</li>
                <li>Superar o luto por um ente querido sem entrar em depressão profunda</li>
                <li>Manter-se funcional após dias sendo torturado física ou psicologicamente</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Baseadas em Intelecto -->
      <div class="content-card">
        <div class="content-card-body">
          <h5 class="sub-subsection-title">Baseadas em Intelecto</h5>
          
          <div class="info-grid">
            <div class="info-item">
              <h6><i class="fas fa-book me-2 text-info"></i><strong>Conhecimento</strong></h6>
              <p><strong>Descrição:</strong> Teste de análise e domínio técnico em um campo específico.</p>
              <p><strong>Quando usar:</strong> criação, construção, e pesquisa de magias, além da resolução de problemas complexos que exigem estudo prévio.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Decifrar um manuscrito mágico</li>
                <li>Reconstituir um motor antigo para fazer ele funcionar</li>
                <li>Elaborar uma estratégia de batalha baseada em táticas militares</li>
              </ul>
            </div>
            
            <div class="info-item">
              <h6><i class="fas fa-eye me-2 text-info"></i><strong>Intuição</strong></h6>
              <p><strong>Descrição:</strong> Teste de pressentimentos e experiência inconsciente.</p>
              <p><strong>Quando usar:</strong> perceber perigo antes que ele aconteça, captar mentiras sutis ou ter "um palpite" certeiro.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Sentir que um aliado está mentindo mesmo sem provas objetivas</li>
                <li>Perceber que uma ponte aparentemente segura vai desabar</li>
                <li>Conseguir ter um pressentimento a respeito do resultado de uma negociação</li>
              </ul>
            </div>
            
            <div class="info-item">
              <h6><i class="fas fa-search me-2 text-info"></i><strong>Percepção</strong></h6>
              <p><strong>Descrição:</strong> Teste de atenção aos cinco sentidos e detalhes do ambiente.</p>
              <p><strong>Quando usar:</strong> notar pistas físicas, sons, cheiros, cores, texturas ou pessoas escondidas que possam passar despercebidas.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Ouvir passos leves atrás de você numa sala silenciosa</li>
                <li>Notar um filete de fumaça saindo por debaixo da porta</li>
                <li>Perceber uma mão procurando algo nos bolsos da usa mochila</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Baseadas em Carisma -->
      <div class="content-card">
        <div class="content-card-body">
          <h5 class="sub-subsection-title">Baseadas em Carisma</h5>
          
          <div class="info-grid">
            <div class="info-item">
              <h6><i class="fas fa-comments me-2 text-info"></i><strong>Influência</strong></h6>
              <p><strong>Descrição:</strong> Teste influencia social, através do carisma e eloquência e experiencia em lidar com pessoas e situações sociais.</p>
              <p><strong>Quando usar:</strong> convencer, provocar sentimentos ou movimentar plateias pelo poder de sua presença e palavras.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Inspirar uma tropa a lutar contra probabilidades impossíveis</li>
                <li>Enfurecer um inimigo para que ele aja impetuosamente</li>
                <li>Convencer um mercador relutante a dar desconto usando charme e argumentos</li>
              </ul>
            </div>
            
            <div class="info-item">
              <h6><i class="fas fa-theater-masks me-2 text-info"></i><strong>Atuação</strong></h6>
              <p><strong>Descrição:</strong> Teste de performance, fingimento ou disfarce emocional para enganar observadores.</p>
              <p><strong>Quando usar:</strong> simular estados de espírito, ocultar intenções verdadeiras ou imitar comportamentos alheios.</p>
              <p><strong>Exemplos:</strong></p>
              <ul class="mb-0">
                <li>Fingir estar gravemente ferido para distrair guardas</li>
                <li>Imitar o sotaque de um nobre para entrar disfarçado numa festa</li>
                <li>Chorar de forma convincente para ganhar a simpatia de alguém</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        <!-- Variações de Conhecimentos e Técnicas -->
        <div class="content-card">
          <div class="content-card-body">
            <h3 class="section-title">Variações de Conhecimentos e Técnicas</h3>
            
            <div class="text-content">
              <p>Veja abaixo as variações de Conhecimentos e Técnicas. Repare que quando um teste de uma dessas duas perícias é realizado, ele sempre terá sua variação especificada. Por isso quando o jogador pode escolher uma ou mais Técnicas ou Conhecimentos, o mesmo pega uma ou mais variações de cada tipo dessas Perícias.</p>
            </div>
            
            <div class="info-grid">
              <div class="info-item">
                <h4 class="subsection-title">Conhecimentos</h4>
                <ul>
                  <li><strong>Arcano</strong> – Entendimento de magia arcana, criaturas arcanas, artefatos e inscrições mágicas</li>
                  <li><strong>Religioso</strong> – Saberes sobre magia divina, divindades, cultos, dogmas e magia divina</li>
                  <li><strong>Histórico</strong> – Compreensão de fatos antigos, eventos marcantes e tradições</li>
                  <li><strong>Natureza</strong> – Saber lidar com plantas, animais, sobrevivência clima e ambiente natural</li>
                  <li><strong>Engenharia</strong> – Projetos de armas, estruturas e mecanismos</li>
                  <li><strong>Alquimia</strong> – Conhecimento sobre substâncias, poções, efeitos químicos, Física, Matemática</li>
                  <li><strong>Navegação</strong> – Cartografia, rotas terrestres e marítimas, geografia, clima</li>
                  
<li><strong>Linguístico</strong> – Conhecimento sobre Idiomas, dialetos e girias de outras regiões</li>
                </ul>
              </div>
              
              <div class="info-item">
                <h4 class="subsection-title">Técnicas</h4>
                <ul>
                  <li><strong>Esgrima</strong> – Habilidade com armas de corte e precisão (espadas, adagas)</li>
                  <li><strong>Pontaria</strong> – Uso de armas à distância (arcos, bestas, armas de fogo)</li>
                  <li><strong>Marcial</strong> – Uso de armas brutas ou improvisadas (machados, clavas, porretes)</li>
                  <li><strong>Metalurgia</strong> – Manipulação prática de metais (forjar, moldar, fundir)</li>
                  <li><strong>Artesanato</strong> – Criação de objetos manuais: entalhes, costura, escultura, culinária</li>
                  <li><strong>Ladinagem</strong> – Abertura de fechaduras, desarme/criação de armadilhas, truques manuais</li>
                  <li><strong>Instrumentos</strong> – Operação precisa de instrumentos musicais ou mecânicos, como pequenas máquinas</li>
                  <li><strong>Pilotagem</strong> – Controle de montarias, veículos ou máquinas complexas</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Utilizando as Perícias -->
        <div class="content-card">
          <div class="content-card-body">
  <h3 class="section-title">Utilizando as Perícias</h3>
  
  <div class="text-content">
    <p>As perícias podem ser utilizadas de infinitas maneiras, em infinitos cenários e ocasiões, isto fica a caráter da criatividade do jogador, e claro, da paciência do mestre.</p>
  </div>
  
  <!-- Exemplos Corporais -->
  <div class="content-card">
    <div class="content-card-body">
      <h4 class="subsection-title text-danger">Exemplos de Uso - Perícias Corporais</h4>
      
      <div class="info-grid">
        <div class="info-item">
          <h6><strong>Ataque de espada</strong></h6>
          <p><strong>Quem ataca usa:</strong> Técnica Esgrima</p>
          <p><strong>Quem defende usa:</strong> Reflexo (tentar desviar ou bloquear o golpe no último instante)</p>
          <p><strong>Uso típico:</strong> o jogador rola Técnica vs o monstro rola Reflexo; quem obtiver maior resultado realiza a ação.</p>
        </div>
        
        <div class="info-item">
          <h6><strong>Disparo de arma leve</strong></h6>
          <p><strong>Quem ataca usa:</strong> Técnica Pontaria</p>
          <p><strong>Quem defende usa:</strong> Reflexos (impedir ser atingido)</p>
          <p><strong>Uso típico:</strong> Técnica do atirador contra Controle do alvo — um tiro preciso contra a capacidade de desviar.</p>
        </div>
        
        <div class="info-item">
          <h6><strong>Investida corporal</strong></h6>
          <p><strong>Quem ataca usa:</strong> Corpo-a-corpo (Utilizar a habilidade marcial e força para derrubar)</p>
          <p><strong>Quem defende usa:</strong> Corpo‑a‑corpo (resistir ao agarrão e imobilização)</p>
          <p><strong>Uso típico:</strong> quem tenta derrubar rola Atletismo; quem está sendo derrubado rola Corpo‑a‑corpo para evitar ser imobilizado.</p>
        </div>
        
        <div class="info-item">
          <h6><strong>Manobra em terreno instável</strong></h6>
          <p><strong>Quem ataca (O MUNDO) usa:</strong> CD (Classe de Dificuldade)</p>
          <p><strong>Quem defende usa:</strong> Atletismo (manter equilíbrio e vigor ao se mover exaustivamente)</p>
          <p><strong>Uso típico:</strong> O mestre impõe uma CD para o desafio, quem tenta vencer o desafio usa Atletismo para vencer ele.</p>
        </div>
      </div>
      
      <div class="info-item">
        <h6><strong>Resistir a dano de armadilha</strong></h6>
        <p><strong>Quem ataca usa (a armadilha):</strong> Técnica Ladinagem</p>
        <p><strong>Quem defende usa:</strong> Fortitude (suportar perfurações, venenos ou contusões)</p>
        <p><strong>Uso típico:</strong> Iniciador automático de armadilha rola Técnica; personagem rola Fortitude para minimizar ou ignorar os efeitos nocivos. Note que, existe a possibilidade de ser realizada também a perícia Reflexos para evitar ser acertado pela armadilha, contudo quem realiza o teste em determinadas situações pode escolher não realizar o teste, contudo nestes cenários geralmente outro teste, que seria a consequência, é obrigatório, como a consequência de aceitar tomar os cortes das lâminas, seria, tentar resistir ao ferimento usando Fortitude.</p>
      </div>
    </div>
  </div>
  
  <!-- Exemplos Mentais -->
  <div class="content-card">
    <div class="content-card-body">
      <h4 class="subsection-title text-info">Exemplos de Uso - Perícias Mentais</h4>
      
      <div class="info-grid">
        <div class="info-item">
          <h6><strong>Disputa de Ideias (Debate ou Conversão de Opinião)</strong></h6>
          <p><strong>Quem ataca usa:</strong> Influência (usar argumentos, carisma e lógica para convencer ou manipular)</p>
          <p><strong>Quem defende usa:</strong> Autocontrole (manter-se firme em suas crenças ou princípios)</p>
          <p><strong>Uso típico:</strong> Personagem rola Influência para tentar alterar a decisão ou visão de outro personagem; o alvo rola Autocontrole para resistir à persuasão.</p>
        </div>
        
        <div class="info-item">
          <h6><strong>Interrogatório ou Blefe Emocional</strong></h6>
          <p><strong>Quem ataca usa:</strong> Atuação (finge emoções, mente de forma convincente)</p>
          <p><strong>Quem defende usa:</strong> Intuição (percebe sinais sutis de mentira, desconfia do tom ou do olhar)</p>
          <p><strong>Uso típico:</strong> Atuação é usada para tentar enganar ou simular emoção; intuição do outro lado tenta perceber incongruências.</p>
        </div>
        
        <div class="info-item">
          <h6><strong>Manipulação Inspiradora ou Intimidadora</strong></h6>
          <p><strong>Quem ataca usa:</strong> Influência (inspirar, motivar, amedrontar ou acalmar com palavras)</p>
          <p><strong>Quem defende usa:</strong> Resiliência (manter o estado emocional, não se deixar afetar por intimidação ou comoção)</p>
          <p><strong>Uso típico:</strong> Influência é usada para tentar gerar reação emocional; resiliência é testada para manter o controle emocional.</p>
        </div>
        
        <div class="info-item">
          <h6><strong>Análise Lógica vs. Instinto</strong></h6>
          <p><strong>Quem ataca usa:</strong> Conhecimento Alquimia</p>
          <p><strong>Quem defende usa:</strong> Intuição (perceber padrões não óbvios, seguir o "sentimento")</p>
          <p><strong>Uso típico:</strong> Um jogador pode sugerir uma solução teórica com Conhecimento, enquanto outra tenta chegar a um palpite confiável com Intuição — o mestre pode permitir ambos e premiar o mais eficaz.</p>
        </div>
        
        <div class="info-item">
          <h6><strong>Detecção de Armadilhas Mentais ou Truques Visuais</strong></h6>
          <p><strong>Quem ataca usa:</strong> Atuação (simular uma situação convincente)</p>
          <p><strong>Quem defende usa:</strong> Percepção (para notar algo estranho nos detalhes sensoriais)</p>
          <p><strong>Uso típico:</strong> Um personagem tenta simular um cenário, enquanto outro precisa notar inconsistências perceptivas para escapar do truque.</p>
        </div>
        
        <div class="info-item">
          <h6><strong>Vencer a Exaustão Emocional</strong></h6>
          <p><strong>Quem ataca (o mundo) usa:</strong> CD (Classe de Dificuldade imposta por circunstâncias traumáticas)</p>
          <p><strong>Quem defende usa:</strong> Resiliência (manter-se emocionalmente funcional mesmo após eventos intensos)</p>
          <p><strong>Uso típico:</strong> O mestre determina uma CD emocional após uma perda ou evento estressante; os jogadores rolam Resiliência para seguir em frente sem penalidades.</p>
        </div>
      </div>
      
      <div class="info-item">
        <h6><strong>Persistência em Meio à Adversidade</strong></h6>
        <p><strong>Quem ataca (o mundo) usa:</strong> CD (desafio constante e cumulativo)</p>
        <p><strong>Quem defende usa:</strong> Autocontrole (levantar todos os dias para seguir uma missão, suportar pressão constante)</p>
        <p><strong>Uso típico:</strong> Testes contínuos de Autocontrole para manter o foco, rotina e compromisso frente ao desgaste mental.</p>
      </div>
    </div>
  </div>
</div>

        <!-- Pontos de Vida, Mana, Descanso -->
        <div class="content-card">
          <div class="content-card-body">
            <h3 class="section-title">Pontos de Vida, Mana, Descanso e o Combate e Testes</h3>
            
            <div class="text-content">
              <p>De maneira extremamente simplificada, o combate pode ser interpretado como qualquer tipo de confrontação de forças que possa causar dano a personagens, sejam eles os heróis ou os vilões.</p>
            </div>
            
            <div class="info-grid">
              <div class="info-item">
                <h4 class="subsection-title text-danger">Os Pontos de Vida (PVs)</h4>
                <p>Resumidamente, os pontos de vida ou PVs são um atributo presente em todos os personagens, eles representam a força vital das criaturas e a integridade dos objetos inanimados, com no caso e de maneira a não haver exceções, sempre que o valor de PVs do personagem ou objeto chegar a 0, o mesmo será destruído.</p>
                <p>Os PVs são calculados de maneira diferente dos atributos convencionais, com eles utilizando como base de seu cálculo os pontos presentes nos próprios atributos, geralmente tendo como base o Vigor, sendo estes configurados inicialmente pela Classe do herói.</p>
                <p><em>Veremos mais adiante sobre Classes.</em></p>
              </div>
              
              <div class="info-item">
                <h4 class="subsection-title text-primary">Os Pontos de Mana (PMs)</h4>
                <p>Em Alta Fantasia Online, todas as habilidades especiais dos personagens que manipulam a magia, normalmente usam PMs, sendo estes a semelhança dos PVs definidos pela classe e utilizando atributos como base para seu cálculo.</p>
                <p>Diferentemente dos PVs, quando os PMs chegam a 0, o personagem não morrerá ou o objeto será destruído, contudo, no caso dos personagens, eles ficarão com a condição <strong>Exausto</strong>.</p>
                <p><em>Veremos mais sobre Condições futuramente.</em></p>
              </div>
            </div>
            
            <div class="highlight-box">
              <h4 class="subsection-title text-success">O Descanso</h4>
              <p>Um dos mais importantes recursos de Alta Fantasia Online e da realidade, é descansar, de maneira simples e direta, naturalmente são necessárias <strong>4 horas de descanso</strong> para se recuperar <strong>metade dos PVs e dos PMs</strong>, com o Descanso definido por um período onde o personagem não entrou em combate ou gastou PMs.</p>
              <p class="mb-0"><em>Lugares e efeitos podem impedir o Descanso de ocorrer normalmente.</em></p>
            </div>
            
            <h4 class="subsection-title">O Combate e os Testes</h4>
            <div class="text-content">
              <p>Estar em combate ou realizar um Teste (de perícia) são um dos momentos mais importantes do RPG, pois é aqui onde os heróis impõem a sua vontade por meio das regras no mundo, ou o mundo impõe a sua vontade também usando as regras sobre os heróis.</p>
              <p>Basicamente, Combater um adversário é rolar testes contra ele, da maneira como vimos nos exemplos das perícias, mas note que o mundo nem sempre dará aos heróis alguém para apanhar, mas às vezes dará um castelo a ser escalado, ou um rio a ser vencido, e é por isso que existe a <strong>Classe de Dificuldade</strong>.</p>
              <p>Vencer um combate é causar um efeito em um oponente, seja um corte que reduzirá os PVs do mesmo, ou aplicar uma condição nele, como deixar ele <strong>Agarrado</strong>.</p>
              <p>Já vencer uma CD de um desafio significa vencer o desafio, contudo às vezes o desafio é longo e múltiplos testes são realizados, sendo necessário vencer a maioria deles para vencer o desafio.</p>
            </div>
          </div>
        </div>

        <!-- Classes de Dificuldade -->
        <div class="content-card">
          <div class="content-card-body">
            <h3 class="section-title">Classes de Dificuldade (CD)</h3>
            
            <div class="text-content">
              <p>Aqui vemos os valores-base das CDs dos desafios:</p>
            </div>
            
            <div class="table-container">
              <h4 class="table-title">Valores das Classes de Dificuldade por Rank</h4>
              <div class="table-responsive">
                <table class="table custom-table table-striped mb-0">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Fácil</th>
                      <th>Normal</th>
                      <th>Difícil</th>
                      <th>Muito Difícil</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><td>R1</td><td>10</td><td>13</td><td>17</td><td>21+</td></tr>
                    <tr><td>R2</td><td>14</td><td>18</td><td>23</td><td>28+</td></tr>
                    <tr><td>R3</td><td>18</td><td>23</td><td>29</td><td>35+</td></tr>
                    <tr><td>R4</td><td>22</td><td>28</td><td>35</td><td>42+</td></tr>
                    <tr><td>R5</td><td>26</td><td>33</td><td>41</td><td>49+</td></tr>
                    <tr><td>R6</td><td>30</td><td>38</td><td>47</td><td>56+</td></tr>
                    <tr><td>R7</td><td>34</td><td>43</td><td>53</td><td>63+</td></tr>
                    <tr><td>R8</td><td>38</td><td>48</td><td>59</td><td>70+</td></tr>
                    <tr><td>R9</td><td>42</td><td>53</td><td>65</td><td>77+</td></tr>
                    <tr><td>R10</td><td>46</td><td>58</td><td>71</td><td>84+</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
            
            <div class="image-container">
              <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/grafico-dD6xb0P3m96pW3sQp3Q4SNRiEO2qgM.png" alt="Gráfico de Classe de Dificuldade por Rank" class="img-fluid">
              <p class="text-muted mt-3 mb-0"><small>Dados revisados utilizando Machine Learning.</small></p>
            </div>
            
            <div class="text-content">
              <p>Deixando de lado o gráfico para o desgraçado que criou o sistema, vemos que a escala de dificuldade usando os valores da tabela acima é progressiva, ou seja, ao menos em teoria, a percepção de dificuldade dos desafios de determinado Rank, por exemplo, o R1 para o R10, deve ser idêntica ao jogador.</p>
            </div>
            
            <div class="highlight-box text-center">
              <h5 class="text-success mb-3"><i class="fas fa-smile me-2"></i>Divirta-se!</h5>
              <p class="mb-0">Isso tudo será válido, exceto se algo disser o contrário.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

      <!-- Raças Section -->
      <div id="racas" class="content-section">
        <div class="row">
          <div class="col-12">
            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Raças de Alta Fantasia</h2>
            <p class="lead">Existem 11 raças jogáveis, cada uma com características únicas e origens divinas distintas.</p>
          </div>
        </div>

        <div class="row">
          <!-- Lichirus -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header bg-warning text-dark">
                <h5><i class="fas fa-sun me-2"></i>Lichirus</h5>
                <small>Mês: Janeiro | Origem: Licht</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Leais - Bondosos</p>
                <p><strong>Vida Média:</strong> 1.000 anos</p>
                <p><strong>Características:</strong> Olhos dourados, pele perfeita, resistentes a doenças</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Espírito e Vigor</li>
                  <li>Asas Angelicais</li>
                  <li>Proteção Contra as Trevas (10% falha)</li>
                  <li>Sangue Dourado (50% resistência a doenças)</li>
                </ul>

                <p class="small text-muted">Descendentes de Licht, primeira raça senciente. Vivem em pequenas cidades e valorizam o equilíbrio natural.</p>
              </div>
            </div>
          </div>

          <!-- Dunkerius -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header bg-dark text-white">
                <h5><i class="fas fa-moon me-2"></i>Dunkerius</h5>
                <small>Mês: Fevereiro | Origem: Dunkelheit</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Leais - Malignos</p>
                <p><strong>Vida Média:</strong> 1.000 anos</p>
                <p><strong>Características:</strong> Traços demoníacas, inteligência linguística excepcional</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Intelecto e Carisma</li>
                  <li>Asas Demoniacas</li>
                  <li>Predador Ardiloso (Vantagem em Atuação)</li>
                  <li>Predador Linguista</li>
                </ul>

                <p class="small text-muted">Forjados nas sombras, fundaram o temido Império de Deminesh. Mestres da guerra e magia sombria.</p>
              </div>
            </div>
          </div>

          <!-- Gnomos -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header bg-secondary text-white">
                <h5><i class="fas fa-cog me-2"></i>Gnomos</h5>
                <small>Mês: Março | Origem: Vharros</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Leais - Neutros</p>
                <p><strong>Vida Média:</strong> 1.500 anos</p>
                <p><strong>Características:</strong> Pequenos, mestres da tecnologia arcana</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Intelecto e Espírito</li>
                  <li>Visão no Escuro</li>
                  <li>Cultura das Máquinas</li>
                  <li>Cultura Arcana</li>
                </ul>

                <p class="small text-muted">Vivem no gelado Império de Mirengard, criadores de maravilhas tecnológicas e mágicas.</p>
              </div>
            </div>
          </div>

          <!-- Dryads -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header bg-success text-white">
                <h5><i class="fas fa-leaf me-2"></i>Dryads</h5>
                <small>Mês: Abril | Origem: Elaya</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Leais - Neutros</p>
                <p><strong>Vida Média:</strong> 3.000 anos</p>
                <p><strong>Características:</strong> Conexão total com a natureza, aparência vegetal</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Espírito e Destreza</li>
                  <li>A Palavra de Elaya</li>
                  <li>Vida na Floresta</li>
                  <li>O Sangue de Elaya (Forma Selvagem)</li>
                </ul>

                <p class="small text-muted">Guardiões da Grande Floresta de Elávar, vivem em harmonia com a Árvore do Mundo.</p>
              </div>
            </div>
          </div>

          <!-- Fadas -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header bg-info text-white">
                <h5><i class="fas fa-sparkles me-2"></i>Fadas</h5>
                <small>Mês: Maio | Origem: Myrren</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Caóticos - Bondosos</p>
                <p><strong>Vida Média:</strong> 100 anos</p>
                <p><strong>Características:</strong> Pequenas, asas translúcidas, sangue mágico</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Carisma e Espírito</li>
                  <li>Sangue Mágico (+1 magia por nível)</li>
                  <li>Cultura Arcana</li>
                  <li>Asas de Fada (voo permanente)</li>
                </ul>

                <p class="small text-muted">Vivem na floresta encantada de Lyranelle, mestras da magia arcana e da alegria.</p>
              </div>
            </div>
          </div>

          <!-- Elfos -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header bg-primary text-white">
                <h5><i class="fas fa-star me-2"></i>Elfos</h5>
                <small>Mês: Junho | Origem: Myrren</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Neutros - Neutros</p>
                <p><strong>Vida Média:</strong> 10.000 anos</p>
                <p><strong>Características:</strong> Beleza lendária, longevidade extrema, mestres arcanos</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Intelecto e Espírito</li>
                  <li>Longevidade Arcana (+1 PM/nível)</li>
                  <li>Cultura Arcana</li>
                  <li>Beleza Lendária</li>
                </ul>

                <p class="small text-muted">Governam a República Élfica de Elvanor, mestres da magia e da diplomacia.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Mais raças em uma segunda linha -->
        <div class="row">
          <!-- Elfos Negros -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header" style="background-color: #8B4513; color: white;">
                <h5><i class="fas fa-crescent-moon me-2"></i>Elfos Negros (Sharym'El)</h5>
                <small>Mês: Julho | Origem: Arkan</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Caóticos - Neutros</p>
                <p><strong>Vida Média:</strong> 1.000 anos</p>
                <p><strong>Características:</strong> Pele ébano, olhos dourados, guerreiros resilientes</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Espírito, Intelecto e Destreza</li>
                  <li>Povo Guerreiro</li>
                  <li>Virtude dos Miseráveis</li>
                </ul>

                <p class="small text-muted">Sobreviventes da tragédia de Zahra'tul, governam o Khalifado de Noctharim.</p>
              </div>
            </div>
          </div>

          <!-- Draquenis -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header bg-danger text-white">
                <h5><i class="fas fa-dragon me-2"></i>Draquenis</h5>
                <small>Mês: Agosto | Origem: Arkan</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Leais - Neutros</p>
                <p><strong>Vida Média:</strong> 1.500 anos</p>
                <p><strong>Características:</strong> Escamas, chifres, herança dracônica</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Espírito e Força</li>
                  <li>Povo Guerreiro</li>
                  <li>Herança Dracônica (escolher 2)</li>
                </ul>

                <p class="small text-muted">Divididos entre Draquênia e o Draconato de Zhu, descendentes dos dragões primordiais.</p>
              </div>
            </div>
          </div>

          <!-- Orcs -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header" style="background-color: #8B0000; color: white;">
                <h5><i class="fas fa-skull me-2"></i>Orcs</h5>
                <small>Mês: Setembro | Origem: Vharros</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Leais - Malignos</p>
                <p><strong>Vida Média:</strong> 100 anos</p>
                <p><strong>Características:</strong> Guerreiros implacáveis, cultura da guerra</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Vigor e Força</li>
                  <li>Povo Guerreiro</li>
                  <li>Cultura da Guerra</li>
                </ul>

                <p class="small text-muted">Dominam os desertos do norte africano, devotos fanáticos de Vharros.</p>
              </div>
            </div>
          </div>

          <!-- Feralis -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header" style="background-color: #DC143C; color: white;">
                <h5><i class="fas fa-paw me-2"></i>Feralis</h5>
                <small>Mês: Outubro | Origem: Elaya</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Leais - Neutros</p>
                <p><strong>Vida Média:</strong> 100 anos</p>
                <p><strong>Características:</strong> Traços bestiais, instintos selvagens</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Carisma e Destreza</li>
                  <li>Povo Guerreiro</li>
                  <li>Sangue Selvagem (escolher 1)</li>
                </ul>

                <p class="small text-muted">Habitam o Shogunato de Ferália, mestres da honra e da disciplina marcial.</p>
              </div>
            </div>
          </div>

          <!-- Anões -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header" style="background-color: #8B4513; color: white;">
                <h5><i class="fas fa-hammer me-2"></i>Anões</h5>
                <small>Mês: Novembro | Origem: Elaya</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Leais - Neutros</p>
                <p><strong>Vida Média:</strong> 1.000 anos</p>
                <p><strong>Características:</strong> Mestres forjadores, engenheiros rúnicos</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência: Espírito e Força</li>
                  <li>Povo Guerreiro</li>
                  <li>Nascidos na Montanha</li>
                </ul>

                <p class="small text-muted">Reino de Kharzun-Dol, o mais antigo reino ainda em pé, mestres da forja.</p>
              </div>
            </div>
          </div>

          <!-- Humanos -->
          <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card race-card h-100">
              <div class="card-header" style="background-color: #4169E1; color: white;">
                <h5><i class="fas fa-globe me-2"></i>Humanos</h5>
                <small>Mês: Dezembro | Origem: Alta</small>
              </div>
              <div class="card-body">
                <p><strong>Personalidade:</strong> Caótico - Neutro</p>
                <p><strong>Vida Média:</strong> 1.000 anos</p>
                <p><strong>Características:</strong> Versáteis, adaptáveis, ambiciosos</p>

                <h6>Habilidades Raciais:</h6>
                <ul class="small">
                  <li>Proficiência Humana (2 atributos à escolha)</li>
                  <li>Versatilidade Humana (2 talentos)</li>
                  <li>Originalidade Humana (2 perícias)</li>
                </ul>

                <p class="small text-muted">Divididos em três reinos: Altária, Hespéria e Priori. A raça mais numerosa.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Classes Section -->
      <div id="classes" class="content-section">
        <h2 class="mb-4"><i class="fas fa-sword me-2"></i>Classes de Personagem</h2>

        <div class="row">
          <div class="col-12">
            <ul class="nav nav-pills justify-content-center mb-4">
              <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showClassType('combate')">
                  <i class="fas fa-sword me-1"></i>Combate
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" onclick="showClassType('especialistas')">
                  <i class="fas fa-tools me-1"></i>Especialistas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" onclick="showClassType('suporte')">
                  <i class="fas fa-magic me-1"></i>Suporte
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Classes de Combate -->
        <div id="combate" class="class-type-section">
          <h3 class="text-danger mb-3">Classes de Combate</h3>
          <div class="row">
            <!-- Guerreiro -->
            <div class="col-lg-6 mb-4">
              <div class="card class-card h-100">
                <div class="card-header bg-danger text-white">
                  <h5><i class="fas fa-shield-alt me-2"></i>Guerreiro</h5>
                  <small>Atributo Chave: Intelecto</small>
                </div>
                <div class="card-body">
                  <p><strong>Descrição:</strong> Mestre da versatilidade no campo de batalha, combatente treinado em múltiplas formas de luta.</p>

                  <h6>Características:</h6>
                  <ul class="small">
                    <li>PV: 200/nível + (200 × Vigor)</li>
                    <li>PM: Nível/4 + Intelecto/4</li>
                    <li>Treinamento de Ataque especializado</li>
                    <li>Acesso a Magias Arcanas</li>
                  </ul>

                  <div class="alert alert-info small">
                    <strong>Especialização:</strong> Escolha entre Esgrima, Pontaria ou Marcial
                  </div>
                </div>
              </div>
            </div>

            <!-- Bárbaro -->
            <div class="col-lg-6 mb-4">
              <div class="card class-card h-100">
                <div class="card-header bg-warning text-dark">
                  <h5><i class="fas fa-fist-raised me-2"></i>Bárbaro</h5>
                  <small>Atributo Chave: Espírito</small>
                </div>
                <div class="card-body">
                  <p><strong>Descrição:</strong> Personificação da força bruta e resistência sobre-humana, mestre da selvageria.</p>

                  <h6>Características:</h6>
                  <ul class="small">
                    <li>PV: 200/nível + (200 × Vigor)</li>
                    <li>PM: Nível/4 + Espírito/4</li>
                    <li>Fúria Primitiva</li>
                    <li>Acesso a Magias Divinas</li>
                  </ul>

                  <div class="alert alert-warning small">
                    <strong>Fúria Primitiva:</strong> +RD e +RA por nível, aumento de tamanho, bônus de Força
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Classes de Especialistas -->
        <div id="especialistas" class="class-type-section" style="display: none;">
          <h3 class="text-warning mb-3">Classes de Especialistas</h3>
          <div class="row">
            <div class="col-12">
              <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Em Desenvolvimento:</strong> As classes de especialistas (Swashbuckler, Ninja, Caçador, Inventor, Nobre, Ladino) estão sendo desenvolvidas e serão adicionadas em breve.
              </div>
            </div>
          </div>
        </div>

        <!-- Classes de Suporte -->
        <div id="suporte" class="class-type-section" style="display: none;">
          <h3 class="text-info mb-3">Classes de Suporte</h3>
          <div class="row">
            <!-- Mago -->
            <div class="col-lg-6 mb-4">
              <div class="card class-card h-100">
                <div class="card-header bg-primary text-white">
                  <h5><i class="fas fa-hat-wizard me-2"></i>Mago</h5>
                  <small>Atributo Chave: Intelecto</small>
                </div>
                <div class="card-body">
                  <p><strong>Descrição:</strong> Mestre absoluto do conhecimento arcano, estudioso das artes místicas.</p>

                  <h6>Características:</h6>
                  <ul class="small">
                    <li>PV: 100/nível + (100 × Vigor)</li>
                    <li>PM: 1/nível + Intelecto</li>
                    <li>Escola Arcana</li>
                    <li>Maior variedade de magias</li>
                  </ul>

                  <div class="alert alert-primary small">
                    <strong>Especialização:</strong> Escolha uma Escola Arcana para bônus
                  </div>
                </div>
              </div>
            </div>

            <!-- Feiticeiro -->
            <div class="col-lg-6 mb-4">
              <div class="card class-card h-100">
                <div class="card-header bg-info text-white">
                  <h5><i class="fas fa-sparkles me-2"></i>Feiticeiro</h5>
                  <small>Atributo Chave: Carisma</small>
                </div>
                <div class="card-body">
                  <p><strong>Descrição:</strong> Fusão entre carne e magia, poder arcano inato correndo nas veias.</p>

                  <h6>Características:</h6>
                  <ul class="small">
                    <li>PV: 120/nível + (120 × Vigor)</li>
                    <li>PM: 1/nível + Carisma</li>
                    <li>Habilidades mágicas gratuitas</li>
                    <li>Aprimoramentos automáticos</li>
                  </ul>

                  <div class="alert alert-info small">
                    <strong>Evolução:</strong> Ganha habilidades como Magias Sem Gestos, Sem Palavras, etc.
                  </div>
                </div>
              </div>
            </div>

            <!-- Clérigo -->
            <div class="col-lg-6 mb-4">
              <div class="card class-card h-100">
                <div class="card-header bg-success text-white">
                  <h5><i class="fas fa-cross me-2"></i>Clérigo</h5>
                  <small>Atributo Chave: Espírito</small>
                </div>
                <div class="card-body">
                  <p><strong>Descrição:</strong> Canal vivo entre o mundo mortal e o divino, servo de uma divindade.</p>

                  <h6>Características:</h6>
                  <ul class="small">
                    <li>PV: 100/nível + (100 × Vigor)</li>
                    <li>PM: 1/nível + Espírito</li>
                    <li>Habilidade: Devoto</li>
                    <li>Magias Divinas exclusivas</li>
                  </ul>

                  <div class="alert alert-success small">
                    <strong>Devoção:</strong> Deve escolher uma divindade para servir
                  </div>
                </div>
              </div>
            </div>

            <!-- Bruxo -->
            <div class="col-lg-6 mb-4">
              <div class="card class-card h-100">
                <div class="card-header bg-dark text-white">
                  <h5><i class="fas fa-fire me-2"></i>Bruxo</h5>
                  <small>Atributo Chave: Carisma</small>
                </div>
                <div class="card-body">
                  <p><strong>Descrição:</strong> Reflexo divino da vocação inata, carrega a centelha do divino no sangue.</p>

                  <h6>Características:</h6>
                  <ul class="small">
                    <li>PV: 120/nível + (120 × Vigor)</li>
                    <li>PM: 1/nível + Carisma</li>
                    <li>Aura de Poder</li>
                    <li>Habilidade: Devoto</li>
                  </ul>

                  <div class="alert alert-dark small">
                    <strong>Aura de Poder:</strong> Emana energia que afeta aliados ou inimigos
                  </div>
                </div>
              </div>
            </div>

            <!-- Bardo -->
            <div class="col-lg-6 mb-4">
              <div class="card class-card h-100">
                <div class="card-header" style="background-color: #9932CC; color: white;">
                  <h5><i class="fas fa-music me-2"></i>Bardo</h5>
                  <small>Atributo Chave: Carisma</small>
                </div>
                <div class="card-body">
                  <p><strong>Descrição:</strong> Fusão entre arte, magia e emoção. Magia através de performance.</p>

                  <h6>Características:</h6>
                  <ul class="small">
                    <li>PV: 120/nível + (120 × Vigor)</li>
                    <li>PM: Nível/2 + Carisma</li>
                    <li>Cifras do Bardo</li>
                    <li>Conhecimento de Bardo</li>
                    <li>Magias Arcanas e Divinas</li>
                  </ul>

                  <div class="alert alert-secondary small">
                    <strong>Cifras:</strong> 10 canções especiais que modificam magias
                  </div>
                </div>
              </div>
            </div>

            <!-- Druida -->
            <div class="col-lg-6 mb-4">
              <div class="card class-card h-100">
                <div class="card-header bg-success text-white">
                  <h5><i class="fas fa-tree me-2"></i>Druida</h5>
                  <small>Atributo Chave: Espírito</small>
                </div>
                <div class="card-body">
                  <p><strong>Descrição:</strong> Elo vivo entre a natureza primitiva e o mundo consciente dos mortais.</p>

                  <h6>Características:</h6>
                  <ul class="small">
                    <li>PV: 150/nível + (150 × Vigor)</li>
                    <li>PM: Nível/2 + Espírito/2</li>
                    <li>Forma Selvagem</li>
                    <li>Características Selvagens</li>
                    <li>Rejeita metais</li>
                  </ul>

                  <div class="alert alert-success small">
                    <strong>Forma Selvagem:</strong> Pode se transformar em criaturas naturais
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Magia Section -->
      <div id="magia" class="content-section">
        <h2 class="mb-4"><i class="fas fa-magic me-2"></i>Sistema de Magia</h2>

        <div class="row">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h4>O Que É a Magia</h4>
              </div>
              <div class="card-body">
                <blockquote class="blockquote">
                  <p>"Se a magia fosse um truque, vocês já estariam fazendo chover ouro e cuspindo fogo, não tropeçando em livros. A magia é a linguagem do universo, e o universo não fala com ignorantes."</p>
                  <footer class="blockquote-footer">Hayla, a Arquimaga Eterna</footer>
                </blockquote>

                <p>A magia é uma força fundamental da existência, tão natural quanto a gravidade. Ela atua através dos fios invisíveis que tecem a realidade - os fios do <strong>Éter</strong>, e desconversa com o <strong>Néter</strong> - a entropia pura.</p>

                <h5>Princípios Fundamentais:</h5>
                <ol>
                  <li><strong>O Éter:</strong> A teia da realidade que vibra em múltiplas camadas</li>
                  <li><strong>O Néter:</strong> O antitético, campo de entropia pura</li>
                  <li><strong>A Mente:</strong> A verdadeira manipuladora que exige imaginação e foco</li>
                </ol>
              </div>
            </div>

            <div class="card mt-4">
              <div class="card-header bg-info text-white">
                <h4>As Camadas do Éter</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead class="table-dark">
                      <tr>
                        <th>Nível</th>
                        <th>Camada</th>
                        <th>Descrição</th>
                        <th>Exemplos</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Matéria</td>
                        <td>Manipulação física</td>
                        <td>Montar objetos, criar armas</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Energia</td>
                        <td>Calor, frio, eletricidade</td>
                        <td>Bola de fogo, raio</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Forças</td>
                        <td>Gravidade, magnetismo</td>
                        <td>Campo gravitacional, voo</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Espaço</td>
                        <td>Posição, dimensão</td>
                        <td>Teleporte, bolsos dimensionais</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Tempo</td>
                        <td>Ritmo, aceleração</td>
                        <td>Acelerar movimento</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>Vida</td>
                        <td>Cura, mutação</td>
                        <td>Regeneração, toxinas</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Mente</td>
                        <td>Emoções, ilusões</td>
                        <td>Manipulação mental</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>Espírito</td>
                        <td>Almas, planos astrais</td>
                        <td>Necromancia, invocações</td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td>Caos</td>
                        <td>Probabilidade, distorções</td>
                        <td>Anular magia, colapsar espaço</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card">
              <div class="card-header bg-warning text-dark">
                <h5>Tipos de Magia</h5>
              </div>
              <div class="card-body">
                <h6 class="text-primary">Magia Arcana</h6>
                <p class="small">Nasce da criatividade, estudo e disciplina. Fundamenta-se no Éter e suas camadas vibracionais.</p>

                <h6 class="text-success">Magia Divina</h6>
                <p class="small">Brota da fé e devoção aos deuses. Canais são preces e símbolos sagrados.</p>

                <div class="alert alert-warning small">
                  <strong>Pesquisa de Magias:</strong> Requer tempo, testes e recursos adequados
                </div>
              </div>
            </div>

            <div class="card mt-3">
              <div class="card-header bg-secondary text-white">
                <h5>Escolas Arcanas</h5>
              </div>
              <div class="card-body">
                <ul class="list-unstyled small">
                  <li><strong>Elementarismo</strong> vs Necromancia</li>
                  <li><strong>Cronomancia</strong> vs Invocação</li>
                  <li><strong>Encantamento</strong> vs Vitalismo</li>
                </ul>

                <div class="alert alert-info small">
                  Escolher uma escola dá +1 magia por Rank, mas impede o uso da escola rival.
                </div>
              </div>
            </div>

            <div class="card mt-3">
              <div class="card-header bg-dark text-white">
                <h5>Descritores</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <span class="badge bg-primary badge-custom me-1 mb-1">[Éter]</span>
                    <span class="badge bg-dark badge-custom me-1 mb-1">[Néter]</span>
                    <span class="badge bg-danger badge-custom me-1 mb-1">[Calor]</span>
                    <span class="badge bg-info badge-custom me-1 mb-1">[Frio]</span>
                    <span class="badge bg-warning badge-custom me-1 mb-1">[Eletricidade]</span>
                    <span class="badge bg-success badge-custom me-1 mb-1">[Vital]</span>
                    <span class="badge bg-secondary badge-custom me-1 mb-1">[Mental]</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Exemplo de Magias -->
        <div class="row mt-4">
          <div class="col-12">
            <h4>Exemplos de Magias Arcanas - Nível 1</h4>
            <div class="row">
              <div class="col-lg-6">
                <div class="magic-spell">
                  <h6><i class="fas fa-shield-alt me-2"></i>Escudo Arcano</h6>
                  <p><strong>Descritores:</strong> [Reação] [Éter]</p>
                  <p><strong>Camada:</strong> Energia</p>
                  <p><strong>Custo:</strong> 1 PM</p>
                  <p><strong>Efeito:</strong> Cria um escudo de Éter com +2 de acerto e RD 500 como reação de defesa.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="magic-spell">
                  <h6><i class="fas fa-magic me-2"></i>Míssil Arcano</h6>
                  <p><strong>Descritores:</strong> [Éter] [Destruição]</p>
                  <p><strong>Camada:</strong> Energia</p>
                  <p><strong>Custo:</strong> 1 PM</p>
                  <p><strong>Efeito:</strong> Projétil mágico que sempre acerta o alvo, causando dano de energia pura.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Cronologia Section -->
      <div id="cronologia" class="content-section">
        <h2 class="mb-4"><i class="fas fa-history me-2"></i>Cronologia do Mundo</h2>
        <p class="lead">Ano Atual: <strong>3.071 DA</strong> (Depois da Ascensão de Alta)</p>

        <div class="row">
          <div class="col-12">
            <div class="timeline">
              <!-- Era Primordial -->
              <div class="timeline-item">
                <div class="card">
                  <div class="card-header bg-dark text-white">
                    <h5>Era Primordial</h5>
                    <small>Bilhões de anos antes do presente</small>
                  </div>
                  <div class="card-body">
                    <ul>
                      <li><strong>13,8 bilhões de anos:</strong> Ato da Criação - Licht pronuncia-se e dá início ao universo</li>
                      <li><strong>13,2 bilhões:</strong> Surgimento de Dunkelheit, o Senhor do Silêncio</li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Era do Caos -->
              <div class="timeline-item">
                <div class="card">
                  <div class="card-header bg-danger text-white">
                    <h5>Era do Caos</h5>
                    <small>100 milhões a 1 milhão AA</small>
                  </div>
                  <div class="card-body">
                    <ul>
                      <li>Criação dos Primeiros por Dunkelheit</li>
                      <li>Guerra de Luz e Sombra</li>
                      <li>Criação das Estações (Deuses Menores): Elaya, Arkan, Myrren, Vharros</li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Era da Harmonia -->
              <div class="timeline-item">
                <div class="card">
                  <div class="card-header bg-success text-white">
                    <h5>Era da Harmonia</h5>
                    <small>1 milhão – 100.000 AA</small>
                  </div>
                  <div class="card-body">
                    <ul>
                      <li>Estabilização do plano físico</li>
                      <li><strong>200.000 AA:</strong> Nasce a grande Árvore do Mundo no deserto de Elávar</li>
                      <li>Criação das linhas de Éter por Myrren e Arkan</li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Era das Raças -->
              <div class="timeline-item">
                <div class="card">
                  <div class="card-header bg-primary text-white">
                    <h5>Era das Raças</h5>
                    <small>100.000 – 89.000 AA</small>
                  </div>
                  <div class="card-body">
                    <p>As 11 raças surgem com intervalos de 1.000 anos:</p>
                    <div class="row">
                      <div class="col-md-6">
                        <ul class="small">
                          <li>Lichirius (100.000 AA)</li>
                          <li>Dunkelrius (99.000 AA)</li>
                          <li>Gnomos (98.000 AA)</li>
                          <li>Dryads (97.000 AA)</li>
                          <li>Fadas (96.000 AA)</li>
                          <li>Elfos (95.000 AA)</li>
                        </ul>
                      </div>
                      <div class="col-md-6">
                        <ul class="small">
                          <li>Elfos Negros (94.000 AA)</li>
                          <li>Draquenis (93.000 AA)</li>
                          <li>Orcs (92.000 AA)</li>
                          <li>Feralis (91.000 AA)</li>
                          <li>Anões (90.000 AA)</li>
                          <li>Humanos (89.000 AA)</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Era dos Reis -->
              <div class="timeline-item">
                <div class="card">
                  <div class="card-header bg-warning text-dark">
                    <h5>Era dos Reis</h5>
                    <small>89.000 – 10.113 AA</small>
                  </div>
                  <div class="card-body">
                    <ul class="small">
                      <li><strong>88.000 AA:</strong> Fundação do Reino de Karzun-Dol (Anões)</li>
                      <li><strong>86.000 AA:</strong> Fundação do Reino Élfico de Elvanor</li>
                      <li><strong>73.033 AA:</strong> Nascimento da Draquênia</li>
                      <li><strong>66.666 AA:</strong> Alinhamento das 11 luas - Nascimento de Deminesh</li>
                      <li><strong>66.572 AA:</strong> Fundação do Império de Deminesh</li>
                      <li><strong>62.837 AA:</strong> Nascimento do profeta Noctharim</li>
                      <li><strong>60.331 AA:</strong> Arkan castiga os Sharym'El, jogando Zahra'tul</li>
                      <li><strong>59.394 AA:</strong> Descoberta do Zahra'tul Fragmentado</li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Era das Cinzas -->
              <div class="timeline-item">
                <div class="card">
                  <div class="card-header bg-secondary text-white">
                    <h5>Era das Cinzas</h5>
                    <small>10.113 – 6 DA</small>
                  </div>
                  <div class="card-body">
                    <ul class="small">
                      <li><strong>10.113 AA:</strong> Deminesh declara guerra a Mirengard</li>
                      <li><strong>5.022 AA:</strong> Início oficial da Guerra das Cinzas</li>
                      <li><strong>1.192 AA:</strong> Primeiros testes da Eferaquia</li>
                      <li><strong>304 AA:</strong> Ativação da Umbrexaria por Deminesh</li>
                      <li><strong>1 DA:</strong> Nascimento de Alta</li>
                      <li><strong>6 DA:</strong> Ascensão de Alta e fim da guerra</li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Era de Alta -->
              <div class="timeline-item">
                <div class="card">
                  <div class="card-header" style="background-color: #4169E1; color: white;">
                    <h5>Era de Alta</h5>
                    <small>6 DA – Presente (3.071 DA)</small>
                  </div>
                  <div class="card-body">
                    <ul class="small">
                      <li><strong>12 DA:</strong> Fundação da Tríade Humana (Altária, Hespéria, Priori)</li>
                      <li><strong>79 DA:</strong> Ascensão do Draconato de Zhu</li>
                      <li><strong>118 DA:</strong> Grandes Navegações de Altária</li>
                      <li><strong>1.000 DA:</strong> Licht desce à Terra e funda a Grande Babilônia</li>
                      <li><strong>1.222 DA:</strong> Hayla institui o Conselho da Magia</li>
                      <li><strong>1.280 DA:</strong> Criação da Escola Arcana flutuante</li>
                      <li><strong>3.010 DA:</strong> Morte de Hayla aos 11.128 anos</li>
                      <li><strong>3.071 DA:</strong> Dias atuais</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Search functionality
  document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const allContent = document.querySelectorAll('.content-section, .card-body, .accordion-body, .timeline-item');

    // Clear previous highlights
    clearHighlights();

    if (searchTerm.length > 2) {
      let found = false;
      allContent.forEach(element => {
        const text = element.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
          highlightText(element, searchTerm);
          found = true;

          // Show the section containing the match
          const section = element.closest('.content-section');
          if (section) {
            showSection(section.id);
          }
        }
      });

      if (!found) {
        showNoResults();
      }
    }
  });

  function highlightText(element, searchTerm) {
    const walker = document.createTreeWalker(
      element,
      NodeFilter.SHOW_TEXT,
      null,
      false
    );

    const textNodes = [];
    let node;
    while (node = walker.nextNode()) {
      textNodes.push(node);
    }

    textNodes.forEach(textNode => {
      const text = textNode.textContent;
      const regex = new RegExp(`(${searchTerm})`, 'gi');
      if (regex.test(text)) {
        const highlightedText = text.replace(regex, '<span class="highlight">$1</span>');
        const span = document.createElement('span');
        span.innerHTML = highlightedText;
        textNode.parentNode.replaceChild(span, textNode);
      }
    });
  }

  function clearHighlights() {
    const highlights = document.querySelectorAll('.highlight');
    highlights.forEach(highlight => {
      const parent = highlight.parentNode;
      parent.replaceChild(document.createTextNode(highlight.textContent), highlight);
      parent.normalize();
    });
  }

  function clearSearch() {
    document.getElementById('searchInput').value = '';
    clearHighlights();
  }

  function showNoResults() {
    // Could implement a "no results" message here
  }

  // Section navigation
  function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
      section.classList.remove('active');
    });

    // Show selected section
    document.getElementById(sectionId).classList.add('active');

    // Update nav tabs
    document.querySelectorAll('#mainTabs .nav-link').forEach(link => {
      link.classList.remove('active');
    });

    // Find and activate the corresponding tab
    const activeTab = document.querySelector(`#mainTabs .nav-link[onclick*="${sectionId}"]`);
    if (activeTab) {
      activeTab.classList.add('active');
    }
  }

  // Class type navigation
  function showClassType(typeId) {
    // Hide all class type sections
    document.querySelectorAll('.class-type-section').forEach(section => {
      section.style.display = 'none';
    });

    // Show selected type
    document.getElementById(typeId).style.display = 'block';

    // Update nav pills
    document.querySelectorAll('.nav-pills .nav-link').forEach(link => {
      link.classList.remove('active');
    });

    // Find and activate the corresponding pill
    const activeTab = document.querySelector(`.nav-pills .nav-link[onclick*="${typeId}"]`);
    if (activeTab) {
      activeTab.classList.add('active');
    }
  }

  // Initialize tooltips if needed
  document.addEventListener('DOMContentLoaded', function() {
    // Any initialization code can go here
    console.log('Wiki Alta Fantasia carregada com sucesso!');
  });
</script>


<?php include('footer.php'); ?>
