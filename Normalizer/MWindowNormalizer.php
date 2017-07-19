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
class MWindowNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\MWindow') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\MWindow) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\MWindow();
        if (property_exists($data, 'id')) {
            $object->setId($data->{'id'});
        }
        if (property_exists($data, 'user')) {
            $object->setUser($data->{'user'});
        }
        if (property_exists($data, 'type')) {
            $object->setType($data->{'type'});
        }
        if (property_exists($data, 'friendly_name')) {
            $object->setFriendlyName($data->{'friendly_name'});
        }
        if (property_exists($data, 'start_time')) {
            $object->setStartTime($data->{'start_time'});
        }
        if (property_exists($data, 'duration')) {
            $object->setDuration($data->{'duration'});
        }
        if (property_exists($data, 'value')) {
            $object->setValue($data->{'value'});
        }
        if (property_exists($data, 'status')) {
            $object->setStatus($data->{'status'});
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getId()) {
            $data->{'id'} = $object->getId();
        }
        if (null !== $object->getUser()) {
            $data->{'user'} = $object->getUser();
        }
        if (null !== $object->getType()) {
            $data->{'type'} = $object->getType();
        }
        if (null !== $object->getFriendlyName()) {
            $data->{'friendly_name'} = $object->getFriendlyName();
        }
        if (null !== $object->getStartTime()) {
            $data->{'start_time'} = $object->getStartTime();
        }
        if (null !== $object->getDuration()) {
            $data->{'duration'} = $object->getDuration();
        }
        if (null !== $object->getValue()) {
            $data->{'value'} = $object->getValue();
        }
        if (null !== $object->getStatus()) {
            $data->{'status'} = $object->getStatus();
        }
        return $data;
    }
}