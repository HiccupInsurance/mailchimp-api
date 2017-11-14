<?php

namespace Hiccup\MailChimpApi\Api;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Hiccup\MailChimpApi\Exception\InvalidParametersException;
use Hiccup\MailChimpApi\MailChimp;

/**
 * Class Member
 * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/
 */
final class Member
{

    #----------------------------------------------------------------------------------------------
    # Constants
    #----------------------------------------------------------------------------------------------

    const STATUS_SUBSCRIBED = 'subscribed';
    const STATUS_UNSUBSCRIBED = 'unsubscribed';
    const STATUS_CLEANED = 'cleaned';
    const STATUS_PENDING = 'pending';

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var Client
     */
    private $client;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param string $listId
     * @param array $parameters see MailChimp doc for list of available parameters
     * @return array
     * @throws InvalidParametersException
     */
    public function subscribe(string $listId, array $parameters): array
    {
        if (isset($parameters['email_address']) === false) {
            throw new InvalidParametersException(['email_address' => 'required']);
        }

        $parameters['status_if_new'] = Member::STATUS_SUBSCRIBED;
        $parameters['status'] = Member::STATUS_SUBSCRIBED;
        $member = $this->put($listId, $parameters);

        return $member;
    }

    /**
     * @param string $listId
     * @param array $parameters
     * @return array
     * @throws InvalidParametersException
     * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#edit-put_lists_list_id_members_subscriber_hash
     */
    public function put(string $listId, array $parameters): array
    {
        if (isset($parameters['email_address']) === false) {
            throw new InvalidParametersException(['email_address' => 'required']);
        }

        $response = $this->client->put(
            sprintf('/%s/lists/%s/members/%s', MailChimp::VERSION, $listId, md5($parameters['email_address'])),
            [RequestOptions::JSON => $parameters]
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * @param string $listId
     * @param array $parameters
     * @return array
     * @throws InvalidParametersException
     * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#edit-patch_lists_list_id_members_subscriber_hash
     */
    public function patch(string $listId, array $parameters): array
    {
        if (isset($parameters['email_address']) === false) {
            throw new InvalidParametersException(['email_address' => 'required']);
        }

        $response = $this->client->patch(
            sprintf('/%s/lists/%s/members/%s', MailChimp::VERSION, $listId, md5($parameters['email_address'])),
            [RequestOptions::JSON => $parameters]
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * @param string $listId
     * @param string $email
     *
     * @return array
     *
     * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#read-get_lists_list_id_members_subscriber_hash
     */
    public function get(string $listId, string $email): array
    {
        $response = $this->client->get(
            sprintf('/%s/lists/%s/members/%s', MailChimp::VERSION, $listId, md5($email))
        );

        return json_decode((string) $response->getBody(), true);
    }
}
