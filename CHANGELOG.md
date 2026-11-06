# Changelog

All notable changes to this project will be documented in this file.

## [0.6.0]
Added
- GitHub Actions workflow (`.github/workflows/ci.yml`) running all checks on PHP 8.1, 8.2, 8.3, 8.4 and 8.5 (uses Node 24 based `actions/checkout@v6` and `actions/setup-python@v6`)
- `.github/CODEOWNERS` – repository owner is requested as reviewer on every pull request
- `AGENTS.md` with project guidance for AI coding agents
- Status badges in `README.md` (CI, version, PHP version, downloads, license, PHPStan, Psalm)
- `PHP_VERSION` build argument in `docker-compose.yaml`, so `PHP_VERSION=8.4 bin/ci.py` really runs the checks on the chosen PHP version
- `UID`/`GID` build arguments in `docker-compose.yaml` so the container user matches the host user (needed on CI runners)

Changed
- Supported PHP versions are now 8.1 – 8.5 (`"php": ">=8.1 <8.6"`); PHP 8.0 is no longer supported
- `#[\Override]` attribute added to methods that implement an interface (Psalm `MissingOverrideAttribute`)
- `DefaultAccessor` constructor properties are `readonly` (Rector)

Fixed
- PHPStan (level max): `$class` parameter of `PropertyAccessInterface::setValue()` / `getValue()` is now typed as `class-string`
- Psalm (level 2) reports no errors
- All checks (phpunit, phpstan, psalm, rector, php-cs-fixer, composer-unused) pass on PHP 8.1 – 8.5

## [0.5.2]
Added
- Continuous Integration
- Unit tests for 100% coverage

## [0.5.1]
Added
- Changelog

## [0.5.0]
Initial version