<?php

namespace Dev\CountryTime\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Block
 */
class CountryTime extends Template
{
    /**
     * @var string
     */
    protected $_template = 'Dev_CountryTime::country-time.phtml';

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getSyncTimeUrl()
    {
        return $this->getUrl('country_time/index/changetime');
    }

    /**
     * @return array
     */
    public function getListCountry()
    {
        return [
            '' => 'Choose Country',
            'us' => 'America',
            'vn' => 'VietName'
        ];
    }

}
