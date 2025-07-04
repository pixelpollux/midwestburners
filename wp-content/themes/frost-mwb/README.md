# Frost MWB Theme - Build Process

This is a custom WordPress theme based on the Frost theme, with a SCSS build process for enhanced CSS development.

## 🚀 Quick Start

### Prerequisites

- Node.js (version 14 or higher)
- npm (comes with Node.js)

### Installation

1. Navigate to the theme directory:

   ```bash
   cd wp-content/themes/frost-mwb
   ```

2. Install dependencies:

   ```bash
   npm install
   ```

## 📁 File Structure

```
frost-mwb/
├── assets/
│   ├── scss/
│   │   └── style.scss          # Main SCSS entry point
│   ├── css/
│   │   └── style.css           # Compiled CSS output
│   ├── images/                 # Theme images
│   └── fonts/                  # Custom fonts
├── functions.php               # WordPress functions (enqueues compiled CSS)
├── package.json                # Build configuration
├── package-lock.json           # Dependency lock file
└── README.md                   # This file
```

## 🛠️ Build Commands

### Development

Watch for SCSS changes and auto-compile:

```bash
npm run watch:css
```

### Production

One-time compilation:

```bash
npm run build:css
```

## 📝 SCSS Development

### Main Entry Point

The main SCSS file is located at `assets/scss/style.scss`. This is where you should add your custom styles.

### Example SCSS Structure

```scss
// Variables
$primary-color: #007cba;
$secondary-color: #005a87;

// Mixins
@mixin button-style {
  padding: 10px 20px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
}

// Component styles
.custom-button {
  @include button-style;
  background-color: $primary-color;
  color: white;

  &:hover {
    background-color: $secondary-color;
  }
}
```

## 🔧 Configuration

### package.json Scripts

- `build:css`: Compiles SCSS to CSS without source maps
- `watch:css`: Watches SCSS files and auto-compiles on changes

### SCSS Compilation

The build process uses **Dart Sass** for compilation:

- **Input**: `assets/scss/style.scss`
- **Output**: `assets/css/style.css`
- **Source Maps**: Disabled for production
- **Watch Mode**: Available for development

## 🎯 WordPress Integration

### CSS Enqueuing

The compiled CSS is automatically enqueued in `functions.php`:

```php
function frost_child_enqueue_styles() {
  wp_enqueue_style(
    'frost-child-style',
    get_stylesheet_directory_uri() . '/assets/css/style.css',
    [],
    filemtime( get_stylesheet_directory() . '/assets/css/style.css' )
  );
}
add_action( 'wp_enqueue_scripts', 'frost_child_enqueue_styles', 20 );
```

### Version Control

The CSS file uses `filemtime()` for cache busting, ensuring changes are immediately visible.

## 🚨 Important Notes

### Development Workflow

1. **Never edit** `assets/css/style.css` directly
2. **Always edit** `assets/scss/style.scss` for custom styles
3. Run `npm run watch:css` during development
4. Run `npm run build:css` before deployment

### Git Ignore

The `.gitignore` file excludes:

- `node_modules/` (dependencies)
- `package-lock.json` (dependency lock file)

### Dependencies

- **sass**: Dart Sass compiler for SCSS processing

## 🔄 Updating Dependencies

To update the Sass compiler:

```bash
npm update sass
```

## 🐛 Troubleshooting

### Common Issues

**Build fails with "command not found"**

- Ensure Node.js and npm are installed
- Run `npm install` to install dependencies

**CSS changes not appearing**

- Check that `npm run watch:css` is running
- Verify the SCSS file is being saved
- Clear browser cache

**WordPress not loading new styles**

- Check that `functions.php` is properly enqueuing the CSS
- Verify the file path in the enqueue function

## 📚 Resources

- [Sass Documentation](https://sass-lang.com/documentation)
- [WordPress Theme Development](https://developer.wordpress.org/themes/)
- [Frost Theme Documentation](https://frostwp.com/)

## 🤝 Contributing

When making changes to the theme:

1. Edit SCSS files in `assets/scss/`
2. Test changes with `npm run watch:css`
3. Build for production with `npm run build:css`
4. Commit both SCSS and compiled CSS files

---

**Note**: This theme is a detached copy of the Frost parent theme and does not receive automatic updates.