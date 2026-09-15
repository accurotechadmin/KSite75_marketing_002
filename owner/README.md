# Owner Site Scaffold

This directory contains a vanilla PHP/HTML/CSS/JS scaffold for the private Just One KISS owner command center.

## Structure

- `index.php` routes to each owner module by `?page=`.
- `config/site.php` stores site-level configuration.
- `data/*.php` stores reusable generic template data.
- `includes/*.php` contains bootstrapping and helper functions.
- `partials/*.php` contains shared shell and component renderers.
- `pages/*.php` contains each remixable owner-site module.
- `assets/css/owner.css` defines theme tokens and component styles.
- `assets/js/owner.js` contains small progressive-enhancement hooks.

## Design Rule

Modules should stay data-first and component-based. Restyle CSS variables, replace PHP arrays with a future database/API, or rearrange partials without rebuilding each module from scratch.
