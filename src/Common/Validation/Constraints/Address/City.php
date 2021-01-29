<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 29.05.2020
 */

namespace App\Common\Validation\Constraints\Address;

use App\Common\Validation\AbstractConstraint;

/**
 * Class City
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class City extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $minMessage = "common.address.city.min_length";

    /**
     * @var string
     */
    public string $maxMessage = "common.address.city.max_length";

}
