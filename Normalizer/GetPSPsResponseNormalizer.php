<?php

namespace twentysteps\Commons\UptimeRobotBundle\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class GetPSPsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\GetPSPsResponse') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\GetPSPsResponse) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\GetPSPsResponse();
        if (property_exists($data, 'stat')) {
            $object->setStat($data->{'stat'});
        }
        if (property_exists($data, 'error')) {
            $object->setError($this->denormalizer->denormalize($data->{'error'}, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Error', 'json', $context));
        }
        if (property_exists($data, 'pagination')) {
            $object->setPagination($this->denormalizer->denormalize($data->{'pagination'}, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Pagination', 'json', $context));
        }
        if (property_exists($data, 'psps')) {
            $values = array();
            foreach ($data->{'psps'} as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\PSP', 'json', $context);
            }
            $object->setPsps($values);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getStat()) {
            $data->{'stat'} = $object->getStat();
        }
        if (null !== $object->getError()) {
            $data->{'error'} = $this->normalizer->normalize($object->getError(), 'json', $context);
        }
        if (null !== $object->getPagination()) {
            $data->{'pagination'} = $this->normalizer->normalize($object->getPagination(), 'json', $context);
        }
        if (null !== $object->getPsps()) {
            $values = array();
            foreach ($object->getPsps() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data->{'psps'} = $values;
        }
        return $data;
    }
}