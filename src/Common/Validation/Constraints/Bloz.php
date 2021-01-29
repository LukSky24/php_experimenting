<?php
/**
 * Author: Paweł Paliński<pawel.palinski@nettle.pl>
 * Date: 15.11.2020
 */

namespace App\Common\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class Bloz
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class Bloz extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.bloz.bloz';
}
