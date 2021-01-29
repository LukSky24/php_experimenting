<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 29.05.2020
 */

namespace App\Common\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class NettleId
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class NettleId extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.nettle_id.nettle_id';

}
