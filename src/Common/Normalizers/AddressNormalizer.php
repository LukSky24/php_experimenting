<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 20.05.2020
 */

namespace App\Common\Normalizers;

use App\Common\ValueObjects\Address\Address;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class AddressNormalizer
 *
 * @package App\Common\Normalizers
 */
class AddressNormalizer implements NormalizerInterface, NormalizerAwareInterface, CacheableSupportsMethodInterface
{
    use NormalizerAwareTrait;

    /**
     * @param Address $object
     * @param string|null $format
     * @param array $context
     *
     * @return array
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        $adrress = [
            'streetLine' => $object->getStreetLine(),
            'street' => $object->getStreet()->getValue(),
            'buildingNumber' => $object->getBuildingNumber()->getValue(),
            'city' => $object->getCity()->getValue(),
            'postCode' => $object->getPostCode()->getValue()
        ];

        if($object->getFlatNumber() !== null) {
            $adrress['flatNumber'] = $object->getFlatNumber()->getValue();
        }

        return $adrress;
    }

    /**
     * @param mixed $data
     * @param string|null $format
     *
     * @return bool
     */
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Address;
    }

    /**
     * @return bool
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
