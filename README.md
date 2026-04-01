# AR Theme

**Author:** Amin Rahnama  
**Website:** https://mypixellab.com  

---

## Overview

AR Theme is a custom WordPress theme built with a modular architecture for flexibility, scalability, and clean development workflows. It includes responsive headers, dynamic customization options, reusable template parts, and structured asset management.

This theme is ideal for agency websites, client projects, portfolios, and content-driven platforms.

---

## Features

- Modular theme structure (`inc/` based architecture)
- Responsive desktop and mobile headers
- Transparent header support
- Mobile overlay & off-canvas navigation
- Hero slider system
- WordPress Customizer integration
- Dynamic color system
- Sidebar & widget-ready areas
- Ajax search support
- Custom page templates
- Reusable template parts
- Theme JSON support
- Organized CSS & JavaScript assets

---

## Folder Structure

```text
ar-theme/
├── 404.php
├── assets/
│   ├── css/
│   │   ├── bootdtrap-align.css
│   │   └── main.css
│   └── js/
│       ├── hero-swiper.js
│       └── main.js
├── comments.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── inc/
│   ├── ajax-search.php
│   ├── block-styles.php
│   ├── comments-callback.php
│   ├── customizer.php
│   ├── edit-dynamic-colors.php
│   ├── enqueue.php
│   ├── filters.php
│   ├── hero-slider.php
│   ├── layout/
│   │   └── settings/
│   │       └── full-width.css
│   ├── logo-switcher.php
│   ├── mim-types.php
│   ├── query-mods.php
│   ├── setup.php
│   ├── sidebars.php
│   ├── templates-tags.php
│   ├── theme-colors.php
│   └── widgets/
│       ├── recents-posts.widget.php
│       ├── serach-widget.php
│       ├── top-bar-dynamic-css.php
│       └── top-bar-widgets.php
├── index.php
├── page-blank-full.php
├── page-blank.php
├── page-contact.php
├── screenshot.png
├── serach.php
├── single.php
├── style.css
├── template-parts/
│   ├── content-none.php
│   ├── footers/
│   │   └── footer-default.php
│   ├── headers/
│   │   ├── header-desktop.php
│   │   ├── header-mobile.php
│   │   └── header-transparent.php
│   ├── menus/
│   │   ├── mobile-overlay.php
│   │   └── offcanvas-mobile.php
│   └── serachform.php
└── theme.json
