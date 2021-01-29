<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 15.01.2021
 */

namespace App\Common\Helpers;

use RuntimeException;

/**
 * Class DirectoryHelper
 *
 * @package App\Common\Helpers
 */
class DirectoryHelper
{
    public static function ensureDirExists(string $pathToDir): void
    {
        if (!file_exists($pathToDir) && !mkdir($pathToDir) && !is_dir($pathToDir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $pathToDir));
        }
    }

}
