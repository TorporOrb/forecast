<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:symfony-style',
    description: 'Add a short description for your command',
)]
class SymfonyStyleCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // $io->writeln("This is the writeln.");
        // $io->title('This is a title.');
        // $io->section('This is a section.');

        // $io->note('This is a note');
        // $io->warning('This is a warning');
        // $io->success('This is a succes');
        // $io->error('This is an error');
        // $io->info('This is info');
        // $io->caution('This is a caution');

        // $name = $io->ask('What is your name?');
        // $output->writeln("Hello " . $name);

        // $password = $io->askHidden('What is your password');
        // $output->writeln($password);

        // $result = $io->confirm('Are you sure?');
        // $output->writeln($result ? "Yes" : "No");

        // $result = $io->choice('What is the corect answer?', ['A', 'B', 'C']);
        // $output->writeln($result);

        // $items = ['apple', 'pear', 'pineapple'];
        // $io->listing($items);

        // $io->table(['Name', 'Country'], [
        //     ['Stettin', 'PL'],
        //     ['Warsaw', 'PL'],
        //     ['Berlin', 'DE'],
        // ]);

        $items = ['apple', 'pear', 'pineapple', 'plum'];
        $io->progressStart(4);
        foreach ($items as $item){
            $io->progressAdvance();
            sleep(2);
        }
        $io->progressFinish();





        
        return Command::SUCCESS;
    }
}
