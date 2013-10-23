<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem as Filesystem;

class RepositoryGenerator extends BaseGenerator
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
        $this->namespace = $this->config->get('produce::repositories_namespace');

        if ($this->shouldCreate($this->config->get('produce::repositories'))) {
            $path = $this->config->get('produce::repositories_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
            }
            $this->createRepositoryFile();
        }
    }

    /**
     * Create repository file.
     *
     * @return void
     */
    protected function createRepositoryFile()
    {
        $path = $this->config->get('produce::repositories_path') . "/" . $this->name . 'Repository.php';
        $options = array(
            'name' => ucfirst($this->name)
        );
        $this->namespace != "" ? $options['namespace'] = 'namespace ' . $this->namespace . ';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'repository');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }
    }
}
