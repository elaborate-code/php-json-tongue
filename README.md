# PHP JSON tongue

![Packagist Version](https://img.shields.io/packagist/v/elaborate-code/php-json-tongue?label=Version&style=plastic)
![Packagist Downloads](https://img.shields.io/packagist/dt/elaborate-code/php-json-tongue?label=Downloads&style=plastic)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elaborate-code/php-json-tongue/run-tests?label=Tests)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/run-tests.yml)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elaborate-code/php-json-tongue/Fix%20PHP%20code%20style%20issues?label=Code%20Style)](https://github.com/elaborate-code/php-json-tongue/actions/workflows/fix-php-code-style-issues.yml)


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

![transcribed](transcribed.png)

