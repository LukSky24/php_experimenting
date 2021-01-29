<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 14.07.2020
 */

namespace App\Common\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class VatRate
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class VatRate extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.vat_rate.vat_rate';
}
