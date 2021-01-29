<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 21.05.2020
 */

namespace App\Common\Doctrine\Interfaces;

/**
 * Interface NullableEmbeddableInterface
 *
 * @package App\Common\Doctrine\Interfaces
 */
interface NullableEmbeddableInterface
{
    /**
     * @return bool
     */
    public function isNull(): bool;
}
