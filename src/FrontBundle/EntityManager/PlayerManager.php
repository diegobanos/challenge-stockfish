<?php
namespace FrontBundle\EntityManager;

use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use FrontBundle\Entity\Player;
use FrontBundle\Event\NewStatusEvent;

class PlayerManager
{
    /**
     * @var EntityManager
     */
    private $em;
    
    /**
     * @var EntityRepository 
     */
    private $playerRepository;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->playerRepository = $em->getRepository(Player::class);
    }
    
    public function findPlayerByUserId(string $userId) : Player
    {
        return $this->playerRepository->findOneBy(['userId' => $userId]);
    }

    
    public function onStatusNew(NewStatusEvent $event)
    {
        $player = $this->playerRepository->findOneBy(['userId' => $event->getUserId()]);
        
        if (!isset($player)) {
            $player = $this->createPlayer($event->getUserId(), $event->getUserName());
        }
        
        $this->savePlayer($player);
    }
     
    public function createPlayer(string $userId, string $name) : Player
    {
        $player = new Player;
        $player
            ->setUserId($userId)
            ->setName($name)
            ->setCreatedAt(new DateTime)
        ;
        
        return $player;
    }
    
    public function savePlayer(Player $player)
    {
        if (null !== $player->getId()) {
            $this->em->persist($player);
        } else {
            $this->em->merge($player);
        }
        
        $this->em->flush();
    }
}
