<?php
declare(strict_types=1);

namespace Dev\CountryTime\Service;

use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

/**
 * FormatTime Service
 */
class FormatTime
{
    /**
     * @var TimezoneInterface
     */
    protected TimezoneInterface $timezone;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @param TimezoneInterface $timezone
     * @param string|null $countryCode
     */
    public function __construct(
        TimezoneInterface $timezone,
        ?string $countryCode = ''
    ) {
        $this->timezone = $timezone;
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        $timezone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $this->countryCode);
        date_default_timezone_set($timezone[0]);

        return date('d-m-Y h:i:s a', time());
    }
}
