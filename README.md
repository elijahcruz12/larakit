# Larakit

Larakit (Or Laravel Development Kit) is a Command Line tool that makes settings your Laravel project, or installing specific development tools (Like the Laravel-Debugbar), simple and easy.

Note that this tool only installed the latest versions of each package.

# Requirements

- PHP >= 8.1 (I'm Sorry)
- Composer >= 2.0

## Installation

Installing Larakit is as simple as a global require:

```
    composer global require elijahcruz/larakit
```

# Usage

## Installing Dev Packages

You can install packages like the Debugbar or Laravel-Ide-Helper simply be running it's `install` command:

```
    larakit install:<item>
```

## Currently installable packages

The list below is the packages you can currently install using Larakit:

- Laravel Breeze
- Laravel Cashier (Stripe and Paddle)
- Laravel Debugbar
- Laravel Dusk
- Laravel Horizon
- Laravel Ide-Helper
- Livewire

There will be more packages to come in the future.

## Contributing

Want to contribute by making an installer for another package?

First create an issue describing what you want to add to this package

If it looks like something people will want, you can create a PR for it. We recommend using the `make:installer` command, as it makes it uses it's own stub.
