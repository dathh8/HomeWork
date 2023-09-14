<?php
declare(strict_types=1);

namespace Dev\CountryTime\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\ObjectManagerInterface;
use Monolog\Logger;

class ChangeTime implements HttpGetActionInterface
{
    /**
     * @var JsonFactory
     */
    protected JsonFactory $resultJsonFactory;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     * @var array
     */
    protected $formatTime;

    /**
     * @var ObjectManagerInterface
     */
    protected ObjectManagerInterface $objectManager;

    /**
     * @param JsonFactory $resultJsonFactory
     * @param RequestInterface $requestInterface
     * @param Logger $logger
     * @param ObjectManagerInterface $objectManager
     * @param array $formatTime
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        RequestInterface $requestInterface,
        Logger $logger,
        ObjectManagerInterface $objectManager,
        array $formatTime = []
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $requestInterface;
        $this->logger = $logger;
        $this->objectManager = $objectManager;
        $this->formatTime = $formatTime;
    }

    /**
     * Execute controller action.
     */
    public function execute()
    {
        $country = $this->request->getParam('country', '');
        $formatClass = $this->formatTime[$country] ?? false;
        $timeByCountry = $formatClass ? $formatClass->getTime() : '';
        $this->logger->critical("Log for Country Time", ['country' => $country, 'time' => $timeByCountry]);
        return $this->resultJsonFactory->create()->setData($timeByCountry);
    }
}
