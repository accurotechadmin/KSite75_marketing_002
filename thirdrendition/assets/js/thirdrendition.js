document.querySelectorAll('details.raw').forEach((block) => {
  const button = document.createElement('button');
  button.type = 'button';
  button.className = 'copy-raw';
  button.textContent = 'Copy JSON';
  button.addEventListener('click', () => navigator.clipboard?.writeText(block.querySelector('pre')?.textContent || ''));
  block.append(button);
});
