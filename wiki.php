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
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h4><i class="fas fa-level-up-alt me-2"></i>Sistema de Níveis</h4>
              </div>
              <div class="card-body">
                <p>Em Alta Fantasia, a progressão dos personagens é feita por <strong>Níveis</strong>, que determinam o poder, habilidade e capacidades gerais dos heróis.</p>
                <ul>
                  <li>Nível inicial: <strong>1</strong></li>
                  <li>Nível final: <strong>100</strong></li>
                  <li>Ranks são definidos a cada <strong>10 níveis</strong></li>
                  <li>Existem <strong>10 Ranks</strong> no total</li>
                </ul>

                <div class="table-responsive mt-3">
                  <table class="table table-striped">
                    <thead class="table-dark">
                      <tr>
                        <th>Nível/Rank</th>
                        <th>Bônus Base</th>
                        <th>Bônus Atributo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1-10 (Rank 1)</td>
                        <td>1d10</td>
                        <td>1 a 10</td>
                      </tr>
                      <tr>
                        <td>11-20 (Rank 2)</td>
                        <td>2d10</td>
                        <td>11 a 20</td>
                      </tr>
                      <tr>
                        <td>21-30 (Rank 3)</td>
                        <td>3d10</td>
                        <td>21 a 30</td>
                      </tr>
                      <tr>
                        <td>31-40 (Rank 4)</td>
                        <td>4d10</td>
                        <td>31 a 40</td>
                      </tr>
                      <tr>
                        <td>41-50 (Rank 5)</td>
                        <td>5d10</td>
                        <td>41 a 50</td>
                      </tr>
                      <tr>
                        <td>51-60 (Rank 6)</td>
                        <td>6d10</td>
                        <td>51 a 60</td>
                      </tr>
                      <tr>
                        <td>61-70 (Rank 7)</td>
                        <td>7d10</td>
                        <td>61 a 70</td>
                      </tr>
                      <tr>
                        <td>71-80 (Rank 8)</td>
                        <td>8d10</td>
                        <td>71 a 80</td>
                      </tr>
                      <tr>
                        <td>81-90 (Rank 9)</td>
                        <td>9d10</td>
                        <td>81 a 90</td>
                      </tr>
                      <tr>
                        <td>91-100 (Rank 10)</td>
                        <td>10d10</td>
                        <td>91 a 100</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h4><i class="fas fa-dumbbell me-2"></i>Atributos</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <h5 class="text-danger">Corporais</h5>
                    <ul class="list-unstyled">
                      <li><strong>Vigor:</strong> Resistência física, saúde e energia vital</li>
                      <li><strong>Destreza:</strong> Agilidade, reflexos e precisão</li>
                      <li><strong>Força:</strong> Capacidade de levantar, arremessar e causar dano físico</li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <h5 class="text-info">Mentais</h5>
                    <ul class="list-unstyled">
                      <li><strong>Espírito:</strong> Autocontrole, resiliência emocional e presença</li>
                      <li><strong>Intelecto:</strong> Inteligência, lógica e conhecimento</li>
                      <li><strong>Carisma:</strong> Desempenho social, persuasão e estética</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mt-3">
              <div class="card-header bg-warning text-dark">
                <h4><i class="fas fa-heart me-2"></i>Pontos de Vida e Mana</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <h6><strong>Pontos de Vida (PVs)</strong></h6>
                    <p>Representam a força vital das criaturas. Quando chegam a 0, o personagem é destruído.</p>
                    <p><em>Base: Definido pela classe + Vigor</em></p>
                  </div>
                  <div class="col-md-6">
                    <h6><strong>Pontos de Mana (PMs)</strong></h6>
                    <p>Usados para habilidades especiais e magia. Quando chegam a 0, o personagem fica Exausto.</p>
                    <p><em>Base: Definido pela classe + atributo chave</em></p>
                  </div>
                </div>
                <div class="alert alert-info">
                  <strong>Descanso:</strong> 4 horas recuperam metade dos PVs e PMs
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Perícias -->
        <div class="card mt-4">
          <div class="card-header bg-secondary text-white">
            <h4><i class="fas fa-tools me-2"></i>Perícias</h4>
          </div>
          <div class="card-body">
            <p>Por padrão, todos os personagens ganham <strong>1 perícia</strong> de qualquer tipo a cada <strong>20 níveis</strong>.</p>

            <div class="row">
              <div class="col-lg-6">
                <h5 class="text-danger">Perícias Corporais</h5>
                <div class="accordion" id="periciasCorporais">
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vigor">
                        Baseadas em Vigor
                      </button>
                    </h2>
                    <div id="vigor" class="accordion-collapse collapse" data-bs-parent="#periciasCorporais">
                      <div class="accordion-body">
                        <ul>
                          <li><strong>Tenacidade:</strong> Resistência muscular prolongada</li>
                          <li><strong>Fortitude:</strong> Resistência a danos e agentes nocivos</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#destreza">
                        Baseadas em Destreza
                      </button>
                    </h2>
                    <div id="destreza" class="accordion-collapse collapse" data-bs-parent="#periciasCorporais">
                      <div class="accordion-body">
                        <ul>
                          <li><strong>Técnica:</strong> Habilidade motora especializada (possui variantes)</li>
                          <li><strong>Reflexo:</strong> Reação imediata a estímulos repentinos</li>
                          <li><strong>Controle:</strong> Equilíbrio e precisão corporal sob estresse</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#forca">
                        Baseadas em Força
                      </button>
                    </h2>
                    <div id="forca" class="accordion-collapse collapse" data-bs-parent="#periciasCorporais">
                      <div class="accordion-body">
                        <ul>
                          <li><strong>Atletismo:</strong> Explosão de força em curtos esforços</li>
                          <li><strong>Corpo-a-corpo:</strong> Combate e grappling físico</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <h5 class="text-info">Perícias Mentais</h5>
                <div class="accordion" id="periciasMentais">
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#espirito">
                        Baseadas em Espírito
                      </button>
                    </h2>
                    <div id="espirito" class="accordion-collapse collapse" data-bs-parent="#periciasMentais">
                      <div class="accordion-body">
                        <ul>
                          <li><strong>Autocontrole:</strong> Resistência a influências externas</li>
                          <li><strong>Resiliência:</strong> Recuperação emocional após traumas</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#intelecto">
                        Baseadas em Intelecto
                      </button>
                    </h2>
                    <div id="intelecto" class="accordion-collapse collapse" data-bs-parent="#periciasMentais">
                      <div class="accordion-body">
                        <ul>
                          <li><strong>Conhecimento:</strong> Análise e domínio técnico (possui variantes)</li>
                          <li><strong>Intuição:</strong> Pressentimentos e experiência inconsciente</li>
                          <li><strong>Percepção:</strong> Atenção aos cinco sentidos</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#carisma">
                        Baseadas em Carisma
                      </button>
                    </h2>
                    <div id="carisma" class="accordion-collapse collapse" data-bs-parent="#periciasMentais">
                      <div class="accordion-body">
                        <ul>
                          <li><strong>Influência:</strong> Influência social através do carisma</li>
                          <li><strong>Atuação:</strong> Performance e fingimento emocional</li>
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