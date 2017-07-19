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
class AccountNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Account') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\Account) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\Account();
        if (property_exists($data, 'id')) {
            $object->setId($data->{'id'});
        }
        if (property_exists($data, 'email')) {
            $object->setEmail($data->{'email'});
        }
        if (property_exists($data, 'monitor_limit')) {
            $object->setMonitorLimit($data->{'monitor_limit'});
        }
        if (property_exists($data, 'monitor_interval')) {
            $object->setMonitorInterval($data->{'monitor_interval'});
        }
        if (property_exists($data, 'up_monitors')) {
            $object->setUpMonitors($data->{'up_monitors'});
        }
        if (property_exists($data, 'down_monitors')) {
            $object->setDownMonitors($data->{'down_monitors'});
        }
        if (property_exists($data, 'paused_monitors')) {
            $object->setPausedMonitors($data->{'paused_monitors'});
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getId()) {
            $data->{'id'} = $object->getId();
        }
        if (null !== $object->getEmail()) {
            $data->{'email'} = $object->getEmail();
        }
        if (null !== $object->getMonitorLimit()) {
            $data->{'monitor_limit'} = $object->getMonitorLimit();
        }
        if (null !== $object->getMonitorInterval()) {
            $data->{'monitor_interval'} = $object->getMonitorInterval();
        }
        if (null !== $object->getUpMonitors()) {
            $data->{'up_monitors'} = $object->getUpMonitors();
        }
        if (null !== $object->getDownMonitors()) {
            $data->{'down_monitors'} = $object->getDownMonitors();
        }
        if (null !== $object->getPausedMonitors()) {
            $data->{'paused_monitors'} = $object->getPausedMonitors();
        }
        return $data;
    }
}