<?php

/**
 * Format the amount in decimal
 * into Indian currency
 * @param  decimal $amount
 * @return string
 *
 * @author Daksh Mehta <dm@rimail.in>
 */
if (!function_exists('currency')) {

    function currency($amount)
    {
        if ($amount != null) {
            return '&#x20b9; ' . number_format($amount, 2) . '/-';
        } else {
            return '&#x20b9; ' . number_format(0, 2) . '/-';
        }
    }
}
