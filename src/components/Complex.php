<?php
declare(strict_types=1);

namespace Src\components;

final class Complex
{
    /**
     * @var string
     */
    private string $expression;

    /**
     * @param float $realComponent
     * @param float $imaginaryComponent
     */
    public function __construct(private float $realComponent, private float $imaginaryComponent)
    {
        $this->expression = $this->toExpression();
    }

    /**
     * @param string $propertyName
     * @return mixed
     */
    public function __get(string $propertyName): mixed
    {
        return $this->$propertyName;
    }

    /**
     * @return string
     */
    private function toExpression(): string
    {
        $isRealComponentUnsigned = ($this->realComponent > 0);
        $isImaginaryComponentUnsigned = ($this->imaginaryComponent > 0);

        if (empty($this->realComponent)) {
            return
                ($isImaginaryComponentUnsigned ? '' : '(-')
                . abs($this->imaginaryComponent)
                . 'i'
                . ($isImaginaryComponentUnsigned ? '' : ')');
        } else if (empty($this->imaginaryComponent)) {
            return
                ($isImaginaryComponentUnsigned ? '' : '(-')
                . abs($this->realComponent)
                . ($isImaginaryComponentUnsigned ? '' : ')');
        }

        return
            '('
            . ($isRealComponentUnsigned ? '' : '-')
            . abs($this->realComponent)
            . ($isImaginaryComponentUnsigned ? ' + ' : ' - ')
            . abs($this->imaginaryComponent)
            . 'i)';
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        $isComplex = empty(!$this->imaginaryComponent);

        $struct = [
            'type' => 'numeric',
            'real' => $this->realComponent,
        ];

        if ($isComplex) {
            $struct['type'] = 'complex';
            $struct['imaginary'] = $this->imaginaryComponent;
        }

        return json_encode($struct);
    }
}
