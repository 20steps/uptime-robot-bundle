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
class PSPNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\PSP') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\PSP) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\PSP();
        if (property_exists($data, 'id')) {
            $object->setId($data->{'id'});
        }
        if (property_exists($data, 'friendly_name')) {
            $object->setFriendlyName($data->{'friendly_name'});
        }
        if (property_exists($data, 'monitors')) {
            $object->setMonitors($data->{'monitors'});
        }
        if (property_exists($data, 'sort')) {
            $object->setSort($data->{'sort'});
        }
        if (property_exists($data, 'status')) {
            $object->setStatus($data->{'status'});
        }
        if (property_exists($data, 'standard_url')) {
            $object->setStandardUrl($data->{'standard_url'});
        }
        if (property_exists($data, 'custom_url')) {
            $object->setCustomUrl($data->{'custom_url'});
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getId()) {
            $data->{'id'} = $object->getId();
        }
        if (null !== $object->getFriendlyName()) {
            $data->{'friendly_name'} = $object->getFriendlyName();
        }
        if (null !== $object->getMonitors()) {
            $data->{'monitors'} = $object->getMonitors();
        }
        if (null !== $object->getSort()) {
            $data->{'sort'} = $object->getSort();
        }
        if (null !== $object->getStatus()) {
            $data->{'status'} = $object->getStatus();
        }
        if (null !== $object->getStandardUrl()) {
            $data->{'standard_url'} = $object->getStandardUrl();
        }
        if (null !== $object->getCustomUrl()) {
            $data->{'custom_url'} = $object->getCustomUrl();
        }
        return $data;
    }
}