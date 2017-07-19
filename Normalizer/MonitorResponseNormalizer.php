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
class MonitorResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\MonitorResponse') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse();
        if (property_exists($data, 'stat')) {
            $object->setStat($data->{'stat'});
        }
        if (property_exists($data, 'monitor')) {
            $object->setMonitor($this->denormalizer->denormalize($data->{'monitor'}, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Monitor', 'json', $context));
        }
        if (property_exists($data, 'error')) {
            $object->setError($this->denormalizer->denormalize($data->{'error'}, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Error', 'json', $context));
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getStat()) {
            $data->{'stat'} = $object->getStat();
        }
        if (null !== $object->getMonitor()) {
            $data->{'monitor'} = $this->normalizer->normalize($object->getMonitor(), 'json', $context);
        }
        if (null !== $object->getError()) {
            $data->{'error'} = $this->normalizer->normalize($object->getError(), 'json', $context);
        }
        return $data;
    }
}