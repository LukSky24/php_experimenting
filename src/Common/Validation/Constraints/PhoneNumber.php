<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 08.07.2020
 */

namespace App\Common\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class PhoneNumber
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class PhoneNumber extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.phone_number.phone_number';

}
