(function () {
  'use strict';
  var $ = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };
  var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- navbar, progress, back-to-top ---- */
  var nav = $('#nav'), bar = $('#progress'), toTop = $('#toTop');
  function onScroll() {
    var y = window.scrollY, h = document.documentElement.scrollHeight - window.innerHeight;
    if (bar) bar.style.width = (h > 0 ? (y / h) * 100 : 0) + '%';
    if (nav) nav.classList.toggle('scrolled', y > 30);
    if (toTop) toTop.classList.toggle('show', y > 600);
    spy();
  }
  var links = $$('#navLinks a[data-section]');
  function spy() {
    var pos = window.scrollY + 160, current = null;
    links.forEach(function (a) {
      var el = document.getElementById(a.getAttribute('data-section'));
      if (el && el.offsetTop <= pos) current = a;
    });
    links.forEach(function (a) { a.classList.toggle('active', a === current); });
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  var burger = $('#burger'), menu = $('#navLinks');
  if (burger && menu) {
    burger.addEventListener('click', function () { menu.classList.toggle('open'); });
    $$('a', menu).forEach(function (a) { a.addEventListener('click', function () { menu.classList.remove('open'); }); });
  }

  /* ---- typed text ---- */
  var typedEl = $('#typed');
  if (typedEl) {
    var items = [];
    try { items = JSON.parse(typedEl.getAttribute('data-items') || '[]'); } catch (e) {}
    if (items.length) {
      if (reduce) typedEl.textContent = items[0];
      else {
        var i = 0, c = 0, del = false;
        (function type() {
          var w = items[i];
          c += del ? -1 : 1;
          typedEl.textContent = w.slice(0, c);
          var t = del ? 35 : 75;
          if (!del && c === w.length) { del = true; t = 1500; }
          else if (del && c === 0) { del = false; i = (i + 1) % items.length; t = 350; }
          setTimeout(type, t);
        })();
      }
    }
  }

  /* ---- neural canvas ---- */
  var cv = $('#neural');
  if (cv && cv.getContext && !reduce) {
    var ctx = cv.getContext('2d'), W, H, pts = [], mouse = { x: -999, y: -999 }, dpr = Math.min(window.devicePixelRatio || 1, 2);
    function size() {
      var r = cv.parentNode.getBoundingClientRect();
      W = r.width; H = r.height; cv.width = W * dpr; cv.height = H * dpr;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      var n = Math.min(80, Math.round(W * H / 17000));
      pts = [];
      for (var k = 0; k < n; k++) pts.push({ x: Math.random() * W, y: Math.random() * H, vx: (Math.random() - .5) * .35, vy: (Math.random() - .5) * .35 });
    }
    size();
    window.addEventListener('resize', size);
    cv.parentNode.addEventListener('mousemove', function (e) {
      var r = cv.getBoundingClientRect(); mouse.x = e.clientX - r.left; mouse.y = e.clientY - r.top;
    });
    cv.parentNode.addEventListener('mouseleave', function () { mouse.x = mouse.y = -999; });
    var visible = true;
    if ('IntersectionObserver' in window) new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }).observe(cv);
    (function draw() {
      requestAnimationFrame(draw);
      if (!visible) return;
      ctx.clearRect(0, 0, W, H);
      for (var a = 0; a < pts.length; a++) {
        var p = pts[a];
        p.x += p.vx; p.y += p.vy;
        if (p.x < 0 || p.x > W) p.vx *= -1;
        if (p.y < 0 || p.y > H) p.vy *= -1;
        var dm = Math.hypot(p.x - mouse.x, p.y - mouse.y);
        if (dm < 140) { p.x += (p.x - mouse.x) * .004; p.y += (p.y - mouse.y) * .004; }
        for (var b = a + 1; b < pts.length; b++) {
          var q = pts[b], d = Math.hypot(p.x - q.x, p.y - q.y);
          if (d < 130) {
            ctx.strokeStyle = 'rgba(34,211,238,' + (.25 * (1 - d / 130)) + ')';
            ctx.lineWidth = 1; ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(q.x, q.y); ctx.stroke();
          }
        }
        if (dm < 170) {
          ctx.strokeStyle = 'rgba(139,92,246,' + (.5 * (1 - dm / 170)) + ')';
          ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(mouse.x, mouse.y); ctx.stroke();
        }
        ctx.fillStyle = dm < 170 ? '#c4b5fd' : 'rgba(34,211,238,.8)';
        ctx.beginPath(); ctx.arc(p.x, p.y, 2, 0, 6.283); ctx.fill();
      }
    })();
  }

  /* ---- reveal + skill bars ---- */
  function fillBars(root) { $$('.ring', root).forEach(function (r) { animateRing(r); }); if (root.classList && root.classList.contains('ring')) animateRing(root); }
  function animateRing(r) {
    if (r._done) return; r._done = true;
    var to = parseInt(r.getAttribute('data-level') || 0, 10), n = 0, steps = 40;
    var t = setInterval(function () { n++; r.style.setProperty('--p', Math.round(to * n / steps)); if (n >= steps) clearInterval(t); }, 25);
  }
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('in'); fillBars(e.target); io.unobserve(e.target); }
      });
    }, { threshold: .12 });
    $$('.reveal').forEach(function (el) { io.observe(el); });
  } else { $$('.reveal').forEach(function (el) { el.classList.add('in'); }); fillBars(document); }

  /* ---- subtle cursor spotlight on cards ---- */
  $$('.card').forEach(function (card) {
    card.addEventListener('mousemove', function (e) {
      var r = card.getBoundingClientRect();
      card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
      card.style.setProperty('--my', (e.clientY - r.top) + 'px');
    });
  });

  /* ---- project filter ---- */
  var filters = $$('.filter');
  filters.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filters.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      var f = btn.getAttribute('data-filter');
      $$('.proj').forEach(function (p) { p.classList.toggle('hide', f !== 'all' && p.getAttribute('data-cat') !== f); });
    });
  });
})();
