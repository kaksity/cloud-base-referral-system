<?php

use Carbon\Carbon;

function formatDateTime($dateTime)
{
    return Carbon::parse($dateTime)->format('M j, Y g:ia');
}

function formatDate($date)
{
    return Carbon::parse($date)->format('M j, Y');
}

function generatePayrollPeriod()
{
    $today = now();

    return "{$today->monthName} {$today->year}";
}

function generatePayrollBonusPayoutPeriod($payoutMonth)
{
    $carbonDate = Carbon::createFromDate(Carbon::now()->year, $payoutMonth, 1);

    return $carbonDate->format('F Y');
}
