<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 11.12.2020
 */

namespace App\Common;

/**
 * Class ApplicationContext
 *
 * @package App\Common
 */
class ApplicationContext
{
    /**
     * @var bool
     */
    protected bool $isApiRequest;

    /**
     * @var string
     */
    protected string $locale;

    /**
     * ApplicationContext constructor.
     *
     * @param bool $isApiRequest
     * @param string $locale
     */
    public function __construct(bool $isApiRequest, string $locale)
    {
        $this->isApiRequest = $isApiRequest;
        $this->locale = $locale;
    }

    /**
     * @return bool
     */
    public function isApiRequest(): bool
    {
        return $this->isApiRequest;
    }

    /**
     * @param bool $isApiRequest
     *
     * @return ApplicationContext
     */
    public function setIsApiRequest(bool $isApiRequest): ApplicationContext
    {
        $this->isApiRequest = $isApiRequest;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     *
     * @return ApplicationContext
     */
    public function setLocale(string $locale): ApplicationContext
    {
        $this->locale = $locale;

        return $this;
    }


}
