<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 18.05.2020
 */

namespace App\Common\Validation\Constraints\Address;

use App\Common\Validation\AbstractConstraint;

/**
 * Class PostCode
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class PostCode extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.address.post_code.post_code';
}
