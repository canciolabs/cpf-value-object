<?php

namespace CancioLabs\ValueObject\Cpf\Tests;

use CancioLabs\ValueObject\Cpf\Cpf;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{

    /**
     * @dataProvider invalidCpfDataProvider
     */
    public function testConstructorWhenCpfIsInvalid(string $invalidCPF): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Cpf($invalidCPF);
    }

    public static function invalidCpfDataProvider(): array
    {
        $testCases = [];

        // stringNotEmpty
        $testCases[] = [''];

        // regex
        $testCases[] = [' '];
        $testCases[] = ['abcdefghijk'];
        $testCases[] = ['182.488.530.04'];
        $testCases[] = ['182-488-530-04'];
        $testCases[] = ['182 488 530 04'];

        // 000.000.000-00, 111.111.111-11, ..., 999.999.999-99 are invalids
        $testCases[] = ['00000000000'];
        $testCases[] = ['11111111111'];
        $testCases[] = ['22222222222'];
        $testCases[] = ['33333333333'];
        $testCases[] = ['44444444444'];
        $testCases[] = ['55555555555'];
        $testCases[] = ['66666666666'];
        $testCases[] = ['77777777777'];
        $testCases[] = ['88888888888'];
        $testCases[] = ['99999999999'];
        $testCases[] = ['000.000.000-00'];
        $testCases[] = ['111.111.111-11'];
        $testCases[] = ['222.222.222-22'];
        $testCases[] = ['333.333.333-33'];
        $testCases[] = ['444.444.444-44'];
        $testCases[] = ['555.555.555-55'];
        $testCases[] = ['666.666.666-66'];
        $testCases[] = ['777.777.777-77'];
        $testCases[] = ['888.888.888-88'];
        $testCases[] = ['999.999.999-99'];

        // invalid digits
        // "000.269.140-00" is a valid.
        for ($i = 1; $i <= 99; $i++) {
            $testCases[] = ['000.269.140-' . substr('00' . $i, -2)];
        }

        return $testCases;
    }

    /**
     * @dataProvider validCpfDataProvider
     */
    public function testConstructorAndGetters(string $raw, string $formatted): void
    {
        $fromRaw = new Cpf($raw);
        $this->assertSame($raw, (string) $fromRaw);
        $this->assertSame($raw, $fromRaw->getRaw());
        $this->assertSame($formatted, $fromRaw->getFormatted());

        $fromFormatted = new Cpf($formatted);
        $this->assertSame($raw, (string) $fromFormatted);
        $this->assertSame($raw, $fromFormatted->getRaw());
        $this->assertSame($formatted, $fromFormatted->getFormatted());
    }

    public static function validCpfDataProvider(): array
    {
        $testCases = [];

        $testCases[] = [
            'raw' => '00026914000',
            'formatted' => '000.269.140-00',
        ];

        $testCases[] = [
            'raw' => '94537020059',
            'formatted' => '945.370.200-59',
        ];

        $testCases[] = [
            'raw' => '03303929050',
            'formatted' => '033.039.290-50',
        ];

        $testCases[] = [
            'raw' => '54745097077',
            'formatted' => '547.450.970-77',
        ];

        $testCases[] = [
            'raw' => '22657234011',
            'formatted' => '226.572.340-11',
        ];

        $testCases[] = [
            'raw' => '89423044000',
            'formatted' => '894.230.440-00',
        ];

        return $testCases;
    }

}