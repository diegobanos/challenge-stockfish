<?php
namespace FrontBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="player")
 * @ORM\Entity
 */
class Player
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", name="user_id") 
     */
    private $userId;
    
    /**
     * @var string 
     * 
     * @ORM\Column(type="string", name="name")
     */
    private $name;
    
    /**
     * @var DateTime
     * 
     * @ORM\Column(type="datetime", name="created_at") 
     */
    private $createdAt;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Game", mappedBy="player")
     */
    private $games;
    
    public function __construct()
    {
        $this->games = new ArrayCollection;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getLastGame()
    {
        return $this->games->last();
    }
    
    public function setUserId(string $userId) : Player
    {
        $this->userId = $userId;
        return $this;
    }
    
    public function setName(string $name) : Player
    {
        $this->name = $name;
        return $this;
    }
    
    public function setCreatedAt(DateTime $createdAt) : Player
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
