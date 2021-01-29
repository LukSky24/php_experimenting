<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 08.05.2020
 */

namespace App\Common\Http\Subscribers;

use App\Common\Http\Exceptions\BadJsonRequestException;

use JsonException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class JsonRequestEventSubscriber
 *
 * @package App\Common\Http\Subscribers
 */
class JsonRequestEventSubscriber implements EventSubscriberInterface
{
    /**
     * @param RequestEvent $event
     *
     * @return void
     *
     * @throws BadJsonRequestException
     * @throws JsonException
     */
    public function extractJsonBody(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->getContentType() !== 'json' || empty($request->getContent())) {
            return;
        }

        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new BadJsonRequestException($request);
        }

        if (!empty($data)) {
            $request->request->replace($data);
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['extractJsonBody', 100]
        ];
    }
}
