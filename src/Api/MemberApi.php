<?php

namespace Hiccup\MailChimpApi\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Hiccup\MailChimpApi\MailChimpConfig;
use Hiccup\MailChimpApi\Model\Member;
use Hiccup\MailChimpApi\Exception\ValidationFailedException;
use JMS\Serializer\SerializerInterface;
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
     * @var Client
     */
    private $client;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param MailChimpConfig $config
     */
    public function __construct(MailChimpConfig $config)
    {
        $this->client = $config->getClient();
        $this->validator = $config->getValidator();
        $this->serializer = $config->getSerializer();
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
     * @throws ClientException
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
                MailChimpConfig::VERSION,
                $listId,
                md5(strtolower($member->getEmailAddress()))
            ),
            [
                'body' => $this->serializer->serialize($member, 'json')
            ]
        );

        /** @var $successResponse Member */
        $successResponse = $this->serializer->deserialize((string) $response->getBody(), Member::class, 'json');

        return $successResponse;
    }

    /**
     * Get Subscribed member info
     *
     * @param string $listId
     * @param Member $member
     * @return Member
     * @throws ValidationFailedException
     * @throws ClientException
     */
    public function reSubscribe(string $listId, Member $member): Member
    {
        $errors = $this->validator->validate($member);

        if (count($errors) > 0) {
            throw new ValidationFailedException(get_class($member), $errors);
        }

        $member->setStatus(Member::STATUS_SUBSCRIBED);

        $response = $this->client->patch(
            sprintf(
                '/%s/lists/%s/members/%s',
                MailChimpConfig::VERSION,
                $listId,
                md5(strtolower($member->getEmailAddress()))
            ),
            [
                'body' => $this->serializer->serialize($member, 'json')
            ]
        );

        /** @var $successResponse Member */
        $successResponse = $this->serializer->deserialize((string) $response->getBody(), Member::class, 'json');

        return $successResponse;
    }

    /**
     * Re Subscribe a member
     *
     * @param string $listId
     * @param Member $member
     * @return Member
     * @throws ValidationFailedException
     * @throws ClientException
     */
    public function getStatus(string $listId, Member $member): Member
    {
        $errors = $this->validator->validate($member);

        if (count($errors) > 0) {
            throw new ValidationFailedException(get_class($member), $errors);
        }

        $response = $this->client->get(
            sprintf(
                '/%s/lists/%s/members/%s',
                MailChimpConfig::VERSION,
                $listId,
                md5(strtolower($member->getEmailAddress()))
            ),
            [
                'body' => $this->serializer->serialize($member, 'json')
            ]
        );

        /** @var $successResponse Member */
        $successResponse = $this->serializer->deserialize((string) $response->getBody(), Member::class, 'json');

        return $successResponse;
    }

    /**
     * Unsubscribe a member
     *
     * @param string $listId
     * @param Member $member
     * @return Member
     * @throws ValidationFailedException
     * @throws ClientException
     */
    public function unsubscribe(string $listId, Member $member): Member
    {
        $errors = $this->validator->validate($member);

        if (count($errors) > 0) {
            throw new ValidationFailedException(get_class($member), $errors);
        }

        $member->setStatus(Member::STATUS_UNSUBSCRIBED);

        $response = $this->client->patch(
            sprintf(
                '/%s/lists/%s/members/%s',
                MailChimpConfig::VERSION,
                $listId,
                md5(strtolower($member->getEmailAddress()))
            ),
            [
                'body' => $this->serializer->serialize($member, 'json')
            ]
        );

        /** @var $successResponse Member */
        $successResponse = $this->serializer->deserialize((string) $response->getBody(), Member::class, 'json');

        return $successResponse;
    }
}
