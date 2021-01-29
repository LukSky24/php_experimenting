<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 01.06.2020
 */

namespace App\Common\Translation\Enums;

use App\Common\Enums\AbstractEnum;

/**
 * Class Enums
 * @package App\Common\Translation\Enums
 */
class TranslationDomain extends AbstractEnum
{
    public const DOMAIN_MESSAGES = 'messages';
    public const DOMAIN_VALIDATORS = 'validators';
    public const DOMAIN_EMAILS = 'emails';
    public const DOMAIN_EXCEPTIONS = 'exceptions';
}
