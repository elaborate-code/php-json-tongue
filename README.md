# PHP JSON tongue

[![Packagist Version](https://img.shields.io/packagist/v/elaborate-code/php-json-tongue?label=Version&style=plastic)](https://packagist.org/packages/elaborate-code/php-json-tongue)
![Packagist Downloads](https://img.shields.io/packagist/dt/elaborate-code/php-json-tongue?label=Downloads&style=plastic)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elaborate-code/php-json-tongue/run-tests?label=Tests)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/run-tests.yml)
![Test Coverage](https://raw.githubusercontent.com/elaborate-code/php-json-tongue/main/badge-coverage.svg)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elaborate-code/php-json-tongue/Fix%20PHP%20code%20style%20issues?label=Code%20Style)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/fix-php-code-style-issues.yml)
![maintained](https://img.shields.io/maintenance/yes/2022)

<!-- [![run-tests](https://github.com/elaborate-code/php-json-tongue/actions/workflows/run-tests.yml/badge.svg)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/run-tests.yml) -->
<!-- [![Fix PHP code style issues](https://github.com/elaborate-code/php-json-tongue/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/fix-php-code-style-issues.yml) -->

A Façade for loading localization data from a folder tree of JSON files.

## Get started

Install the package with composer:

```text
composer require elaborate-code/php-json-tongue
```

Requirements:

-   PHP 8.0 or higher

## Usage

Set the file structure.

![illustration](illustration.png)

Then use the facade.

```php
use ElaborateCode\JsonTongue\TongueFacade;

$tongue = new TongueFacade('/lang');

$localization = $tongue->transcribe();
```

`$localization` will be set like:

```php
$localization = [
    "es" => [
        "programmer" => "programador",
        "interviewer" => "entrevistador",
        "Hello" => "Hola",
        "Good morning" => "buenos dias",
        //...
    ],
    "fr" => [
        "Hello" => "Salut",
        "Good morning" => "Bonjour",
        //...
    ]
    //...
];
```

## Testing

```bash
vendor/bin/pest
```

### JSON Faker

Just like when testing Laravel apps, we populate the database temporarily and use the `RefreshDatabase` trait to rollback the database to its fresh state.

This package ships with `ElaborateCode\JsonTongue\JsonFaker\JsonFaker` class that helps create a temporary tree of **locale folders** and **JSON files** filled with translations.

Here is an example:

```php
$json_faker = JsonFaker::make()
    ->addLocale('ar', [
        'ar.json' => [],
    ])
    ->addLocale('en', [
        'en.json' => [
            'en' => 'en',
            "I know. They're both good. It's hard to decide. McCain is older but he has more experience. Obama seems to have a lot of good ideas, but some people say he wants to raise taxes." => 'Lo sé. Ambos son buenos. Es difícil decidir. McCain es mayor pero tiene más experiencia. Obama parece tener muchas buenas ideas, pero algunas personas dicen que quiere aumentar los impuestos.',
        ],
        'one.json' => [
            'one' => 'one',
        ],
        'two.json' => [
            'two' => 'two',
        ],
    ])
    ->addLocale('multi', [
        'greetings.json' => [
            'en' => [
                'Hello' => 'Hello',
            ],
            'fr' => [
                'Hello' => 'Salut',
            ],
        ],
    ])
    ->write();

// Assert

$json_faker->rollback(); // Delete the complete file structure created for the test
```

> This class can help make tests when contributing on this package or when using this package.

## Changelog

<!-- Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently. -->

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
