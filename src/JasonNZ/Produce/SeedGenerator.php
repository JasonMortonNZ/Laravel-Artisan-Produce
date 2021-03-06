<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Pluralizer as Pluralizer;
use Illuminate\Filesystem\Filesystem as Filesystem;

class SeedGenerator extends BaseGenerator
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
        $this->setNames($name);
        $this->namespace = $this->config->get('produce::seeds_namespace');

        if ($this->shouldCreate($this->config->get('produce::seeds'))) {
            $path = $this->config->get('produce::seeds_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
            }
            $this->createSeedFile();
        }
    }

    /**
     * Create seed file.
     *
     * @return void
     */
    protected function createSeedFile()
    {
        $path = $this->config->get('produce::seeds_path') . "/" . ucfirst($this->pluralName) . 'TableSeeder.php';
        $options = array(
            'name' => ucfirst($this->singularName),
            'tableNameLower' => strtolower($this->pluralName),
            'tableNameUpper' => ucfirst($this->pluralName)
        );
        $this->namespace != "" ? $options['namespace'] = 'namespace ' . $this->namespace . ';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'seed');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }

        $this->updateDatabaseSeederRunMethod($options['tableNameUpper'].'TableSeeder');
    }

    /**
    * Updates the DatabaseSeeder file's run method to
    * call this new seed class
    *
    * @return void
    */
    public function updateDatabaseSeederRunMethod($className)
    {
        $databaseSeederPath = app_path() . '/database/seeds/DatabaseSeeder.php';

        $content = $this->filesystem->get($databaseSeederPath);

        if (! strpos($content, "\$this->call('{$className}');")) {
            $content = preg_replace("/(run\(\).+?)}/us", "$1\t\$this->call('{$className}');\n\t}", $content);
            return $this->filesystem->put($databaseSeederPath, $content);
        }
    }
}
