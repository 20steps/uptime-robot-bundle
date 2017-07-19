<?php

namespace twentysteps\Commons\UptimeRobotBundle\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;
class ErrorResponseNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\ErrorResponse') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\ErrorResponse) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\ErrorResponse();
        if (property_exists($data, 'stat')) {
            $object->setStat($data->{'stat'});
        }
        if (property_exists($data, 'id')) {
            $object->setId($data->{'id'});
        }
        if (property_exists($data, 'message')) {
            $object->setMessage($data->{'message'});
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getStat()) {
            $data->{'stat'} = $object->getStat();
        }
        if (null !== $object->getId()) {
            $data->{'id'} = $object->getId();
        }
        if (null !== $object->getMessage()) {
            $data->{'message'} = $object->getMessage();
        }
        return $data;
    }
}