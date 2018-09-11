<?php

namespace Hiccup\MailChimpApi\Model;

use Symfony\Component\Validator\Constraints as Assert;

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
     */
    private $emailAddress;

    /**
     * Subscriber's current status.
     *
     * @var string
     */
    private $status = Member::STATUS_SUBSCRIBED;

    /**
     * Type of email this member asked to get ("html" or "text").
     *
     * @var string
     */
    private $emailType = 'html';

    /**
     * Subscriber’s status. This value is required only if the email address is not already present on the list.
     *
     * @var string
     */
    private $statusIfNew = Member::STATUS_SUBSCRIBED;

    /**
     * An individual merge var and value for a member.
     *
     * @var string[]
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
