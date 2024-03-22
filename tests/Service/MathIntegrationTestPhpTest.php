<?php

namespace App\Tests\Service;

use App\Service\Math;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MathIntegrationTestPhpTest extends KernelTestCase
{
    public function dataAdd(): array
    {
        $data = [
            '2 + 2 = 4' => [2, 2, 4],
            '0 + 2 = 2' => [0, 2, 2],
            '-1 + 5 = 4' => [-1, 5, 4],
            '0 + 0 = 0' => [0, 0, 0],
            '-2 + -2 = -4' => [-2, -2, -4],
            '88 + 12 = 100' => [88, 12, 100],
        ];

        return $data;
    }
    

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($a, $b, $expectedResult): void
    {
        $kernel = self::bootKernel();

        $container = static::getContainer();

        $math = $container->get(Math::class);

        $result = $math->add($a,$b);

        $this->assertEquals($expectedResult, $result);
    }
}
