<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Calculator.php';

class CalculatorTest extends TestCase
{
    public function testAddition()
    {
        $calculator = new Calculator();

        $this->assertEquals(
            4,
            $calculator->add(2, 2)
        );
    }
}