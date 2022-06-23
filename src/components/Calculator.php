<?php
declare(strict_types=1);

namespace Src\components;

final class Calculator
{
    /**
     * @param Complex $firstNumber
     * @param Complex $secondNumber
     * @param Operation $operation
     */
    public function __construct(
        private Complex $firstNumber,
        private Complex $secondNumber,
        private Operation $operation
    ) {}

    /**
     * @return string
     */
    public function calculate(): string
    {
        return match ($this->operation) {
            Operation::SUM => $this->add(),
            Operation::SUB => $this->subtract(),
            Operation::DIV => $this->divide(),
            Operation::MUL => $this->multiply(),
        };
    }

    /**
     * @return string
     */
    private function add(): string
    {
        $realComponent = $this->firstNumber->realComponent + $this->secondNumber->realComponent;
        $imaginaryComponent = $this->firstNumber->imaginaryComponent + $this->secondNumber->imaginaryComponent;

        $result = new Complex($realComponent, $imaginaryComponent);

        return $result->expression;
    }

    /**
     * @return string
     */
    private function subtract(): string
    {
        $realComponent = $this->firstNumber->realComponent - $this->secondNumber->realComponent;
        $imaginaryComponent = $this->firstNumber->imaginaryComponent - $this->secondNumber->imaginaryComponent;

        $result = new Complex($realComponent, $imaginaryComponent);

        return $result->expression;
    }

    /**
     * @return string
     */
    private function multiply(): string
    {
        $realComponent =
            ($this->firstNumber->realComponent * $this->secondNumber->realComponent)
            - ($this->firstNumber->imaginaryComponent * $this->secondNumber->imaginaryComponent);

        $imaginaryComponent =
            ($this->firstNumber->imaginaryComponent * $this->secondNumber->realComponent)
            + ($this->firstNumber->realComponent * $this->secondNumber->imaginaryComponent);

        $result = new Complex($realComponent, $imaginaryComponent);

        return $result->expression;
    }

    /**
     * @return string
     */
    private function divide(): string
    {
        $denominator =
            (pow($this->secondNumber->realComponent, 2))
            + (pow($this->secondNumber->imaginaryComponent, 2));

        $realComponent =
            (
                ($this->firstNumber->realComponent * $this->secondNumber->realComponent)
                + ($this->firstNumber->imaginaryComponent * $this->secondNumber->imaginaryComponent)
            ) / $denominator;

        $imaginaryComponent =
            (
                ($this->firstNumber->imaginaryComponent * $this->secondNumber->realComponent)
                - ($this->firstNumber->realComponent * $this->secondNumber->imaginaryComponent)
            ) / $denominator;

        $result = new Complex($realComponent, $imaginaryComponent);

        return $result->expression;
    }
}
