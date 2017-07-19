<?php

namespace twentysteps\Commons\UptimeRobotBundle\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;
class AlertContactDeleteResponseNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AlertContactDeleteResponse') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\AlertContactDeleteResponse) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\AlertContactDeleteResponse();
        if (property_exists($data, 'stat')) {
            $object->setStat($data->{'stat'});
        }
        if (property_exists($data, 'error')) {
            $object->setError($this->serializer->deserialize($data->{'error'}, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Error', 'raw', $context));
        }
        if (property_exists($data, 'alert_contact')) {
            $object->setAlertContact($this->serializer->deserialize($data->{'alert_contact'}, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AlertContact', 'raw', $context));
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
            $data->{'error'} = $this->serializer->serialize($object->getError(), 'raw', $context);
        }
        if (null !== $object->getAlertContact()) {
            $data->{'alert_contact'} = $this->serializer->serialize($object->getAlertContact(), 'raw', $context);
        }
        return $data;
    }
}