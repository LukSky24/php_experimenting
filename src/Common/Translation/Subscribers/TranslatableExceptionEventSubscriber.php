<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Translation\Subscribers;

use App\Common\ApplicationContext;
use App\Common\Translation\Exceptions\TranslatableException;
use App\Common\Translation\Enums\TranslationDomain;
use App\Common\Validation\Exceptions\ValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class TranslatableExceptionEventSubscriber
 *
 * @package App\Common\Subscribers
 */
class TranslatableExceptionEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    protected TranslatorInterface $translator;

    /**
     * @var ApplicationContext
     */
    protected ApplicationContext $appContext;

    /**
     * TranslatableExceptionEventSubscriber constructor.
     *
     * @param TranslatorInterface $translator
     * @param ApplicationContext $appContext
     */
    public function __construct(TranslatorInterface $translator, ApplicationContext $appContext)
    {
        $this->translator = $translator;
        $this->appContext = $appContext;
    }

    /**
     * @param ExceptionEvent $event
     *
     * @return void
     */
    public function handleTranslatableException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof TranslatableException || $exception instanceof ValidationException) {
            return;
        }

        $message = $this->appContext->isApiRequest() ? $exception->getMessage() : $exception->getMessageKey();

        $event->setResponse(
            new JsonResponse(
                [
                    'status' => false,
                    'message' => $this->translator->trans(
                        $message,
                        $exception->getMessageData(),
                        TranslationDomain::DOMAIN_EXCEPTIONS
                    )
                ], $exception->getHttpStatus()
            )
        );
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'handleTranslatableException'
        ];
    }
}
