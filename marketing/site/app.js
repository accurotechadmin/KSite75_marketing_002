const lenses = {
  A: { label: "Campaign A · Cinematic aspiration", title: "Enter the <em>larger</em> night.", deck: "Step out of the ordinary and into an original theatrical-rock world built at mythic scale.", cta: "Enter the story", href: "#story", event: "view_story" },
  B: { label: "Campaign B · Evidence and proof", title: "The craft behind <em>the heat.</em>", deck: "Look closer. Every convincing moment begins with original choices, disciplined preparation, and proof you can examine.", cta: "See the proof", href: "#proof", event: "open_proof_card" },
  C: { label: "Campaign C · Value and clarity", title: "Big night. <em>Clear next step.</em>", deck: "Arena-scale imagination without the maze. Learn what this is, then choose only the verified updates you want.", cta: "Get the signal", href: "#signal", event: "start_signal_form" },
  D: { label: "Campaign D · Social and community", title: "We complete <em>the ritual.</em>", deck: "The stage starts the signal. The crowd gives it a voice, turns it into belonging, and carries the story forward.", cta: "Meet the community", href: "#community", event: "open_story" },
  E: { label: "Campaign E · Premium authority", title: "Built with <em>intent.</em>", deck: "Spectacle earns trust when every visible choice has a purpose and every important boundary is stated plainly.", cta: "Open the dossier", href: "#proof", event: "open_dossier" }
};

const root = document.documentElement;
const tabs = [...document.querySelectorAll('[data-lens][role="tab"]')];
const hero = {
  label: document.querySelector('#campaign-label'),
  title: document.querySelector('#hero-title'),
  deck: document.querySelector('#hero-deck'),
  cta: document.querySelector('#hero-cta')
};

function recordEvent(name, detail = {}) {
  const event = { event: name, lens: root.dataset.lens, ...detail };
  window.dataLayer = window.dataLayer || [];
  window.dataLayer.push(event);
  window.dispatchEvent(new CustomEvent('jok:measurement', { detail: event }));
}

function setLens(id, updateUrl = true) {
  const lens = lenses[id] || lenses.A;
  root.dataset.lens = id in lenses ? id : 'A';
  tabs.forEach((tab) => tab.setAttribute('aria-selected', String(tab.dataset.lens === root.dataset.lens)));
  hero.label.textContent = lens.label;
  hero.title.innerHTML = lens.title;
  hero.deck.textContent = lens.deck;
  hero.cta.textContent = lens.cta;
  hero.cta.href = lens.href;
  hero.cta.dataset.event = lens.event;
  if (updateUrl) history.replaceState(null, '', '?lens=' + root.dataset.lens + location.hash);
  recordEvent('select_campaign_lens', { selected_lens: root.dataset.lens });
}

tabs.forEach((tab) => tab.addEventListener('click', () => setLens(tab.dataset.lens)));
document.querySelectorAll('[data-event]').forEach((link) => link.addEventListener('click', () => recordEvent(link.dataset.event, { destination: link.getAttribute('href') })));

document.querySelector('.menu-button').addEventListener('click', (event) => {
  const open = event.currentTarget.getAttribute('aria-expanded') === 'true';
  event.currentTarget.setAttribute('aria-expanded', String(!open));
  document.querySelector('#site-nav').classList.toggle('open', !open);
});

document.querySelector('#signal-form').addEventListener('submit', (event) => {
  event.preventDefault();
  document.querySelector('.form-status').textContent = 'Prototype confirmed. No information was sent or stored.';
  recordEvent('demo_signal_form_confirmed');
});

document.querySelector('#year').textContent = new Date().getFullYear();
const initialLens = new URLSearchParams(location.search).get('lens')?.toUpperCase() || 'A';
setLens(initialLens, false);
recordEvent('view_campaign_landing');
