<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem as Filesystem;

class ControllerGenerator extends BaseGenerator
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
        $this->namespace = $this->config->get('produce::controllers_namespace');

        if ($this->shouldCreate($this->config->get('produce::controllers'))) {
            $path = $this->config->get('produce::controllers_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
            }
            $this->createControllerFile();
        }
    }

    /**
     * Create controller file.
     *
     * @return void
     */
    protected function createControllerFile()
    {
        $path = $this->config->get('produce::controllers_path') . "/" . ucfirst($this->singularName) . 'Controller.php';
        $options = array(
            'name' => ucfirst($this->singularName),
            'nameLower' => strtolower($this->singularName)
        );
        $this->namespace != "" ? $options['namespace'] = 'namespace ' . $this->namespace . ';' : $options['namespace'] = '';
        $this->config->get('produce::repositories_namespace') != '' ? $options['useRepoNamespace'] = 'use '.$this->config->get('produce::repositories_namespace').'\\'.ucfirst($this->singularName).'Repository;' : $options['useRepoNamespace'] = '';
        $data = $this->prepareData($options, 'controller');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }
    }
}
