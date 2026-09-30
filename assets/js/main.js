/**
 * Selector — лендинг. Чистый JS без библиотек.
 * 1. Бургер-меню
 * 2. Копирование промокода
 * 3. Липкая кнопка на мобильных
 * 4. Лайтбокс для скриншотов
 */
(function () {
  'use strict';

  /* ---------- 1. Бургер-меню ---------- */
  var burger = document.querySelector('.burger');
  var nav = document.getElementById('nav');

  function setMenu(open) {
    burger.setAttribute('aria-expanded', String(open));
    burger.setAttribute('aria-label', open ? 'Закрыть меню' : 'Открыть меню');
    nav.classList.toggle('is-open', open);
  }

  if (burger && nav) {
    burger.addEventListener('click', function () {
      setMenu(burger.getAttribute('aria-expanded') !== 'true');
    });

    // Закрываем меню после перехода по ссылке и по Esc
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a')) setMenu(false);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') setMenu(false);
    });
  }

  /* ---------- 2. Копирование промокода ---------- */
  function copyText(text) {
    if (navigator.clipboard && window.isSecureContext) {
      return navigator.clipboard.writeText(text).catch(function () {
        return legacyCopy(text);
      });
    }
    return legacyCopy(text);
  }

  // Запасной вариант для http, старых браузеров и запрета доступа к буферу
  function legacyCopy(text) {
    return new Promise(function (resolve, reject) {
      var field = document.createElement('textarea');
      field.value = text;
      field.setAttribute('readonly', '');
      field.style.position = 'fixed';
      field.style.opacity = '0';
      document.body.appendChild(field);
      field.select();
      var ok = document.execCommand('copy');
      document.body.removeChild(field);
      ok ? resolve() : reject();
    });
  }

  document.querySelectorAll('[data-promo]').forEach(function (promo) {
    var btn = promo.querySelector('[data-promo-copy]');
    var code = promo.querySelector('[data-promo-code]');
    var status = promo.querySelector('[data-promo-status]');
    var timer;

    btn.addEventListener('click', function () {
      copyText(code.textContent.trim()).then(function () {
        promo.classList.add('is-copied');
        status.textContent = 'Скопировано';
        clearTimeout(timer);
        timer = setTimeout(function () {
          promo.classList.remove('is-copied');
          status.textContent = 'Копировать';
        }, 2000);
      });
    });
  });

  /* ---------- 3. Липкая кнопка: показываем, когда оффер ушёл с экрана ---------- */
  var sticky = document.querySelector('[data-sticky-cta]');
  var offer = document.querySelector('.offer');

  if (sticky && offer && 'IntersectionObserver' in window) {
    new IntersectionObserver(function (entries) {
      sticky.classList.toggle('is-visible', !entries[0].isIntersecting);
    }).observe(offer);
  }

  /* ---------- 4. Лайтбокс ---------- */
  var dialog = document.querySelector('[data-lightbox-dialog]');

  if (dialog && typeof dialog.showModal === 'function') {
    var dialogImg = dialog.querySelector('[data-lightbox-img]');

    document.querySelectorAll('[data-lightbox]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var img = btn.querySelector('img');
        dialogImg.src = btn.dataset.lightbox;
        dialogImg.alt = img ? img.alt : '';
        dialog.showModal();
      });
    });

    dialog.querySelector('[data-lightbox-close]').addEventListener('click', function () {
      dialog.close();
    });

    // Клик по затемнённому фону закрывает окно
    dialog.addEventListener('click', function (e) {
      if (e.target === dialog) dialog.close();
    });
  }
})();
