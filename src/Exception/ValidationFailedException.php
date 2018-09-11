<?php

namespace Hiccup\MailChimpApi\Exception;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationFailedException extends \RuntimeException
{

    /**
     * @var ConstraintViolationListInterface
     */
    private $violationList;

    /**
     * @param string $name
     * @param ConstraintViolationListInterface $violationList
     */
    public function __construct(string $name, ConstraintViolationListInterface $violationList)
    {
        $this->violationList = $violationList;

        parent::__construct(
            sprintf(
                'Validation failed for "%s" with errors: {%s}',
                $name,
                $this->getViolationListString()
            )
        );
    }

    public function getViolationListString(): string
    {
        $violationStrings = [];

        foreach ($this->violationList as $violation) {
            /** @var ConstraintViolationInterface $violation  */
            array_push(
                $violationStrings,
                sprintf('%s: %s', $violation->getPropertyPath(), $violation->getMessage())
            );
        }

        return implode(', ', $violationStrings);
    }
}
