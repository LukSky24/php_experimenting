<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 09.07.2020
 */

namespace App\Common\Doctrine\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class EntityNotExists
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class EntityNotExists extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'Entity exists.';

    /**
     * @var string
     */
    public string $entity = '';

    /**
     * @var string
     */
    public string $field = '';

    /**
     * @var int
     */
    public int $exceptId = 0;

    /**
     * @var string
     */
    public string $exceptIdPropertyPath = '';

    /**
     * @var string
     */
    public string $managerName = 'default';

}
