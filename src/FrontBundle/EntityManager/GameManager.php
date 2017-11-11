<?php
namespace FrontBundle\EntityManager;

use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use FrontBundle\Entity\Game;
use FrontBundle\Entity\Player;
use FrontBundle\Event\NewStatusEvent;

class GameManager
{
    /**
     * @var EntityManager 
     */
    private $em;
    
    /**
     * @var EntityRepository 
     */
    private $gameRepository;
    
    /**
     * @var PlayerManager 
     */
    private $playerManager;
    
    public function __construct(EntityManager $em, playerManager $playerManager)
    {
        $this->em = $em;
        $this->gameRepository = $em->getRepository(Game::class);
        $this->playerManager = $playerManager;
    }
    
    public function onStatusNew(NewStatusEvent $event)
    {
        $player = $this->playerManager->findPlayerByUserId($event->getUserId());
        $game = $player->getLastGame();
        
        if (false === $game) {
            $game = $this->createGame($player);
        }
        
        $this->saveGame($game);
    }
    
    public function createGame(Player $player) : Game
    {
        $game = new Game;
        $game
            ->setPlayer($player)
            ->setMoves('startpos ')
            ->setStartedAt(new DateTime)
            ->setTurn(Game::HUMAN_TURN)
        ;
        
        return $game;
    }
    
    public function saveGame(Game $game)
    {
        if (null !== $game->getId()) {
            $this->em->persist($game);
        } else {
            $this->em->merge($game);
        }
        
        $this->em->flush();
    }
}
