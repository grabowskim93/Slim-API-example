<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * AccessTokens
 *
 * @ORM\Table(name="access_tokens")
 * @ORM\Entity
 */
class AccessTokens
{
    /**
     * @var integer
     *
     * @ORM\Column(name="beer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $beerId;

    /**
     * @var string
     *
     * @ORM\Column(name="access_tokens", type="string", length=250, nullable=false)
     */
    private $accessTokens;

    /**
     * @return int
     */
    public function getBeerId()
    {
        return $this->beerId;
    }

    /**
     * @param int $beerId
     */
    public function setBeerId($beerId)
    {
        $this->beerId = $beerId;
    }

    /**
     * @return string
     */
    public function getAccessTokens()
    {
        return $this->accessTokens;
    }

    /**
     * @param string $accessTokens
     */
    public function setAccessTokens($accessTokens)
    {
        $this->accessTokens = $accessTokens;
    }


    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}

