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
class MonitorNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Monitor') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \twentysteps\Commons\UptimeRobotBundle\Model\Monitor) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \twentysteps\Commons\UptimeRobotBundle\Model\Monitor();
        if (property_exists($data, 'id')) {
            $object->setId($data->{'id'});
        }
        if (property_exists($data, 'friendly_name')) {
            $object->setFriendlyName($data->{'friendly_name'});
        }
        if (property_exists($data, 'url')) {
            $object->setUrl($data->{'url'});
        }
        if (property_exists($data, 'type')) {
            $object->setType($data->{'type'});
        }
        if (property_exists($data, 'sub_type')) {
            $object->setSubType($data->{'sub_type'});
        }
        if (property_exists($data, 'keyword_type')) {
            $object->setKeywordType($data->{'keyword_type'});
        }
        if (property_exists($data, 'keyword_value')) {
            $object->setKeywordValue($data->{'keyword_value'});
        }
        if (property_exists($data, 'http_username')) {
            $object->setHttpUsername($data->{'http_username'});
        }
        if (property_exists($data, 'http_password')) {
            $object->setHttpPassword($data->{'http_password'});
        }
        if (property_exists($data, 'port')) {
            $object->setPort($data->{'port'});
        }
        if (property_exists($data, 'interval')) {
            $object->setInterval($data->{'interval'});
        }
        if (property_exists($data, 'status')) {
            $object->setStatus($data->{'status'});
        }
        if (property_exists($data, 'create_datetime')) {
            $object->setCreateDatetime($data->{'create_datetime'});
        }
        if (property_exists($data, 'monitor_group')) {
            $object->setMonitorGroup($data->{'monitor_group'});
        }
        if (property_exists($data, 'is_group_main')) {
            $object->setIsGroupMain($data->{'is_group_main'});
        }
        if (property_exists($data, 'logs')) {
            $values = array();
            foreach ($data->{'logs'} as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\Log', 'json', $context);
            }
            $object->setLogs($values);
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
        if (null !== $object->getUrl()) {
            $data->{'url'} = $object->getUrl();
        }
        if (null !== $object->getType()) {
            $data->{'type'} = $object->getType();
        }
        if (null !== $object->getSubType()) {
            $data->{'sub_type'} = $object->getSubType();
        }
        if (null !== $object->getKeywordType()) {
            $data->{'keyword_type'} = $object->getKeywordType();
        }
        if (null !== $object->getKeywordValue()) {
            $data->{'keyword_value'} = $object->getKeywordValue();
        }
        if (null !== $object->getHttpUsername()) {
            $data->{'http_username'} = $object->getHttpUsername();
        }
        if (null !== $object->getHttpPassword()) {
            $data->{'http_password'} = $object->getHttpPassword();
        }
        if (null !== $object->getPort()) {
            $data->{'port'} = $object->getPort();
        }
        if (null !== $object->getInterval()) {
            $data->{'interval'} = $object->getInterval();
        }
        if (null !== $object->getStatus()) {
            $data->{'status'} = $object->getStatus();
        }
        if (null !== $object->getCreateDatetime()) {
            $data->{'create_datetime'} = $object->getCreateDatetime();
        }
        if (null !== $object->getMonitorGroup()) {
            $data->{'monitor_group'} = $object->getMonitorGroup();
        }
        if (null !== $object->getIsGroupMain()) {
            $data->{'is_group_main'} = $object->getIsGroupMain();
        }
        if (null !== $object->getLogs()) {
            $values = array();
            foreach ($object->getLogs() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data->{'logs'} = $values;
        }
        return $data;
    }
}