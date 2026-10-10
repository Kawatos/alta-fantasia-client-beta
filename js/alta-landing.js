/* Alta Fantasia — interações da landing (alta.php) */
(function () {
  'use strict';

  const root = document.querySelector('main.af') || document.querySelector('.af');
  if (!root) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  document.documentElement.classList.add('af-js');

  /* ---------- Revelação ao rolar ---------- */
  const revealEls = root.querySelectorAll('.af-reveal');
  if ('IntersectionObserver' in window && !reduceMotion) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          // depois da entrada, devolve transições rápidas (tilt/hover)
          const delay = (parseInt(getComputedStyle(e.target).getPropertyValue('--d'), 10) || 0) * 110;
          setTimeout(() => e.target.classList.add('is-done'), 950 + delay);
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });
    revealEls.forEach((el) => io.observe(el));
  } else {
    revealEls.forEach((el) => el.classList.add('is-visible'));
  }

  /* ---------- Contadores animados ---------- */
  const counters = root.querySelectorAll('[data-count]');
  const runCounter = (el) => {
    const target = parseInt(el.dataset.count, 10);
    const prefix = el.dataset.prefix || '';
    if (reduceMotion) { el.textContent = prefix + target; return; }
    const start = performance.now();
    const dur = 1800;
    const tick = (now) => {
      const p = Math.min((now - start) / dur, 1);
      const eased = 1 - Math.pow(1 - p, 4);
      el.textContent = prefix + Math.round(target * eased);
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };
  if ('IntersectionObserver' in window) {
    const co = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) { runCounter(e.target); co.unobserve(e.target); }
      });
    }, { threshold: 0.6 });
    counters.forEach((c) => co.observe(c));
  } else {
    counters.forEach(runCounter);
  }

  /* ---------- Progresso + parallax (um único scroll handler) ---------- */
  const progress = document.querySelector('.af-progress');
  const navbar = document.querySelector('.af-page .navbar');
  const bgs = Array.from(root.querySelectorAll('.af-bg'));
  let ticking = false;

  const onScroll = () => {
    const doc = document.documentElement;
    const max = doc.scrollHeight - window.innerHeight;
    if (progress && max > 0) progress.style.transform = 'scaleX(' + (window.scrollY / max) + ')';
    if (navbar) navbar.classList.toggle('is-scrolled', window.scrollY > 40);

    if (!reduceMotion) {
      const vh = window.innerHeight;
      bgs.forEach((bg) => {
        const rect = bg.parentElement.getBoundingClientRect();
        if (rect.bottom < 0 || rect.top > vh) return;
        const offset = (rect.top + rect.height / 2 - vh / 2) * -0.18;
        bg.style.transform = 'translate3d(0,' + offset.toFixed(1) + 'px,0)';
      });
    }
    ticking = false;
  };

  window.addEventListener('scroll', () => {
    if (!ticking) { ticking = true; requestAnimationFrame(onScroll); }
  }, { passive: true });
  window.addEventListener('resize', onScroll);
  onScroll();

  /* ---------- Tilt + brilho nos cards ---------- */
  if (!reduceMotion && window.matchMedia('(hover: hover)').matches) {
    root.querySelectorAll('.af-card').forEach((card) => {
      card.addEventListener('pointermove', (ev) => {
        const r = card.getBoundingClientRect();
        const x = (ev.clientX - r.left) / r.width;
        const y = (ev.clientY - r.top) / r.height;
        card.style.setProperty('--ry', ((x - 0.5) * 8).toFixed(2) + 'deg');
        card.style.setProperty('--rx', ((0.5 - y) * 8).toFixed(2) + 'deg');
        card.style.setProperty('--mx', (x * 100).toFixed(1) + '%');
        card.style.setProperty('--my', (y * 100).toFixed(1) + '%');
      });
      card.addEventListener('pointerleave', () => {
        card.style.setProperty('--rx', '0deg');
        card.style.setProperty('--ry', '0deg');
      });
    });
  }

  /* ---------- Brasas: Douradas no Hero & Vermelhas/Chama no Lore ---------- */
  if (!reduceMotion) {
    // 1. Brasas Douradas do Hero
    const heroCanvas = root.querySelector('.af-hero .af-embers');
    if (heroCanvas) {
      const ctx = heroCanvas.getContext('2d');
      let w = 0, h = 0, particles = [], running = true;
      const SPR = 64;
      const sprite = document.createElement('canvas');
      sprite.width = sprite.height = SPR;
      (function () {
        const s = sprite.getContext('2d');
        const g = s.createRadialGradient(SPR / 2, SPR / 2, 0, SPR / 2, SPR / 2, SPR / 2);
        g.addColorStop(0, 'rgba(255,225,140,1)');
        g.addColorStop(0.35, 'rgba(240,190,70,0.45)');
        g.addColorStop(1, 'rgba(212,160,23,0)');
        s.fillStyle = g;
        s.fillRect(0, 0, SPR, SPR);
      })();

      const spawn = (anywhere) => ({
        x: Math.random() * (w || 300),
        y: anywhere ? Math.random() * (h || 600) : (h || 600) + 10,
        r: Math.random() * 2.2 + 0.6,
        vy: Math.random() * 1.5 + 0.8, // Velocidade aumentada
        vx: (Math.random() - 0.5) * 0.5,
        a: Math.random() * 0.6 + 0.3,
        ph: Math.random() * Math.PI * 2
      });

      const resize = () => {
        const curW = heroCanvas.clientWidth;
        const curH = heroCanvas.clientHeight;
        if (!curW || !curH || curW < 50 || curH < 50) return;
        const curDpr = Math.min(window.devicePixelRatio || 1, 2);
        w = curW;
        h = curH;
        heroCanvas.width = Math.round(w * curDpr);
        heroCanvas.height = Math.round(h * curDpr);
        ctx.setTransform(curDpr, 0, 0, curDpr, 0, 0);
        const count = Math.round(Math.min(45, Math.max(18, w / 28)));
        if (!particles.length || Math.abs(particles.length - count) > 10) {
          particles = Array.from({ length: count }, () => spawn(true));
        }
      };

      const frame = (t) => {
        if (!running) return;
        if (document.body.classList.contains('modal-open') || document.hidden) {
          requestAnimationFrame(frame);
          return;
        }

        const curW = heroCanvas.clientWidth;
        const curH = heroCanvas.clientHeight;
        if (curW < 50 || curH < 50) {
          requestAnimationFrame(frame);
          return;
        }

        if (curW !== w || curH !== h) {
          resize();
        }

        // Limpeza absoluta de 100% dos pixels do canvas (sem riscos ou rastros)
        ctx.save();
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.clearRect(0, 0, heroCanvas.width, heroCanvas.height);
        ctx.restore();

        for (const p of particles) {
          p.y -= p.vy;
          p.x += p.vx + Math.sin(t / 900 + p.ph) * 0.25;
          if (p.y < -10) Object.assign(p, spawn(false));
          const size = p.r * 10;
          ctx.globalAlpha = p.a * (0.6 + Math.sin(t / 300 + p.ph) * 0.4);
          ctx.drawImage(sprite, p.x - size / 2, p.y - size / 2, size, size);
        }
        ctx.globalAlpha = 1;
        requestAnimationFrame(frame);
      };

      if ('IntersectionObserver' in window) {
        new IntersectionObserver((entries) => {
          const vis = entries[0].isIntersecting;
          if (vis) {
            resize();
            if (!running) { running = true; requestAnimationFrame(frame); }
          } else {
            running = false;
          }
        }).observe(heroCanvas);
      }

      if ('ResizeObserver' in window) {
        new ResizeObserver(() => resize()).observe(heroCanvas);
      }

      window.addEventListener('resize', resize);
      document.addEventListener('fullscreenchange', () => setTimeout(resize, 100));
      window.addEventListener('af:view-change', (e) => {
        if (e.detail && e.detail.to === 'landing') {
          setTimeout(resize, 50);
          setTimeout(resize, 320);
        }
      });

      resize();
      requestAnimationFrame(frame);
    }

    // 2. Brasas Vermelhas / Fagulhas Incandescentes do Bloco das Crônicas
    const loreCanvas = root.querySelector('.af-embers--lore') || root.querySelector('.af-lore .af-embers');
    if (loreCanvas) {
      const ctx = loreCanvas.getContext('2d');
      let w = 0, h = 0, embers = [], running = true;

      // Sprite 1: Carvão/Brasa Angular (Faceted Shard) com núcleo incandescente
      const SW = 64, SH = 64;
      const spriteFlake = document.createElement('canvas');
      spriteFlake.width = SW; spriteFlake.height = SH;
      (function () {
        const s = spriteFlake.getContext('2d');
        const gHalo = s.createRadialGradient(SW / 2, SH / 2, 0, SW / 2, SH / 2, SW / 2);
        gHalo.addColorStop(0, 'rgba(255, 90, 15, 0.85)');
        gHalo.addColorStop(0.35, 'rgba(220, 30, 10, 0.45)');
        gHalo.addColorStop(0.7, 'rgba(140, 5, 5, 0.15)');
        gHalo.addColorStop(1, 'rgba(0, 0, 0, 0)');
        s.fillStyle = gHalo;
        s.fillRect(0, 0, SW, SH);

        // Geometria facetada de lasca de brasa
        s.beginPath();
        s.moveTo(32, 17);
        s.lineTo(45, 27);
        s.lineTo(41, 45);
        s.lineTo(25, 43);
        s.lineTo(19, 28);
        s.closePath();
        const gPoly = s.createRadialGradient(32, 32, 2, 32, 32, 16);
        gPoly.addColorStop(0, 'rgba(255, 255, 225, 1)');      // Núcleo branco-dourado incandescente
        gPoly.addColorStop(0.3, 'rgba(255, 175, 30, 0.95)');  // Calor âmbar
        gPoly.addColorStop(0.65, 'rgba(235, 45, 15, 0.85)');  // Vermelho-fogo
        gPoly.addColorStop(1, 'rgba(170, 10, 10, 0.4)');      // Borda de crosta de carvão
        s.fillStyle = gPoly;
        s.fill();
      })();

      // Sprite 2: Brasa Orgânica Arredondada (Glowing Ember Nugget)
      const spriteRound = document.createElement('canvas');
      spriteRound.width = SW; spriteRound.height = SH;
      (function () {
        const s = spriteRound.getContext('2d');
        const gR = s.createRadialGradient(SW / 2, SH / 2, 0, SW / 2, SH / 2, SW / 2);
        gR.addColorStop(0, 'rgba(255, 245, 195, 1)');
        gR.addColorStop(0.2, 'rgba(255, 135, 25, 0.92)');
        gR.addColorStop(0.5, 'rgba(225, 35, 10, 0.65)');
        gR.addColorStop(0.8, 'rgba(125, 5, 5, 0.18)');
        gR.addColorStop(1, 'rgba(0, 0, 0, 0)');
        s.fillStyle = gR;
        s.beginPath();
        s.arc(SW / 2, SH / 2, 28, 0, Math.PI * 2);
        s.fill();
      })();

      // Sprite 3: Micro-fagulha Rápida (Spark Flare)
      const spriteSpark = document.createElement('canvas');
      spriteSpark.width = 32; spriteSpark.height = 32;
      (function () {
        const s = spriteSpark.getContext('2d');
        const gSp = s.createRadialGradient(16, 16, 0, 16, 16, 16);
        gSp.addColorStop(0, 'rgba(255, 255, 255, 1)');
        gSp.addColorStop(0.25, 'rgba(255, 195, 40, 0.95)');
        gSp.addColorStop(0.65, 'rgba(240, 50, 10, 0.55)');
        gSp.addColorStop(1, 'rgba(0, 0, 0, 0)');
        s.fillStyle = gSp;
        s.fillRect(0, 0, 32, 32);
      })();

      const spawnEmber = (anywhere) => {
        const type = Math.random() < 0.5 ? 0 : (Math.random() < 0.75 ? 1 : 2);
        const isSpark = type === 2;
        return {
          type,
          x: Math.random() * (w || 300),
          y: anywhere ? Math.random() * (h || 400) : (h || 400) + 18,
          r: isSpark ? (Math.random() * 0.7 + 0.5) : (Math.random() * 2.3 + 0.9),
          vy: isSpark ? (Math.random() * 2.8 + 1.6) : (Math.random() * 1.8 + 0.9), // Velocidade aumentada
          vx: (Math.random() - 0.5) * 0.55,
          rot: Math.random() * Math.PI * 2,
          vrot: (Math.random() - 0.5) * 0.045,
          scaleX: Math.random() * 0.3 + 0.75,
          scaleY: Math.random() * 0.35 + 1.1,
          a: Math.random() * 0.55 + 0.45,
          pulseSpeed: Math.random() * 150 + 150,
          ph: Math.random() * Math.PI * 2
        };
      };

      const resizeLore = () => {
        const curW = loreCanvas.clientWidth;
        const curH = loreCanvas.clientHeight;
        if (!curW || !curH || curW < 50 || curH < 50) return;
        const curDpr = Math.min(window.devicePixelRatio || 1, 2);
        w = curW;
        h = curH;
        loreCanvas.width = Math.round(w * curDpr);
        loreCanvas.height = Math.round(h * curDpr);
        ctx.setTransform(curDpr, 0, 0, curDpr, 0, 0);
        const count = Math.round(Math.min(55, Math.max(24, w / 22)));
        if (!embers.length || Math.abs(embers.length - count) > 12) {
          embers = Array.from({ length: count }, () => spawnEmber(true));
        }
      };

      const frameLore = (t) => {
        if (!running) return;
        if (document.body.classList.contains('modal-open') || document.hidden) {
          requestAnimationFrame(frameLore);
          return;
        }

        const curW = loreCanvas.clientWidth;
        const curH = loreCanvas.clientHeight;
        if (curW < 50 || curH < 50) {
          requestAnimationFrame(frameLore);
          return;
        }

        if (curW !== w || curH !== h) {
          resizeLore();
        }

        // Limpeza absoluta com matriz identidade para evitar qualquer rastro ou risco
        ctx.save();
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.clearRect(0, 0, loreCanvas.width, loreCanvas.height);
        ctx.restore();

        // Efeito incandescente com luz aditiva
        ctx.globalCompositeOperation = 'lighter';

        for (const p of embers) {
          p.y -= p.vy;
          p.x += p.vx + Math.sin(t / 750 + p.ph) * 0.35 + Math.cos(t / 1200 + p.ph) * 0.15;
          p.rot += p.vrot;

          if (p.y < -20) Object.assign(p, spawnEmber(false));

          const pulse = 0.65 + Math.sin(t / p.pulseSpeed + p.ph) * 0.35;
          const tumble = Math.cos(t * 0.002 + p.ph);

          ctx.save();
          ctx.translate(p.x, p.y);
          ctx.rotate(p.rot);
          // Efeito de rolagem/queda 3D de lasca de brasa
          ctx.scale(p.scaleX * (0.35 + 0.65 * Math.abs(tumble)), p.scaleY);
          ctx.globalAlpha = Math.max(0, Math.min(1, p.a * pulse));

          const size = p.r * 11;
          const spr = p.type === 0 ? spriteFlake : (p.type === 1 ? spriteRound : spriteSpark);
          ctx.drawImage(spr, -size / 2, -size / 2, size, size);
          ctx.restore();
        }

        ctx.globalCompositeOperation = 'source-over';
        requestAnimationFrame(frameLore);
      };

      if ('IntersectionObserver' in window) {
        new IntersectionObserver((entries) => {
          const vis = entries[0].isIntersecting;
          if (vis) {
            resizeLore();
            if (!running) { running = true; requestAnimationFrame(frameLore); }
          } else {
            running = false;
          }
        }).observe(loreCanvas);
      }

      if ('ResizeObserver' in window) {
        new ResizeObserver(() => resizeLore()).observe(loreCanvas);
      }

      window.addEventListener('resize', resizeLore);
      document.addEventListener('fullscreenchange', () => setTimeout(resizeLore, 100));
      window.addEventListener('af:view-change', (e) => {
        if (e.detail && e.detail.to === 'landing') {
          setTimeout(resizeLore, 50);
          setTimeout(resizeLore, 320);
        }
      });

      resizeLore();
      requestAnimationFrame(frameLore);
    }
  }

  /* ---------- Título Padrão Estático do Fantasia ---------- */
  const fantasia = document.getElementById('fantasiaText');
  if (fantasia) {
    fantasia.classList.add('font-fantasia');
  }

  /* ---------- Citações Aleatórias (Ecos de Aventura) ---------- */
  function iniciarMensagensAleatorias() {
    const mensagens = [
      '"Que suas aventuras sejam épicas e seus dados sempre favoráveis!"',
      '"Nunca subestime o poder de um crítico natural."',
      '"Até os goblins merecem uma chance... talvez."',
      '"A sorte favorece os audaciosos, mas um bom plano nunca é demais."',
      '"Em um mundo de fantasia, até os sonhos mais loucos podem se tornar realidade."',
      '"A magia está em todo lugar, basta saber onde olhar."',
      '"Cada dado lançado é uma nova história esperando para ser contada."',
      '"A jornada é tão importante quanto o destino."',
      '"Um bom mestre de jogo sabe que a narrativa é mais importante que as regras."',
      '"A amizade é o maior tesouro que um aventureiro pode encontrar."',
      '"A imaginação é o único limite em um mundo de fantasia."',
      '"Role os dados e confie no destino."',
      '"Um herói é feito de escolhas e sorte."',
      '"A verdadeira aventura começa onde o conforto termina."',
      '"Em cada esquina, uma nova história espera para ser descoberta."',
      '"Em Alta Fantasia, um dos pilares da Magia é a criatividade."',
      '"A diplomacia é tão poderosa quanto a espada."',
      '"Nunca subestime o poder de um bom plano de fuga."',
      '"A violencia não é a resposta, mas às vezes é a única opção."',
      '"Nem todos os monstros são maus, e nem todos os heróis são bons."',
      '"Nem todos os vilões podem ser convencidos com palavras."',
      '"As vezes o reconhecimento é o maior tesouro que um aventureiro pode encontrar."',
      '"Atitudes bondosas podem ser mal vistas em certos lugares."',
      '"Mostros se chamam monstros por um motivo."',
      '"Anote os nomes dos NPCs, eles podem ser importantes mais tarde."',
      '"Sempre leve em conta as intenções daqueles que falam com você."',
      '"Violencia gratuíta não é bem vista na grande maioria dos lugares."',
      '"Um bom mestre de jogo sabe que ele não está competindo com os jogadores."',
      '"A verdadeira magia está na capacidade de contar histórias que unem as pessoas."',
      '"Em Alta Fantasia, cada personagem é uma peça fundamental na tapeçaria da aventura."',
      '"O caminho fácil nem sempre é o mais divertido."',
      '"Nem sempre o inimigo do seu inimigo é seu amigo."',
      '"A Progressive Technologies é uma empresa que surgiu do nada, mas que se tornou um dos maiores conglomerados de tecnologia do mundo."',
      '"A única diferença entre Alta e o mundo real, é que no mundo real não existem goblins, mas existem pessoas que agem como tais."',
      '"Em Alta existem magos que destroem cidades e guerreiros que partem montanhas ao meio."',
      '"Antes de Alta ascender, ela era uma criança como qualquer outra."',
      '"Resolver um problema com diplomacia também dá XP, e às vezes até mais do que na base da violência."',
      '"Porque será que tem uma mancha de sangue na frente desse baú?"',
      '"Alta Fantasia é balanceado através da força."',
      '"Uma noite tão calminha no mar, o que poderia dar errado?"',
      '"Uma vez teve um infeliz que tentou domar um dragão com uma cenoura."',
      '"Vocês ouviram? Um forasteiro vestido de preto foi grosseiro com a Capitã Irina! Precisamos fazer algo a respeito!"',
      '"As lendas contam que, no topo da montanha mais alta do mundo, Sagarmāthā, reside a Espada do Herói, sobre a sombra de uma Gegenteil...',
      '"A magia é a linguagem do universo, e o universo não fala com ignorantes. Agora, tentem não se explodirem desta vez." — Hayla, a Arquimaga Eterna"',
      '"O primeiro personagem de Alta Fantasia foi um Bardo, que o jogador era Gaúcho! Assim como o Gado, seu criador!"',
      '"O primeiro mago de Alta Fantasia se chamava Taskir, o gnomo, e sua banda de rock favorita era o Nirvana. Ele foi criado pelo Gui!"',
      '"O primeiro clérigo de Alta Fantasia era chamado Cassian De Montverre Bastratti, e ele era um tanto, digamos... excêntrico."',
      '"O primeiro ninja de Alta Fantasia era um humano, de 2m+ de altura, chamado Tekomo (kkkk), sim, ele era Japonês! Ele foi criado pelo Joaobachi!"',
      '"O primeiro samurai de Alta Fantasia e segundo personagem criado foi o Jeff, o Herói de Sagarmāthā... Ele foi criado pelo Ike!"',
      '"Existiam, na Era das Cinzas, 3 poderosas bruxas, uma delas era Sagarmāthā, a Bruxa do Destino, que criou a profecia da Espada do Herói."',
      '"Taskir foi o primeiro avatar a morrer em Alta Fantasia, e, seu controlador Peter que vivia na Terra foi o primeiro a se libertar."',
      '"Veja mais sobre a campanha oficial de Alta Fantasia em: https://alta-fantasia.ct.ws/campanhas_oficiais.php!"',
    ];

    const slideA = document.getElementById('afQuoteSlideA');
    const slideB = document.getElementById('afQuoteSlideB');
    const textA = document.getElementById('afQuoteTextA');
    const textB = document.getElementById('afQuoteTextB');
    const fallbackEl = document.getElementById('mensagem');

    // Embaralha
    mensagens.sort(() => Math.random() - 0.5);

    let index = 0;
    if (textA) textA.innerHTML = `<em>${mensagens[index]}</em>`;
    if (fallbackEl) fallbackEl.innerHTML = `<em>${mensagens[index]}</em>`;

    if (!slideA || !slideB || !textA || !textB) {
      if (fallbackEl) {
        fallbackEl.style.display = 'block';
        setInterval(() => {
          index = (index + 1) % mensagens.length;
          fallbackEl.innerHTML = `<em>${mensagens[index]}</em>`;
        }, 5500);
      }
      return;
    }

    slideA.className = 'af-quote-slide is-active';
    slideB.className = 'af-quote-slide';
    let currentSlide = 'A';
    let isTransitioning = false;

    function trocarMensagem() {
      if (isTransitioning) return;
      if (document.body.classList.contains('modal-open') || document.hidden) return;

      isTransitioning = true;
      index = (index + 1) % mensagens.length;
      const nextQuote = `<em>${mensagens[index]}</em>`;

      if (currentSlide === 'A') {
        textB.innerHTML = nextQuote;
        slideB.className = 'af-quote-slide';
        void slideB.offsetHeight; // Força registro das coordenadas iniciais sem animação

        requestAnimationFrame(() => {
          slideA.className = 'af-quote-slide is-exiting';
          slideB.className = 'af-quote-slide is-active';
          currentSlide = 'B';
          setTimeout(() => {
            slideA.className = 'af-quote-slide';
            isTransitioning = false;
          }, 850);
        });
      } else {
        textA.innerHTML = nextQuote;
        slideA.className = 'af-quote-slide';
        void slideA.offsetHeight; // Força registro das coordenadas iniciais sem animação

        requestAnimationFrame(() => {
          slideB.className = 'af-quote-slide is-exiting';
          slideA.className = 'af-quote-slide is-active';
          currentSlide = 'A';
          setTimeout(() => {
            slideB.className = 'af-quote-slide';
            isTransitioning = false;
          }, 850);
        });
      }
    }

    setInterval(trocarMensagem, 5500);
  }

  iniciarMensagensAleatorias();
})();
