<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Security;

use App\Common\Translation\Enums\TranslationDomain;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class AccessDeniedHandler
 *
 * @package App\Common\Security
 */
class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    /**
     * @var TranslatorInterface
     */
    protected TranslatorInterface $translator;

    /**
     * AccessDeniedHandler constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param Request $request
     * @param AccessDeniedException $accessDeniedException
     *
     * @return Response
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException): Response
    {
        return new JsonResponse([
            'status' => false,
            'message' => $this->translator->trans('common.exceptions.access_denied_exception', [], TranslationDomain::DOMAIN_EXCEPTIONS),
        ], JsonResponse::HTTP_FORBIDDEN);
    }

}
