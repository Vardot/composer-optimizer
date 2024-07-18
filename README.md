> # Composer Optimizer
> [Composer](https://getcomposer.org) plugin for removing development files and more upcoming.

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

## Installation
- Add repository
- Install package
- Trust/Allow the plugin
- Configure it according to [documentation](docs)

### Sample composer.json file
```json
{
    "name": "org/name",
    "repositories": {
        "composer-optimizer": {
            "type": "vcs",
            "url": "git@github.com:Vardot/composer-optimizer.git"
        }
    },
    "require": {
        "vardot/composer-optimizer": "^1.0@dev"
    },
    "config": {
        "vardot/composer-optimizer": {
            "clear": {
                "*" : "[docs]"
            }
        },
        "allow-plugins": {
            "vardot/composer-optimizer": true
        }
    },
    "extra": {
        "dev-files": {
            "docs": [
                "LICENSE.txt",
                "README.txt",
                "CHANGELOG.txt"
            ]
        }
    }
}
```


## Development

```bash
$ git clone git@github.com:<your github account>/composer-optimizer.git
$ cd cleaner && composer install
$ git remote add upstream git@github.com:vardot/composer-optimizer.git
```

## Notes

- Tested on PHP 5.3, 5.4, 5.5, 5.6, 7.0, 7.1, 7.2, 8.1
