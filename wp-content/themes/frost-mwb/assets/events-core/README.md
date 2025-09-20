# Sass

Contains SASS that is for every event brand specifically, as in, not including Midwest Burners Organization site. Brand specific SASS will be found in `../brands`.

## Architecture

```

events-core/                                   # Contains all sass for every event but not the main MWB site.
├── overrides/                                 # Overrides default styles of wordpress or plugins.
│   ├── _gb.scss                               # Overrides default generate blocks styles.
│   ├── _overrides.scss                        # Helper for overrides folder.
│   └── _wp.scss                               # Overrides default wordpress styles.

```
