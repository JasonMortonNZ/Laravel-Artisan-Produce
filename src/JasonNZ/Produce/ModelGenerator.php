<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem as Filesystem;

class ModelGenerator extends BaseGenerator
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
     * Generate required folders and files
     *
     * @return void
     */
    public function generate($name)
    {
        $this->name = ucfirst($name);
        $this->namespace = $this->config->get('produce::models_namespace');

        if ($this->shouldCreate($this->config->get('produce::models'))) {
            $path = $this->config->get('produce::models_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
            }
            $this->createModelFile();
        }
    }

    /**
     * Create model file.
     *
     * @return void
     */
    protected function createModelFile()
    {
        $path = $this->config->get('produce::models_path') . "/" . $this->name . '.php';
        $options = array(
            'name' => ucfirst($this->name)
        );
        $this->namespace != "" ? $options['namespace'] = 'namespace ' . $this->namespace . ';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'model');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }
    }
}
