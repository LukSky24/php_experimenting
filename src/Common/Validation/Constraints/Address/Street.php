<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 29.05.2020
 */

namespace App\Common\Validation\Constraints\Address;

use App\Common\Validation\AbstractConstraint;

/**
 * Class Street
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class Street extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $minMessage = "common.address.street.min_length";

    /**
     * @var string
     */
    public string $maxMessage= "common.address.street.max_length";

}
