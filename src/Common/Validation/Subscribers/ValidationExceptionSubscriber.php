<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Validation\Subscribers;

use App\Common\ApplicationContext;
use App\Common\Translation\Enums\TranslationDomain;
use App\Common\Validation\Exceptions\ValidationException;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class ValidationExceptionSubscriber
 *
 * @package App\Common\Validation\Subscribers
 */
class ValidationExceptionSubscriber implements EventSubscriberInterface
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
     * ValidationExceptionSubscriber constructor.
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
    public function handleRequestValidationException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof ValidationException) {
            return;
        }

        $errors = array_map(
            fn($item) => $this->translator->trans(
                $item,
                [],
                TranslationDomain::DOMAIN_VALIDATORS,
                $this->appContext->getLocale()
            ),
            $exception->getErrors()
        );

        $message = $this->appContext->isApiRequest() ? $exception->getMessage() : $exception->getMessageKey();

        $event->setResponse(
            new JsonResponse(
                [
                    'status' => false,
                    'message' => $this->translator->trans(
                        $message,
                        $exception->getMessageData(),
                        TranslationDomain::DOMAIN_EXCEPTIONS
                    ),
                    'errors' => $errors
                ],
                $exception->getHttpStatus()
            )
        );
    }

    /**
     * @param ConsoleErrorEvent $event
     *
     * @return void
     */
    public function handleConsoleValidationException(ConsoleErrorEvent $event): void
    {
        $exception = $event->getError();

        if (!$exception instanceof ValidationException) {
            return;
        }

        $output = $event->getOutput();

        $output->writeln($exception->getMessage());

        foreach ($exception->getErrors() as $key => $error) {
            $output->writeln('- ' . $key . ' - ' . $error);
        }

        exit;
    }

    /**
     * @return array|string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'handleRequestValidationException',
            ConsoleEvents::ERROR => 'handleConsoleValidationException'
        ];
    }
}
