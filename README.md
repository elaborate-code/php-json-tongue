# PHP JSON tongue

[![Packagist Version](https://img.shields.io/packagist/v/elaborate-code/php-json-tongue?label=Version&style=plastic)](https://packagist.org/packages/elaborate-code/php-json-tongue)
![Packagist Downloads](https://img.shields.io/packagist/dt/elaborate-code/php-json-tongue?label=Downloads&style=plastic)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elaborate-code/php-json-tongue/run-tests?label=Tests)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/run-tests.yml)
![Test Coverage](https://raw.githubusercontent.com/elaborate-code/php-json-tongue/main/badge-coverage.svg)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elaborate-code/php-json-tongue/Fix%20PHP%20code%20style%20issues?label=Code%20Style)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/fix-php-code-style-issues.yml)
<!-- [![run-tests](https://github.com/elaborate-code/php-json-tongue/actions/workflows/run-tests.yml/badge.svg)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/run-tests.yml) -->
<!-- [![Fix PHP code style issues](https://github.com/elaborate-code/php-json-tongue/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/fix-php-code-style-issues.yml) -->


A Facade for loading localization data from JSONs within a lang folder

## Get started

```text
composer require elaborate-code/php-json-tongue
```

## Usage

Set the file structure.

![illustration](illustration.png)

Then use the facade.

```php
use ElaborateCode\JsonTongue\TongueFacade;

$tongue = new TongueFacade('/lang');

$localization = $tongue->transcribe();
```

`$localization` will look like:

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

## Changelog

<!-- Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently. -->

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
