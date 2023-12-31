<?php

namespace Calculator;

class TaxCalculator
{
    private $calculator;
    private $taxRate;

    public function __construct(Calculator $calculator, $taxRate)
    {
        $this->calculator = $calculator;
        $this->taxRate = $taxRate;
    }

    public function calculateTax($amount)
    {
        $tax = $amount * ($this->taxRate / 100);
        return $this->calculator->add($amount, $tax);
    }
}