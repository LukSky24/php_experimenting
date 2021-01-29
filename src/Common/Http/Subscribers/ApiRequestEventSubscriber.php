<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 11.12.2020
 */

namespace App\Common\Http\Subscribers;

use App\Common\ApplicationContext;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class ApiRequestEventSubscriber
 *
 * @package App\Common\Http\Subscribers
 */
class ApiRequestEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var ApplicationContext
     */
    protected ApplicationContext $appContext;

    /**
     * ApiRequestEventSubscriber constructor.
     *
     * @param ApplicationContext $appContext
     */
    public function __construct(ApplicationContext $appContext)
    {
        $this->appContext = $appContext;
    }

    /**
     * @param RequestEvent $event
     */
    public function setApiRequestContextInfo(RequestEvent $event): void
    {
        $apiUri = '/api/v1';
        $request = $event->getRequest();

        if (strpos($request->getRequestUri(), $apiUri) === 0) {
            $this->appContext->setLocale('en');
            $this->appContext->setIsApiRequest(true);
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['setApiRequestContextInfo', 10]
        ];
    }

}
