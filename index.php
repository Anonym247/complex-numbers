<?php
declare(strict_types=1);

use Src\components as C;

require "src/bootstrap.php";

$firstNumber = new C\Complex(1, 2);
$secondNumber = new C\Complex(3, 4);

$operation = C\Operation::DIV;

$calculator = new C\Calculator($firstNumber, $secondNumber, $operation);

$result = $calculator->calculate();

$response = $firstNumber->expression . ' ' . $operation->value . ' ' . $secondNumber->expression;
$response .= ' = ' . $result;

print_r($response);
