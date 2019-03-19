# Vinder

[![Total Downloads](https://img.shields.io/packagist/dt/tregor/vinder.svg?style=flat-square)](https://packagist.org/packages/tregor/vinder)
[![GitHub Version](https://img.shields.io/github/tag/tregor/Vinder.svg?style=flat-square)](https://github.com/tregor/Vinder)
[![Last Commit](https://img.shields.io/github/last-commit/tregor/Vinder.svg?style=flat-square)](https://github.com/tregor/Vinder)
[![PHP Req](https://img.shields.io/packagist/php-v/tregor/vinder.svg?style=flat-square)](https://packagist.org/packages/tregor/vinder)
[![License](https://img.shields.io/github/license/tregor/Vinder.svg?style=flat-square)](LICENSE)

**Vinder** is a free and lightweight template based engine for PHP!

You can use it as example in small projects, where there is no reasons to use another some template engines, like Smarty.
Becouse of lightweight code and new improvement features, **Vinder** is a good solutions for devs all over the world!

---
## Navigation
- [Requirements](#requirements)
- [Installation](#installation)
- [Quick Start](#quick-start-and-usage)
- [Documentation](#documentation)
- [TODO](#todo)
- [Contribute](#contribute)
- [License](#license)
- [Copyright](#copyright)

---

## Requirements

This library is supported by **PHP versions 5.4** or higher.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **Vinder library**, simply:

    $ composer require tregor/vinder

You can also **clone the complete repository** with Git:

    $ git clone https://github.com/treggor/Vinder.git

Or **install it manually**:

[Download Vinder.php](https://github.com/tregor/Vinder/archive/master.zip):

    $ wget https://github.com/tregor/Vinder/archive/master.zip

## Quick Start and Usage

To use this class with **Composer**:
```php
require __DIR__ . '/vendor/autoload.php';
use tregor\Vinder;
```

Or If you installed it **manually**, use it:
```php
require_once __DIR__ . '/Vinder.php';
use tregor\Vinder;
```

After it you can do any your code, and than, create new Vinder object, provide template name, data array (that will be converted to vars) and optionaly set parsePHP flag (default - FALSE)
```php
$data = [
    "foo" => "bar",
    "greetings" => "Hello, Vinder!",
];
new Vinder("main", $data, TRUE);
```

Second file you will need is a template. For this example it will be:
```html
<p style="text-align: center"><!$greetings!></p>
<!$foo!>
```
And, after compilation and rendering you will get the same output:
```html
<p style="text-align: center">Hello, Vinder!</p>
bar
```


## Documentation
Full documentation for Vinder you can find at [wiki home page!](https://github.com/tregor/Vinder/wiki)

## TODO

- [ ] Static usement of Vinder class.
- [ ] Make more settings.
- [ ] Add IF/IFELSE conditions.
- [ ] Add FOREACH, WHILE and other cycles.
- [ ] Become cooler than Smarty.
- [ ] Add tests.

## Contribute

If you would like to help, please take a look at the list of
[issues](https://github.com/tregor/Vinder/issues) or the [ToDo](#todo) checklist.

**Pull requests**

* [Fork and clone](https://help.github.com/articles/fork-a-repo).
* Run the **tests**.
* Create a **branch**, **commit**, **push** and send me a [pull request](https://help.github.com/articles/using-pull-requests).

## License

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.

## Copyright

By tregor 2019

Please let me know, if you have feedback or suggestions.

You can contact me on [Facebook](https://www.facebook.com/tregor1997) or through my [email](mailto:tregor1997@gmail.com).