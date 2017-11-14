<?php

namespace Hiccup\MailChimpApi\Exception;

use Throwable;

final class InvalidParametersException extends \Exception
{

    /**
     * @param array $errors
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $errors, $code = 400, Throwable $previous = null)
    {
        parent::__construct($this->buildMessage($errors), $code, $previous);
    }

    /**
     * @param array $errors
     * @return string
     */
    private function buildMessage(array $errors): string
    {
        $listMessages = [];

        foreach ($errors as $parameter => $message) {
            $listMessages[] = sprintf('Parameter "%s" is "%s"', $parameter, $message);
        }

        return implode('. ', $listMessages);
    }
}
