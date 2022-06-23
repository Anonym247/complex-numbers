<?php
declare(strict_types=1);

namespace Src\components;

enum Operation: string
{
    case SUM = '+';
    case SUB = '-';
    case DIV = '/';
    case MUL = '*';
}
