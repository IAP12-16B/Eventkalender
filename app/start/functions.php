<?php

function formatCurrency($price)
{
    return number_format(round($price * 20) / 20, 2, '.', '\'');
}