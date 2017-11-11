<?php
namespace FrontBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="game")
 * @ORM\Entity
 */
class Game
{
    const MACHINE_TURN = 0;
    
    const HUMAN_TURN = 1;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var Player
     * 
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="games")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", name="moves") 
     */
    private $moves;
    
    /**
     * @var int
     * 
     * @ORM\Column(type="smallint", name="turn") 
     */
    private $turn;
    
    /**
     * @var DateTime
     * 
     * @ORM\Column(type="datetime", name="started_at") 
     */
    private $startedAt;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setPlayer(Player $player) : Game
    {
        $this->player = $player;
        return $this;
    }
    
    public function setMoves(string $moves) : Game
    {
        $this->moves = $moves;
        return $this;
    }
    
    public function setTurn(int $turn) : Game
    {
        $this->turn = $turn;
        return $this;
    }
    
    public function setStartedAt(DateTime $startedAt) : Game
    {
        $this->startedAt = $startedAt;
        return $this;
    }
}