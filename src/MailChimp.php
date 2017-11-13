<?php

namespace Hiccup\MailChimpApi;

use GuzzleHttp\Client;
use Hiccup\MailChimpApi\Api\Member;

/**
 * MailChimp v3.0 API integration
 * @see http://developer.mailchimp.com/documentation/mailchimp/reference/overview/
 */
final class MailChimp
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var Member
     */
    private $member;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    public function __construct(string $apiKey)
    {
        $dataCenter = explode('-', $apiKey)[1];

        $client = new Client([
            'base_uri' => sprintf('https://%s.api.mailchimp.com/3.0', $dataCenter),
            'auth' => ['any', $apiKey]
        ]);

        $this->member = new Member($client);
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @return Member
     */
    public function member(): Member
    {
        return $this->member;
    }
}
