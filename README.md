# attentus WP

![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/attentus/attentus-wp?include_prereleases)
![Packagist Downloads](https://img.shields.io/packagist/dt/attentus/attentus-wp)
![GitHub](https://img.shields.io/github/license/attentus/attentus-wp)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/attentus/attentus-wp)
![GitHub last commit](https://img.shields.io/github/last-commit/attentus/attentus-wp)
![GitHub issues](https://img.shields.io/github/issues/attentus/attentus-wp)

**attentus WP** is a WordPress boilerplate based on [Bedrock](https://roots.io/bedrock/) by [roots.io](https://roots.io). It combines useful technologies that together provide a modern, easy-to-maintain, and performant base for WordPress projects of any kind. attentus WP includes:

* [Environment-based](https://symfony.com/components/Dotenv) development structure,
* Dependency manager [PHP Composer](https://getcomposer.org/) which manages all plugins and third-party software,
* [Timber](https://github.com/timber/timber), which integrates the [Twig Template Engine](https://twig.symfony.com/) in WordPress,
* [Gulp](https://gulpjs.com/) (in development),
* [Webpack](https://webpack.js.org/) (in development),
* and more.

## 📚 Documentation

You can find comprehensive developer documentation on [https://docs.attentus.com/attentus-wp/](https://wwww.attentus.com/attentus-wp/).

## ⚡️ Quick Start

1. Use `git clone https://gitlab.com/attentus/attentus-wp.git` or download the files a [.zip archive](https://gitlab.com/attentus/attentus-wp/-/archive/master/attentus-wp-master.zip).
2. `cd` into `attentus-wp`
3. Install Composer's dependencies via `composer install` and update them using `composer update`.
4. Open the **hidden** file `.env` in your project root directory and adjust the variables.

## ⚙️ Requirements

* PHP `8.0` (e.g. `brew install php@8.0`)
* [PHP Composer](https://getcomposer.org/download/) (e.g. `brew install composer`)
* MySQL

**Note:** Even though *attentus WP* is compatible with the latest PHP `8.1`, it is not recommended to use it since WordPress Core `5.9` still throws a lot of deprecated messages. Read the full documentation on how to suppress these PHP notices.

## ⛑ Support

Please direct your questions, feature requests, and bug findings at [GitLab's issue system](https://gitlab.com/attentus/intern/attentus-wp/-/issues) or send an [email](mailto:nolte@attentus.com).

## 🛠 Development

*attentus WP* is an in-house project which is actively being developed by [attentus Gesellschaft für Marketing und Kommunikation mbH](https://www.attentus.com/) and is subject to its terms of use.

### Current Developers:

* [Kolja Nolte](mailto:nolte@attentus.com) (lead developer)
* [Joachim Binnemann](mailto:binnemann@attentus.com) (developer)

**If you would like to contribute to this project, you are more than welcome! Just send a quick email and we hook you up on GitLab in no time.**

## ⚖️ License

See the file *LICENSE.md* in your project folder.
