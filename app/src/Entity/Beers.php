<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Beers
 *
 * @ORM\Table(name="beers")
 * @ORM\Entity
 */
class Beers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="IBU", type="integer", nullable=false)
     */
    private $ibu;

    /**
     * @var integer
     *
     * @ORM\Column(name="Gravity", type="integer", nullable=false)
     */
    private $gravity;

    /**
     * @var integer
     *
     * @ORM\Column(name="Color (SRM)", type="integer", nullable=false)
     */
    private $color;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getIbu()
    {
        return $this->ibu;
    }

    /**
     * @param int $ibu
     */
    public function setIbu($ibu)
    {
        $this->ibu = $ibu;
    }

    /**
     * @return int
     */
    public function getGravity()
    {
        return $this->gravity;
    }

    /**
     * @param int $gravity
     */
    public function setGravity($gravity)
    {
        $this->gravity = $gravity;
    }

    /**
     * @return int
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param int $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


}

