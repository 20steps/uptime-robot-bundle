<?php

namespace twentysteps\Commons\UptimeRobotBundle\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;
class MonitorArrayNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\MonitorArray') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\MonitorArray) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\MonitorArray();
        if (property_exists($data, 'monitor')) {
            $values = array();
            foreach ($data->{'monitor'} as $value) {
                $values[] = $this->serializer->deserialize($value, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Monitor', 'raw', $context);
            }
            $object->setMonitor($values);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getMonitor()) {
            $values = array();
            foreach ($object->getMonitor() as $value) {
                $values[] = $this->serializer->serialize($value, 'raw', $context);
            }
            $data->{'monitor'} = $values;
        }
        return $data;
    }
}