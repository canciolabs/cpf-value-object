<?php

namespace CancioLabs\ValueObject\Cpf;

use function CancioLabs\Functions\Cpf\assert_cpf;

class Cpf
{

    private string $cpf;

    public function __construct(string $cpf)
    {
        assert_cpf($cpf);

        $this->cpf = preg_replace('/\D/', '', $cpf);
    }

    public function __toString(): string
    {
        return $this->getRaw();
    }

    public function getRaw(): string
    {
        return $this->cpf;
    }

    public function getFormatted(): string
    {
        return sprintf(
            '%s.%s.%s-%s',
            substr($this->cpf, 0, 3),
            substr($this->cpf, 3, 3),
            substr($this->cpf, 6, 3),
            substr($this->cpf, 9, 2)
        );
    }

}