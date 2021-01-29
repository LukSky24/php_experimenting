<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 23.09.2020
 */

namespace App\Common\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class DiscountPercent
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class DiscountPercent extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.discount_percent.discount_percent';
}
