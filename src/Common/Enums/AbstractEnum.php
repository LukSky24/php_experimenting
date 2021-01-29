<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Enums;

use ReflectionClass;

/**
 * Class AbstractEnum
 *
 * @package App\Common\Enums
 */
abstract class AbstractEnum
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * @return array
     */
    public static function getConstants(): array
    {
        $reflection = new ReflectionClass(static::class);

        return $reflection->getConstants();
    }

    /**
     * @param bool $withAny
     *
     * @return array
     */
    public static function getOptions(bool $withAny = false): array
    {
        $options = array_flip(self::getConstants());

        if ($withAny) {
            $options = ['select.any' => ''] + $options;
        }

        return $options;
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public static function get(string $key)
    {
        if (defined(static::class . '::' . $key)) {
            return constant(static::class . '::' . $key);
        }

        return null;
    }

    /**
     * @param $value
     *
     * @return string|null
     */
    public static function getKey($value): ?string
    {
        $options = self::getOptions();

        return $options[$value] ?? null;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public static function contains($value): bool
    {
        return in_array($value, self::getConstants(), true);
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function is(string $value): bool
    {
        return $this->value === $value;
    }

}
