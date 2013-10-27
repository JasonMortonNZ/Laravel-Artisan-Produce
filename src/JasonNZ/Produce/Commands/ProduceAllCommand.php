<?php namespace JasonNZ\Produce\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use JasonNZ\Produce\Generator as Generator;

class ProduceAllCommand extends Command {

	/**
	 * The console command name
	 *
	 * @var string
	 */
	protected $name = 'produce:all';

	/**
	 * The consolse command description
	 *
	 * @var string
	 */
	protected $description = 'Produce all resources based on your requirements';

	/**
	 * Execute the console command
	 *
	 * @return void
	 */
	public function fire()
	{
		$generator = new Generator($this->argument('name'));
		return $generator->generateAll();
	}

	/**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of resource to generate.')
        );
    }

}