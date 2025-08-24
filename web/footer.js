(function(){
  try {
    var existing = document.getElementById('ga-footer');
    if (existing) return;
    var footer = document.createElement('div');
    footer.id = 'ga-footer';
    footer.setAttribute('role','contentinfo');
    footer.style.position = 'fixed';
    footer.style.left = 0;
    footer.style.right = 0;
    footer.style.bottom = 0;
    footer.style.zIndex = 9999;
    footer.style.background = '#ffffff';
    footer.style.borderTop = '1px solid #e0e0e0';
    footer.style.boxShadow = '0 -2px 8px rgba(0,0,0,0.04)';
    footer.style.padding = '8px 12px';
    footer.style.textAlign = 'center';
    footer.style.fontFamily = 'system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif';
    footer.style.fontSize = '12px';
    footer.style.color = '#666';

    var line1 = document.createElement('div');
    line1.textContent = 'Grupo America Interior todos los derechos reservados.';
    var line2 = document.createElement('div');
    var VERSION = (typeof window.__APP_VERSION__ !== 'undefined' ? window.__APP_VERSION__ : '1.0.0');
    line2.textContent = 'version ' + VERSION;

    footer.appendChild(line1);
    footer.appendChild(line2);
    document.body.appendChild(footer);

    var currentPad = parseInt(window.getComputedStyle(document.body).paddingBottom || '0', 10);
    var needed = 56; // approx footer height
    if (currentPad < needed) {
      document.body.style.paddingBottom = needed + 'px';
    }
  } catch (e) {}
})();
