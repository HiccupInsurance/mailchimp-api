<?php

namespace Hiccup\MailChimpApi\Model;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Member
 * @package Hiccup\MailChimpApi\Model
 * @Serializer\ExclusionPolicy("all")
 */
final class Member
{

    #----------------------------------------------------------------------------------------------
    # Constants
    #----------------------------------------------------------------------------------------------

    // @see https://developer.mailchimp.com/documentation/mailchimp/guides/manage-subscribers-with-the-mailchimp-api/#check-subscription-status
    const STATUS_SUBSCRIBED = 'subscribed';
    const STATUS_UNSUBSCRIBED = 'unsubscribed';
    const STATUS_CLEANED = 'cleaned';
    const STATUS_PENDING = 'pending';

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * Email address for a subscriber
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     *
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $emailAddress;

    /**
     * Subscriber's current status.
     *
     * @var string
     *
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $status = Member::STATUS_SUBSCRIBED;

    /**
     * Type of email this member asked to get ("html" or "text").
     *
     * @var string
     *
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $emailType = 'html';

    /**
     * Subscriber’s status. This value is required only if the email address is not already present on the list.
     *
     * @var string
     *
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $statusIfNew = Member::STATUS_SUBSCRIBED;

    /**
     * An individual merge var and value for a member.
     *
     * @var string[]
     *
     * @Serializer\Expose()
     * @Serializer\Type("array<string, string>")
     */
    private $mergeFields = [];

    #----------------------------------------------------------------------------------------------
    # Properties accessor
    #----------------------------------------------------------------------------------------------

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return string
     */
    public function getEmailType(): string
    {
        return $this->emailType;
    }

    /**
     * @param string $emailType
     */
    public function setEmailType(string $emailType)
    {
        $this->emailType = $emailType;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string[]
     */
    public function getMergeFields(): array
    {
        return $this->mergeFields;
    }

    /**
     * @param string[] $mergeFields
     */
    public function setMergeFields(array $mergeFields)
    {
        $this->mergeFields = $mergeFields;
    }

    /**
     * @return string
     */
    public function getStatusIfNew(): string
    {
        return $this->statusIfNew;
    }

    /**
     * @param string $statusIfNew
     */
    public function setStatusIfNew(string $statusIfNew)
    {
        $this->statusIfNew = $statusIfNew;
    }
}
