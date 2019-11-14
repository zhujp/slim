<?php
namespace app\console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class User extends Command
{
    protected function configure()
    {
        $this
            // 命令的名称 （"php console" 后面的部分）
            ->setName('user')
            // 运行 "php console_command list" 时的简短描述
            ->setDescription('Create new user')
            // 运行命令时使用 "--help" 选项时的完整命令描述
            ->setHelp('This command allow you to create User...')
            // 配置一个参数
            ->addArgument('username', InputArgument::REQUIRED, 'what\'s User you want to create ?')
            ->addArgument('age', InputArgument::REQUIRED, 'what\'s User you want to create ?')
            // 配置一个可选参数
            ->addArgument('sex', InputArgument::OPTIONAL, 'this is a optional argument');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $optional_argument = $input->getArgument('sex');

        $output->writeln('creating...');
        $output->writeln('created ' . $input->getArgument('username') . $input->getArgument('age') .' user success !');

        if ($optional_argument)
            $output->writeln('optional argument is ' . $optional_argument);

        $output->writeln('the end.');
    }
}