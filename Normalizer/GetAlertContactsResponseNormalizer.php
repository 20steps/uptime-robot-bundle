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
class GetAlertContactsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\GetAlertContactsResponse') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\GetAlertContactsResponse) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\GetAlertContactsResponse();
        if (property_exists($data, 'stat')) {
            $object->setStat($data->{'stat'});
        }
        if (property_exists($data, 'error')) {
            $object->setError($this->denormalizer->denormalize($data->{'error'}, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Error', 'json', $context));
        }
        if (property_exists($data, 'pagination')) {
            $object->setPagination($this->denormalizer->denormalize($data->{'pagination'}, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Pagination', 'json', $context));
        }
        if (property_exists($data, 'alert_contacts')) {
            $values = array();
            foreach ($data->{'alert_contacts'} as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AlertContact', 'json', $context);
            }
            $object->setAlertContacts($values);
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
        if (null !== $object->getAlertContacts()) {
            $values = array();
            foreach ($object->getAlertContacts() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data->{'alert_contacts'} = $values;
        }
        return $data;
    }
}