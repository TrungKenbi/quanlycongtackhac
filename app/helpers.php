<?php
/**
 * Copyright (c) 2019 TrungKenbi
 */

use MathParser\Interpreting\Evaluator;
use MathParser\StdMathParser;

/**
 * Tính điểm công tác
 *
 * @return float
 */
if (!function_exists('pointCalculation'))
{
    function pointCalculation($formula, $norm, $count)
    {
        $formulaHandle = str_replace('{norm}', $norm, $formula);
        $formulaHandle = str_replace('{count}', $count, $formulaHandle);
        $parser = new StdMathParser();
        $AST = $parser->parse($formulaHandle);
        $evaluator = new Evaluator();
        $value = $AST->accept($evaluator);
        return $value;
    }
}
