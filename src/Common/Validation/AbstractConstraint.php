<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Validation;

use Symfony\Component\Validator\Constraint;

/**
 * Class AbstractConstraint
 *
 * @package App\Common\Validation
 */
abstract class AbstractConstraint extends Constraint
{
    /**
     * @return string
     */
    public function validatedBy(): string
    {
        return str_replace('Constraints', 'Validators', get_class($this).'Validator');
    }
}
