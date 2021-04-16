<?php

declare(strict_types=1);

namespace Pama\Funcs;

/**
 * Functions.
 */


/**
 * Keep track of rounds of 21
 * @return void
 *
 */
function recordWinner(string $winner): void
{
    if ($_SESSION["rounds"][$winner] ?? false) {
        $_SESSION["rounds"][$winner] += 1;
    } else {
        $_SESSION["rounds"][$winner] = 1;
    }
}
