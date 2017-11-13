<?php

namespace Hiccup\MailChimpApi\Api;

use GuzzleHttp\Client;

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
     *
     * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#create-post_lists_list_id_members
     */
    public function create(string $listId, array $parameters)
    {
        $this->client->post(sprintf('/lists/%s/members', $listId), $parameters);
    }
}
