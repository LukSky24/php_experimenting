<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 01.06.2020
 */

namespace App\Common\Doctrine\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class EntityExists
 *
 * @package App\Common\Doctrine\Validation\Constraints
 *
 * @Annotation
 */
class EntityExists extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = '';

    /**
     * @var string
     */
    public string $class = '';

    /**
     * @var string
     */
    public string $field = 'id';

    /**
     * @var string
     */
    public string $managerName = 'default';
}
