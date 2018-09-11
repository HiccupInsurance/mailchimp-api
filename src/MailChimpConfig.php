<?php

namespace Hiccup\MailChimpApi;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * MailChimp v3.0 API integration
 * @see http://developer.mailchimp.com/documentation/mailchimp/reference/overview/
 */
final class MailChimpConfig
{

    #----------------------------------------------------------------------------------------------
    # Constants
    #----------------------------------------------------------------------------------------------

    const VERSION = '3.0';

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * HTTP Client
     *
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
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $dataCenter = explode('-', $apiKey)[1];

        $this->client = new Client([
            'base_uri' => sprintf('https://%s.api.mailchimp.com', $dataCenter),
            'auth' => ['any', $apiKey]
        ]);

        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $this->serializer = SerializerBuilder::create()->build();
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return ValidatorInterface
     */
    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    /**
     * @return SerializerInterface
     */
    public function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }
}
