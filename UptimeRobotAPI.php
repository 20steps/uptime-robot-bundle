<?php

namespace twentysteps\Commons\UptimeRobotBundle;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\RequestInterface;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;

use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Message\MessageFactory\GuzzleMessageFactory;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use function GuzzleHttp\Psr7\stream_for;

use twentysteps\Commons\EnsureBundle\Ensure;
use twentysteps\Commons\UptimeRobotBundle\Resource\AccountDetailsResource;
use twentysteps\Commons\UptimeRobotBundle\Resource\WrappedAlertContactResource;
use twentysteps\Commons\UptimeRobotBundle\Resource\WrappedMonitorResource;
use twentysteps\Commons\UptimeRobotBundle\Resource\MWindowResource;
use twentysteps\Commons\UptimeRobotBundle\Resource\PSPResource;

use twentysteps\Commons\UptimeRobotBundle\Normalizer\NormalizerFactory;

/**
 * Class UptimeRobotAPI
 *
 * The central entrypoint to all resources provided by this API.
 *
 * E.g. use monitors()->all() to list all monitors configured at your UptimeRobot.com account.
 *
 * @package twentysteps\Commons\UptimeRobotBundle
 */
class UptimeRobotAPI {
	
	/**
	 * @var LoggerInterface
	 */
	protected $logger;
	
	/**
	 * @var Stopwatch
	 */
	protected $stopwatch;
	
	/**
	 * @var string
	 */
	protected $apiKey;
	
	// initialize
	
    public function __construct(LoggerInterface $logger, string $apiKey, Stopwatch $stopwatch = null) {
		$this->logger = $logger;
		$this->apiKey = $apiKey;
		$this->stopwatch = $stopwatch;
    }
	
    // public API
	
	/**
	 * @return AccountDetailsResource
	 */
	public function accountDetails() {
		// create the resource
		return new AccountDetailsResource($this->getHTTPClient(),$this->getMessageFactory(),$this->getSerializer());
	}
	
	/**
	 * @return WrappedMonitorResource
	 */
	public function monitor() {
		return new WrappedMonitorResource($this->getHTTPClient(),$this->getMessageFactory(),$this->getSerializer());
	}
	
	/**
	 * @return AlertContactResource
	 */
	public function alertContact() {
		// create the resource
		return new WrappedAlertContactResource($this->getHTTPClient(),$this->getMessageFactory(),$this->getSerializer());
	}
	
	/**
	 * @return MWindowResource
	 */
	public function maintenanceWindow() {
		// create the resource
		return new MWindowResource($this->getHTTPClient(),$this->getMessageFactory(),$this->getSerializer());
	}
	
	/**
	 * @return PSPResource
	 */
	public function publicStatusPage() {
		// create the resource
		return new PSPResource($this->getHTTPClient(),$this->getMessageFactory(),$this->getSerializer());
	}
	
	
	/**
	 * @return mixed
	 */
	public function getApiKey() {
		return $this->apiKey;
	}
	
	/**
	 * @param mixed $apiKey
	 * @return UptimeRobotAPI
	 */
	public function setApiKey($apiKey) {
		$this->apiKey = $apiKey;
		
		return $this;
	}
	
	// helpers
	
	/**
	 * @param array $config
	 * @return GuzzleAdapter
	 */
	protected function getHTTPClient($config = []) {
		Ensure::isTrue(is_array($config),'config parameter must be an array');
		
		// configure base uri
		$config['base_uri'] = 'https://api.uptimerobot.com';
		
		// add some default headers
		if (!array_key_exists('headers',$config)) {
			$config['headers']=[];
		}
		$config['headers']['cache-control'] = 'no-cache';
		$config['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
		
		// add api_key to all requests if POST and x-www-form-urlencoded
		$handlerStack = new HandlerStack();
		$handlerStack->setHandler(new CurlHandler());
		$handlerStack->unshift(Middleware::mapRequest(function (RequestInterface $request) {
			if ($request->getMethod() == 'POST' && $request->getHeader('Content-Type')[0] == 'application/x-www-form-urlencoded') {
				return new Request(
					$request->getMethod(),
					$request->getUri(),
					$request->getHeaders() + ['Content-Type' => 'application/x-www-form-urlencoded'],
					stream_for($request->getBody() . '&' . http_build_query(['api_key' => $this->getApiKey()])),
					$request->getProtocolVersion()
				);
			}
			return $request;
		}));
		$config['handler'] = $handlerStack;
		
		// create HTTPlug client, message factory and serializer
		return GuzzleAdapter::createWithConfig($config);
	}
	
	/**
	 * @return GuzzleMessageFactory
	 */
	protected function getMessageFactory() {
		return new GuzzleMessageFactory();
	}
	
	/**
	 * @return Serializer
	 */
	protected function getSerializer() {
		return new Serializer(
			NormalizerFactory::create(),
			[
				new JsonEncoder(
					new JsonEncode(),
					new JsonDecode()
				)
			]
		);
	}
	
}