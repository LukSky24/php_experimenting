<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 24.11.2020
 */

namespace App\Users\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Application
 *
 * @package App\Users\Entities
 *
 * @ORM\Entity(repositoryClass="App\Users\Repositories\ApplicationRepository")
 */
class Application extends AbstractUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string", length=128, options={"fixed"=true})
     */
    protected string $apiKey;

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return Application
     */
    public function setApiKey(string $apiKey): Application
    {
        $this->apiKey = $apiKey;

        return $this;
    }

}
