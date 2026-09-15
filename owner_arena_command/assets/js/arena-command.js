(function(){
  function filters(){
    var text=(document.querySelector('[data-global-search]')?.value || document.querySelector('[data-table-search]')?.value || '').toLowerCase();
    var cols={};
    document.querySelectorAll('[data-column-filter]').forEach(function(sel){ if(sel.value) cols[sel.getAttribute('data-column-filter')]=sel.value.toLowerCase(); });
    var shown=0,total=0;
    document.querySelectorAll('[data-search], .card, .module-card, .task').forEach(function(el){
      total++;
      var ok=true;
      var hay=(el.getAttribute('data-search')||el.textContent).toLowerCase();
      if(text && hay.indexOf(text)===-1) ok=false;
      Object.keys(cols).forEach(function(k){ var attr=(el.getAttribute('data-'+k)||'').toLowerCase(); if(attr && attr!==cols[k]) return; if(!attr || attr!==cols[k]) ok=false; });
      el.style.display=ok?'':'none'; if(ok) shown++;
    });
    document.querySelectorAll('[data-result-count]').forEach(function(el){el.textContent=shown+' of '+total+' visible';});
    document.querySelectorAll('.no-results').forEach(function(el){el.hidden=shown!==0;});
  }
  document.querySelectorAll('[data-global-search],[data-table-search],[data-column-filter]').forEach(function(input){input.addEventListener('input',filters); input.addEventListener('change',filters);});
  document.querySelectorAll('[data-reset-filters]').forEach(function(btn){btn.addEventListener('click',function(){document.querySelectorAll('[data-global-search],[data-table-search]').forEach(function(i){i.value='';});document.querySelectorAll('[data-column-filter]').forEach(function(i){i.value='';});filters();});});
})();
