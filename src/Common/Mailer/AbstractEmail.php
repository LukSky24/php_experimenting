<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Mailer;

use App\Common\ValueObjects\EmailAddress;

/**
 * Class AbstractEmail
 *
 * @package App\Common\Mailer
 */
abstract class AbstractEmail
{
    /**
     * @var EmailAddress
     */
    protected EmailAddress $recipient;

    /**
     * @var string
     */
    protected string $subject;

    /**
     * @var string
     */
    protected string $htmlTemplate;

    /**
     * @var string
     */
    protected string $textTemplate;

    /**
     * AbstractEmail constructor.
     *
     * @param EmailAddress $recipient
     */
    public function __construct(EmailAddress $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return EmailAddress
     */
    public function getRecipient(): EmailAddress
    {
        return $this->recipient;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return array
     */
    public function getSubjectTranslationData(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getHtmlTemplate(): string
    {
        return $this->htmlTemplate;
    }

    /**
     * @return string
     */
    public function getTextTemplate(): string
    {
        return $this->textTemplate;
    }

    /**
     * @return array
     */
    public function getViewData(): array
    {
        return [];
    }
}
