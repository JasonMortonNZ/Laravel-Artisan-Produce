<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Pluralizer as Pluralizer;
use Illuminate\Filesystem\Filesystem as Filesystem;

class MigrationGenerator extends BaseGenerator
{
    /**
     * Constructor
     *
     * @param Config     $config
     * @param Filesystem $filesystem
     */
    public function __construct(Config $config, Filesystem $filesystem)
    {
        $this->config = $config;
        $this->filesystem = $filesystem;
    }

    /**
     * Generate required repositories folders and files
     *
     * @return void
     */
    public function generate($name)
    {
        $this->name = $name;
        $this->namespace = $this->config->get('produce::migrations_namespace');

        if ($this->shouldCreate($this->config->get('produce::migrations'))) {
            $path = $this->config->get('produce::migrations_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
            }
            $this->createMigrationFile();
        }
    }

    /**
     * Create migration file.
     *
     * @return void
     */
    protected function createMigrationFile()
    {
        $fileName = $this->createMigrationFileName($this->name);
        $path = $this->config->get('produce::migrations_path') . "/" . $fileName . '.php';
        $options = array(
            'name' => ucfirst($this->name),
            'tableNameLower' => lcfirst(Pluralizer::plural($this->name)),
            'tableNameUpper' => ucfirst(Pluralizer::plural($this->name))
        );
        $this->namespace != "" ? $options['namespace'] = 'namespace ' . $this->namespace . ';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'migration');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }
    }

    protected function createMigrationFileName($name)
    {
        $options = array(
            'year' => date('Y'),
            'month' => '_'.date('m'),
            'day' => '_'.date('d'),
            'time' => '_'.date('His'),
            'text' => '_create_'.strtolower($name).'_table'
        );
        return implode('', $options);
    }
}
