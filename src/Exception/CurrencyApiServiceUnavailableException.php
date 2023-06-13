<?php declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

class CurrencyApiServiceUnavailableException extends RuntimeException
{
    protected $message = 'Could not connect to Currency API service!';
}
