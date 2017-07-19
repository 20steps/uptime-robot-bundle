<?php

namespace twentysteps\Commons\UptimeRobotBundle\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers = array();
        $normalizers[] = new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer();
        $normalizers[] = new ErrorNormalizer();
        $normalizers[] = new PaginationNormalizer();
        $normalizers[] = new AccountDetailsResponseNormalizer();
        $normalizers[] = new AccountNormalizer();
        $normalizers[] = new GetMonitorsResponseNormalizer();
        $normalizers[] = new MonitorResponseNormalizer();
        $normalizers[] = new MonitorNormalizer();
        $normalizers[] = new LogNormalizer();
        $normalizers[] = new ResponseTimeNormalizer();
        $normalizers[] = new GetAlertContactsResponseNormalizer();
        $normalizers[] = new AlertContactResponseNormalizer();
        $normalizers[] = new AlertContactUnderscoreResponseNormalizer();
        $normalizers[] = new AlertContactNormalizer();
        $normalizers[] = new GetMWindowsResponseNormalizer();
        $normalizers[] = new MWindowResponseNormalizer();
        $normalizers[] = new MWindowNormalizer();
        $normalizers[] = new GetPSPsResponseNormalizer();
        $normalizers[] = new PSPResponseNormalizer();
        $normalizers[] = new PSPNormalizer();
        return $normalizers;
    }
}