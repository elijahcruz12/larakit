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

Most packages have flags to change the way they are installed. This includes flags that are built into how the package is installed itself. For example, breeze has a `--dark` flag to have dark mode support. That means that `make:breeze` has a `--dark` command. 

There are also some packages that have more than one version of it, like Cashier. For this we'll add a flag to switch between the two. So the `install:cashier` command has a `--paddle` flag to install the paddle version instead of the Stripe version.

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

If it looks like something people will want, you can create a PR for it. We recommend using the `make:installer` command, as it makes it uses it's own stub. Enter in the name of the package in all Lowercase, and only letters. This will allow the command to make the command in a simple way.
