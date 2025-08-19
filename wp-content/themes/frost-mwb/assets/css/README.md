# CSS Build Process

This directory contains the SCSS source files and compiled CSS output for the Frost MWB theme.

## Project Structure

```
assets/css/
├── _style.scss             # Main SCSS entry point
├── brands/                 # Brand-specific styles
│   └── brandIF/           # Brand Identity Framework
│       └── sass/
│           ├── tokens/     # Color tokens
│           └── mixins/     # Brand mixins
├── core/                   # Core design system
│   └── tokens/            # Design tokens (sizing, etc.)
├── events-core/            # Event-specific styles
│   └── overrides/         # WordPress & Gutenberg overrides
├── style-output.css        # Compiled CSS output
└── README.md               # This file
```

## Build Process

### 1. Installation

```bash
# Navigate to theme directory
cd wp-content/themes/frost-mwb

# Install dependencies
npm install
```

### 2. Development

The SCSS files are organized into logical modules:

- **Core**: Design tokens and foundational styles
- **Brands**: Brand-specific colors, typography, and mixins
- **Events Core**: Event-specific styles and WordPress overrides

### 3. Building

```bash
# Build CSS from SCSS
npm run build

# Or for development with watch mode
npm run dev
```

### 4. Output

The build process compiles all SCSS files into a single `style-output.css` file that includes:

- Core design tokens and sizing
- Brand identity framework (colors, mixins)
- Event-specific styles
- WordPress and Gutenberg overrides

## File Dependencies

The main `_style.scss` file imports all modules in the correct order:

1. Core design tokens (sizing)
2. Brand tokens and mixins
3. Event core overrides

## Notes

- All SCSS files use the `@import` directive for modular organization
- The compiled CSS is automatically generated and should not be edited directly
- Make changes to the SCSS source files and rebuild to see updates