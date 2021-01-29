<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Helpers;

use App\Common\Enums\AbstractEnum;
use App\Common\Enums\Exceptions\NotInEnumException;
use App\Common\Exceptions\LogicException;
use Exception;

/**
 * Class RandomStringGenerator
 *
 * @package App\Common\Helpers
 */
class RandomStringGenerator extends AbstractEnum
{
    public const ALPHA = 'alpha';
    public const ALPHANUM = 'alphanum';
    public const SPECIAL = 'special';
    public const NUMERIC = 'numeric';
    protected const POOL_ALPHA = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected const POOL_ALPHANUM = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected const POOL_SPECIAL = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%*()._[]';
    protected const POOL_NUMERIC = '0123456789';

    /**
     * @param string $type
     * @param int $length
     *
     * @return string
     *
     * @throws LogicException
     * @throws NotInEnumException
     * @throws Exception
     */
    public static function generate(string $type = 'special', int $length = 10): string
    {
        if (!self::contains($type)) {
            throw new NotInEnumException(self::class, $type);
        }

        if ($length < 1) {
            throw new LogicException('Cannot generate string with length lower than 1, "' . $length . '" given.');
        }

        $type = strtoupper($type);

        $pool = self::get('POOL_' . $type);

        if (is_null($pool)) {
            $pool = self::POOL_ALPHANUM;
        }

        $str = '';

        for ($i = 0; $i < $length; $i++) {
            $str .= $pool[random_int(0, strlen($pool) - 1)];
        }

        return $str;
    }
}
