<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date:30.06.2020
 */

namespace App\Common\CQRS;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface QueryRequestInterface
 *
 * @package App\Common\CQRS
 */
interface QueryRequestInterface
{
    /**
     * @param Request $request
     *
     * @return self
     */
    public static function createFromRequest(Request $request): self;

}
