/* ═══════════════════════════════════════════════════════
   AR Theme – main.js
   (mobile menu + sticky-header + accordion + search overlay)
   Ensures empty searches are blocked, overlay toggles, forms submit to search.php
   ═══════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', () => {

  /* ───────── 1. mobile off-canvas menu ───────── */
  const togglers = document.querySelectorAll('#ar-mobile-toggle');
  const menu     = document.getElementById('ar-mobile-menu');
  const overlay  = document.getElementById('ar-mobile-overlay');
  const closer   = document.querySelector('#ar-mobile-menu .ar-close');

  const toggleMenu = () => {
    menu    && menu.classList.toggle('open');
    overlay && overlay.classList.toggle('open');
  };

  togglers.forEach(btn => btn.addEventListener('click', toggleMenu));
  overlay && overlay.addEventListener('click', toggleMenu);
  closer  && closer.addEventListener('click', toggleMenu);

  /* ───────── 2. sticky headers – background swap ───────── */
  const headers = document.querySelectorAll('.ar-header-desktop, .ar-header-transparent, .ar-header-mobile');
  if (headers.length) {
    const onScroll = () => {
      const isScrolled = window.scrollY > 10;
      headers.forEach(h => h.classList.toggle('scrolled', isScrolled));
    };
    onScroll();
    window.addEventListener('scroll', onScroll);
  }

  /* ───── accordion for sub-menus inside #ar-mobile-menu ───── */
  if (menu) {
    const collapseAll = () => {
      menu.querySelectorAll('li.open').forEach(li => {
        li.classList.remove('open');
        const sub = li.querySelector(':scope > .sub-menu');
        if (sub) sub.style.maxHeight = '0';
      });
    };

    menu.addEventListener('click', e => {
      const link = e.target.closest('a');
      if (!link) return;

      const li  = link.parentElement;
      const sub = li.querySelector(':scope > .sub-menu');
      if (!sub) return;

      e.preventDefault();
      const isOpen = li.classList.contains('open');
      collapseAll();
      if (!isOpen) {
        li.classList.add('open');
        sub.style.maxHeight = sub.scrollHeight + 'px';
      }
    });
  }

  /* ───────── 3. search overlay open/close + form handlers ───────── */
  document.querySelectorAll('.ar-search-wrapper').forEach(wrapper => {
    const openBtn    = wrapper.querySelector('.ar-search-icon');
    const overlayEl  = wrapper.querySelector('.ar-search-overlay');
    const closeBtn   = wrapper.querySelector('.ar-search-close');
    const input      = wrapper.querySelector('#ar-search-field');

    const openSearch = () => {
      wrapper.classList.add('active');
      setTimeout(() => input.focus(), 400);
    };
    const closeSearch = () => wrapper.classList.remove('active');

    openBtn.addEventListener('click', openSearch);
    closeBtn.addEventListener('click', closeSearch);
    overlayEl.addEventListener('click', e => {
      if (e.target === overlayEl) closeSearch();
    });
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && wrapper.classList.contains('active')) {
        closeSearch();
      }
    });

    // 3a: On overlay form submit, close overlay then allow GET to search.php
    const fsForm = wrapper.querySelector('.ar-search-form-fullscreen');
    if (fsForm) {
      fsForm.addEventListener('submit', () => {
        wrapper.classList.remove('active');
      });
    }
  });

  /* ───────── 4. block empty searches for all search forms ───────── */
  document.querySelectorAll('.ar-search-form-fullscreen, .ar-search-form-mobile').forEach(form => {
    form.addEventListener('submit', e => {
      const input = form.querySelector('input[type="search"]');
      if (!input || !input.value.trim()) {
        e.preventDefault();
      }
    });
  });

});
