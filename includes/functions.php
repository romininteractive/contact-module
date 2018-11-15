<?php

/**
 * Format the amount in decimal
 * into Indian currency
 * @param  decimal $amount
 * @return string
 *
 * @author Daksh Mehta <dm@rimail.in>
 */
function currency($amount)
{
	return '&#x20b9; '.number_format($amount, 2).'/-';
}