# Sass

Contains

## Architecture

```
sass/                                   #
├── abstracts/                          #
│   ├── _colors.scss                    # Primitive color tokens.
│   ├── _mixins.scss                    #
│   ├── _sizing.scss                    # Primitive and semantic size variable tokens.
│   └── helpers.scss                    # Forwards all abstract files to 
├── base/                               #
├── components/                         #
├── layout/                             #
│   ├── _customContainers.scss          #
│   └── _header.scss                    #
├── overrides/                          #
│   ├── _gbOverrides.scss               # Overrides for Generate Blocks plugin default styles.
│   └── _wpOverrides.scss               # Overrides for Wordpress default styles.
├── pages/                              # Styles that are unique to specific pages and there only.
│   ├── _home_.scss                     # Homepage styles.
│   └── _principles.scss                # Principles page styles.
└── vendors/                            #

```