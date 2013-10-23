<?php namespace JasonNZ\Produce\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use JasonNZ\Produce\Generator as Generator;

class ProduceCommand extends Command {

	/**
	 * The console command name
	 *
	 * @var string
	 */
	protected $name = 'produce';

	/**
	 * The consolse command description
	 *
	 * @var string
	 */
	protected $description = 'Produce a set of resources.';

	/**
	 * Execute the console command
	 *
	 * @return void
	 */
	public function fire()
	{
		$generator = new Generator($this->argument('name'));
		return $this->info($generator->generate());
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

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('namespace', null, InputOption::VALUE_OPTIONAL, 'Name of the resource to generate.')
        );
    }

}