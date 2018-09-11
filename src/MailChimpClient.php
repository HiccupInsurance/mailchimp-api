<?php

namespace Hiccup\MailChimpApi;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * MailChimp v3.0 API integration
 * @see http://developer.mailchimp.com/documentation/mailchimp/reference/overview/
 */
final class MailChimpClient
{

    #----------------------------------------------------------------------------------------------
    # Constants
    #----------------------------------------------------------------------------------------------

    const VERSION = '3.0';

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

    public function __construct(string $apiKey)
    {
        $dataCenter = explode('-', $apiKey)[1];

        $this->client = new Client([
            'base_uri' => sprintf('https://%s.api.mailchimp.com', $dataCenter),
            'auth' => ['any', $apiKey]
        ]);
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param string $path
     * @param array $options
     * @return ResponseInterface
     */
    public function put(string $path, array $options): ResponseInterface
    {
        return $this->client->put($path, $options);
    }
}
