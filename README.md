# CPF Value Object

This tiny package contains a class that represents a CPF (Brazilian ID).

## Requirements

PHP 7.4 or greater is required, nothing else.

## Installation

    composer require cancio-labs/cpf-value-object

## How to use it

```
use CancioLabs\ValueObject\Cpf\Cpf;

$cpf = new Cpf('170.317.330-90'); // or '17031733090'
echo $cpf; // outputs 17031733090
echo $cpf->getRaw(); // outputs 17031733090
echo $cpf->getFormatted(); // outputs 170.317.330-90
```

The CPF class will validate the given string and throw an exception if it's not a valid CPF.

## Running Tests

- From the project root, run: `vendor/bin/phpunit .`