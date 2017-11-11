<?php
namespace FrontBundle\Command;

use FrontBundle\EntityManager\StreamRequestManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DebugRequestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('request:debug')
            ->setDescription('Prints a stream request ')
            ->setHelp('This command will print a request by id')
            ->addArgument('id', InputArgument::REQUIRED, 'which stream do you want to read?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $streamRequestManager = $this->getStreamRequestManager();
        
        $streamRequest = $streamRequestManager->findStreamRequestById($id);
        
        dump(json_decode($streamRequest->getStatus(), true));
    }
    
    protected function getStreamRequestManager() : StreamRequestManager
    {
        return $this->getContainer()->get('front.stream_request_manager');
    }
}
