<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 14.07.2020
 */

namespace App\Common\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class Sku
 *
 * @package App\Core\Products\Validation\Constraints
 *
 * @Annotation
 */
class Sku extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.sku.sku';

}
