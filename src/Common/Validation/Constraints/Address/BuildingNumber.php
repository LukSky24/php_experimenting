<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 11.09.2020
 */

namespace App\Common\Validation\Constraints\Address;

use App\Common\Validation\AbstractConstraint;

/**
 * Class BuildingNumber
 *
 * @package App\Common\Validation\Constraints\Address
 *
 * @Annotation
 */
class BuildingNumber extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = "common.address.building_number.building_number";

}
