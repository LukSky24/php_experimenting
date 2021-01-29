<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 18.05.2020
 */

namespace App\Common\Normalizers;

use App\Common\Pagination\PaginatedCollection;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class PaginatedCollectionNormalizer
 *
 * @package App\Common\Normalizers
 */
class PaginatedCollectionNormalizer implements NormalizerInterface, NormalizerAwareInterface, CacheableSupportsMethodInterface
{
    use NormalizerAwareTrait;

    /**
     * @param mixed $object
     * @param string|null $format
     * @param array $context
     *
     * @return array
     *
     * @throws ExceptionInterface
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var PaginatedCollection $object */

        return [
            'items' => $this->normalizer->normalize($object->getItems(), $format, $context),
            'currentPage' => $object->getCurrentPage(),
            'perPage' => $object->getPerPage(),
            'totalPages' => $object->getTotalPages(),
            'totalResults' => $object->getTotalResults()
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
        return $data instanceof PaginatedCollection;
    }

    /**
     * @return bool
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
