<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Mailer;

use App\Common\Translation\Enums\TranslationDomain;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Address;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class Mailer
 *
 * @package App\Common\Mailer
 */
class Mailer
{
    /**
     * @var MessageBusInterface
     */
    protected MessageBusInterface $messageBus;

    /**
     * @var TranslatorInterface
     */
    protected TranslatorInterface $translator;

    /**
     * @var string
     */
    protected string $senderEmail;

    /**
     * @var string
     */
    protected string $senderName;

    /**
     * Mailer constructor.
     *
     * @param MessageBusInterface $messageBus
     * @param TranslatorInterface $translator
     * @param string $senderEmail
     * @param string $senderName
     */
    public function __construct(
        MessageBusInterface $messageBus,
        TranslatorInterface $translator,
        string $senderEmail,
        string $senderName
    )
    {
        $this->messageBus = $messageBus;
        $this->translator = $translator;
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
    }

    /**
     * @param AbstractEmail $message
     *
     * @return void
     */
    public function send(AbstractEmail $message): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->senderEmail, $this->senderName))
            ->to($message->getRecipient()->getValue())
            ->subject($this->translator->trans($message->getSubject(), $message->getSubjectTranslationData(), TranslationDomain::DOMAIN_EMAILS))
            ->htmlTemplate($message->getHtmlTemplate())
            ->textTemplate($message->getTextTemplate())
            ->context($message->getViewData());

        $this->messageBus->dispatch(new SendEmailMessage($email));
    }
}
