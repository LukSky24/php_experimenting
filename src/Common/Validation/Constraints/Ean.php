<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 12.11.2020
 */

namespace App\Common\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class Ean
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class Ean extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.ean.ean';
}

