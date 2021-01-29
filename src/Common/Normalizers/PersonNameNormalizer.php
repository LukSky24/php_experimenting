<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 08.05.2020
 */

namespace App\Common\Normalizers;

use App\Common\ValueObjects\PersonName;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class PersonNameNormalizer
 *
 * @package App\Common\Normalizers
 */
class PersonNameNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    /**
     * @param PersonName $object
     * @param string|null $format
     * @param array $context
     *
     * @return array
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'firstName' => $object->getFirstName(),
            'lastName' => $object->getLastName(),
            'fullName' => $object->getFullName()
        ];
    }

    /**
     * @param mixed $data
     * @param string|null $format
     *
     * @return bool
     */
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof PersonName;
    }

    /**
     * @return bool
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
