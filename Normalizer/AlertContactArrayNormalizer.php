<?php

namespace twentysteps\Commons\UptimeRobotBundle\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;
class AlertContactArrayNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AlertContactArray') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\AlertContactArray) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\AlertContactArray();
        if (property_exists($data, 'alertcontact')) {
            $values = array();
            foreach ($data->{'alertcontact'} as $value) {
                $values[] = $this->serializer->deserialize($value, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AlertContact', 'raw', $context);
            }
            $object->setAlertcontact($values);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getAlertcontact()) {
            $values = array();
            foreach ($object->getAlertcontact() as $value) {
                $values[] = $this->serializer->serialize($value, 'raw', $context);
            }
            $data->{'alertcontact'} = $values;
        }
        return $data;
    }
}