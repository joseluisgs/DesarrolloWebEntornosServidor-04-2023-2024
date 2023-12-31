<?php

use Calculator\Calculator;
use Calculator\TaxCalculator;
use PHPUnit\Framework\TestCase;

class TaxCalculatorTest extends TestCase
{
    public function testCalculateTax()
    {
        // Crear un mock para la clase Calculator.
        $calculatorMock = $this->createMock(Calculator::class);

        // Configurar el mock para que, cuando se llame al método add con ciertos valores,
        // se devuelva un valor específico.
        $calculatorMock->expects($this->once())
            ->method('add')
            ->with(100, 10) // Supongamos que $amount es 100 y el impuesto calculado es 10.
            ->willReturn(110);

        // Crear una instancia de TaxCalculator con el mock de Calculator y un porcentaje de impuesto.
        $taxRate = 10; // 10% de impuesto
        $taxCalculator = new TaxCalculator($calculatorMock, $taxRate);

        // Llamar al método calculateTax y verificar que el resultado es el esperado.
        $amount = 100; // Cantidad base
        $result = $taxCalculator->calculateTax($amount);
        $expectedResult = 110; // Cantidad base + impuesto

        $this->assertEquals($expectedResult, $result);
    }
}