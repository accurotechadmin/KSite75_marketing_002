(() => {
  const lang = window.JOK_LANGUAGE || {};
  const languageText = (token, fallback) => typeof lang[token] === 'string' && lang[token] !== '' ? lang[token] : fallback;
  const motionReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  window.siteEvents = window.siteEvents || [];
  window.trackSiteEvent = (name, data = {}) => {
    window.siteEvents.push({ name, data, at: new Date().toISOString() });
  };

  document.querySelectorAll('[data-track]').forEach((node) => {
    node.addEventListener('click', () => window.trackSiteEvent(node.dataset.track, { href: node.getAttribute('href') }));
  });

  document.querySelectorAll('.site-header').forEach((header) => {
    const toggle = header.querySelector('.nav-toggle');
    const nav = header.querySelector('.top-nav');
    if (!toggle || !nav) return;

    const desktopNavQuery = window.matchMedia('(min-width: 761px)');
    document.body.classList.add('nav-ready');
    nav.hidden = !desktopNavQuery.matches;

    const setOpen = (open) => {
      const shouldOpen = desktopNavQuery.matches ? true : open;
      header.classList.toggle('is-nav-open', !desktopNavQuery.matches && shouldOpen);
      toggle.setAttribute('aria-expanded', !desktopNavQuery.matches && shouldOpen ? 'true' : 'false');
      nav.hidden = !shouldOpen;
    };

    toggle.addEventListener('click', () => {
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';
      setOpen(!isOpen);
    });

    nav.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => setOpen(false));
    });

    window.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') setOpen(false);
    });

    const closeOnDesktop = (event) => {
      setOpen(event.matches);
    };
    if (typeof desktopNavQuery.addEventListener === 'function') {
      desktopNavQuery.addEventListener('change', closeOnDesktop);
    } else if (typeof desktopNavQuery.addListener === 'function') {
      desktopNavQuery.addListener(closeOnDesktop);
    }
  });


  document.querySelectorAll('[data-countdown]').forEach((node) => {
    const target = new Date(node.dataset.targetDate || '2026-09-26T19:30:00-04:00').getTime();
    const render = () => {
      const diff = target - Date.now();
      if (diff <= 0) {
        node.textContent = languageText('landing.countdown.live_message', 'The September 26 signal is live — check event updates.');
        return;
      }
      const days = Math.floor(diff / 86400000);
      const hours = Math.floor((diff % 86400000) / 3600000);
      const minutes = Math.floor((diff % 3600000) / 60000);
      const seconds = Math.floor((diff % 60000) / 1000);
      node.textContent = languageText('landing.countdown.active_template', '{days} days · {hours} hrs · {minutes} min · {seconds} sec to go!')
        .replace('{days}', days)
        .replace('{hours}', hours)
        .replace('{minutes}', minutes)
        .replace('{seconds}', seconds);
    };
    render();
    window.setInterval(render, 1000);
  });


  document.querySelectorAll('[data-check-group]').forEach((group) => {
    const toggle = group.querySelector('[data-check-all]');
    const boxes = Array.from(group.querySelectorAll('input[type="checkbox"][name="interest_tags[]"]'));
    if (!toggle || boxes.length === 0) return;

    const syncToggle = () => {
      const checked = boxes.filter((box) => box.checked).length;
      toggle.checked = checked === boxes.length;
      toggle.indeterminate = checked > 0 && checked < boxes.length;
    };

    toggle.addEventListener('change', () => {
      boxes.forEach((box) => { box.checked = toggle.checked; });
      toggle.indeterminate = false;
      window.trackSiteEvent('interest_toggle_all', { checked: toggle.checked });
    });
    boxes.forEach((box) => box.addEventListener('change', syncToggle));
    syncToggle();
  });



  document.querySelectorAll('[data-form-notice]').forEach((notice) => {
    const status = notice.dataset.formNotice || 'unknown';
    const message = (notice.textContent || '').trim();
    window.trackSiteEvent('form_notice', { status, message });
    if (status === 'error' && window.console && typeof window.console.warn === 'function') {
      window.console.warn('[Just One KISS form notice]', message);
    }
  });

  document.querySelectorAll('[data-enhance-form]').forEach((form) => {
    form.addEventListener('focusin', () => window.trackSiteEvent('form_focus', { type: form.querySelector('[name="form_type"]')?.value || 'unknown' }), { once: true });
    form.addEventListener('submit', () => {
      const status = form.querySelector('[data-form-status]');
      if (status) status.textContent = languageText('landing.form.enhanced_submit_status', 'Checking the signal…');
      window.trackSiteEvent('form_submit_attempt', { type: form.querySelector('[name="form_type"]')?.value || 'unknown' });
    });
  });


  const inlineAdmin = window.JOK_INLINE_LANGUAGE_ADMIN || {};
  if (inlineAdmin.csrf && inlineAdmin.endpoint) {
    const editableTokens = Array.from(document.querySelectorAll('[data-lang-token]'));
    let activeToken = null;

    const toolbar = document.createElement('section');
    toolbar.className = 'jok-lang-toolbar';
    toolbar.setAttribute('aria-label', 'Inline language editor');
    toolbar.hidden = true;
    toolbar.innerHTML = '<strong data-lang-heading>Select page text to edit</strong><label>Canonical text<textarea data-lang-editor></textarea></label><div class="jok-lang-toolbar__actions"><button type="button" data-lang-save>Save text</button><button type="button" data-lang-cancel>Close</button><a data-lang-admin-link target="_blank" rel="noopener">Open admin</a></div><div class="jok-lang-status" data-lang-status aria-live="polite"></div>';
    document.body.appendChild(toolbar);

    const textarea = toolbar.querySelector('[data-lang-editor]');
    const heading = toolbar.querySelector('[data-lang-heading]');
    const status = toolbar.querySelector('[data-lang-status]');
    const adminLink = toolbar.querySelector('[data-lang-admin-link]');
    if (adminLink) adminLink.href = inlineAdmin.adminUrl || './admin/';

    editableTokens.forEach((node) => {
      node.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        activeToken = node;
        toolbar.hidden = false;
        if (heading) heading.textContent = node.dataset.langToken || 'Language token';
        if (textarea) textarea.value = node.textContent || '';
        if (status) status.textContent = 'Editing token from ' + (node.dataset.langComponent || 'page') + '.';
        if (textarea) textarea.focus();
      });
    });

    toolbar.querySelector('[data-lang-cancel]')?.addEventListener('click', () => {
      toolbar.hidden = true;
      activeToken = null;
    });

    toolbar.querySelector('[data-lang-save]')?.addEventListener('click', () => {
      if (!activeToken || !textarea) return;
      const body = new URLSearchParams();
      body.set('csrf_token', inlineAdmin.csrf);
      body.set('token', activeToken.dataset.langToken || '');
      body.set('canonical_text', textarea.value);
      if (status) status.textContent = 'Saving…';
      fetch(inlineAdmin.endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8' },
        body,
        credentials: 'same-origin',
      })
        .then((response) => response.json())
        .then((payload) => {
          if (!payload.ok) throw new Error(payload.message || 'Save failed.');
          activeToken.textContent = payload.canonical_text || textarea.value;
          if (status) status.textContent = payload.message || 'Saved.';
        })
        .catch((error) => {
          if (status) status.textContent = error.message || 'Save failed.';
        });
    });
  }

  document.querySelectorAll('.relic-card').forEach((card) => {
    card.addEventListener('pointerenter', () => {
      if (!motionReduced) card.classList.add('is-open');
    });
    card.addEventListener('pointerleave', () => card.classList.remove('is-open'));
  });
})();
