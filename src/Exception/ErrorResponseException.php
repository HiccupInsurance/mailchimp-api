<?php

namespace HiccupApi\Exception;

use HiccupApi\Model\ErrorResponse;

class ErrorResponseException extends \RuntimeException
{

    public function __construct(ErrorResponse $errorResponse) {
        parent::__construct(sprintf(
            'Failed '
        ));
    }
}
