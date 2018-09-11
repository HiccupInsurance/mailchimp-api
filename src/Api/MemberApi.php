<?php

namespace Hiccup\MailChimpApi\Api;

use GuzzleHttp\RequestOptions;
use Hiccup\MailChimpApi\MailChimpClient;
use Hiccup\MailChimpApi\Model\Member;
use Hiccup\MailChimpApi\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * List of Member API.
 * The methods name should follow the intent, e.g: subscribe(), unsubscribe()
 * @see https://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/
 */
final class MemberApi
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var MailChimpClient
     */
    private $client;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param MailChimpClient $client
     */
    public function __construct(MailChimpClient $client)
    {
        $this->client = $client;
        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * Subscribe a member
     *
     * @param string $listId
     * @param Member $member
     * @return Member
     * @throws ValidationFailedException
     */
    public function subscribe(string $listId, Member $member): Member
    {
        $errors = $this->validator->validate($member);

        if (count($errors) > 0) {
            throw new ValidationFailedException(get_class($member), $errors);
        }

        $response = $this->client->put(
            sprintf(
                '/%s/lists/%s/members/%s',
                MailChimpClient::VERSION,
                $listId,
                md5($member->getEmailAddress())
            ),
            [RequestOptions::JSON => $parameters]
        );

        return $member;
    }
}
