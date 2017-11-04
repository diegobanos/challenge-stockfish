<?php
namespace FrontBundle\Command;

use FrontBundle\Twitter\Stream\Reader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TwitterStreamCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
          ->setName('stream:start')
          ->setDescription('Starts reading the Twitter Stream')
          ->setHelp('This command will start reading the Twitter Stream')
        ;
        
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $reader = $this->getStreamReader();
        $reader->readStream();
    }
    
    protected function getStreamReader() : Reader
    {
        return $this->getContainer()->get('front.stream_reader');
    }
}
