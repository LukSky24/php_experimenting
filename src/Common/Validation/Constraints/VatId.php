<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 18.05.2020
 */

namespace App\Common\Validation\Constraints;

use App\Common\Validation\AbstractConstraint;

/**
 * Class VatId
 *
 * @package App\Common\Validation\Constraints
 *
 * @Annotation
 */
class VatId extends AbstractConstraint
{
    /**
     * @var string
     */
    public string $message = 'common.vat_id.vat_id';
}
