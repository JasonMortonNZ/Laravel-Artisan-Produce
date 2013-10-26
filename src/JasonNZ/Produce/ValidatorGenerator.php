<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem as Filesystem;

class ValidatorGenerator extends BaseGenerator
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
        $this->setNames($name);
        $this->namespace = $this->config->get('produce::validators_namespace');

        if ($this->shouldCreate($this->config->get('produce::validators'))) {
            $path = $this->config->get('produce::validators_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
                $this->createBaseValidator($path);
            }
            $this->createValidatorFile();
        }
    }

    /**
     * Create validator file.
     *
     * @return void
     */
    protected function createValidatorFile()
    {
        $path = $this->config->get('produce::validators_path') . "/" . ucfirst($this->singularName) . 'Validator.php';
        $options = array(
            'name' => ucfirst($this->singularName)
        );
        $this->namespace != "" ? $options['namespace'] = 'namespace '.$this->namespace.';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'validator');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }
    }

    /**
     * Create base validator file
     *
     * @param  string $path
     * @return void
     */
    protected function createBaseValidator($path)
    {
        $filePath = $path . '/BaseValidator.php';
        $this->namespace != "" ? $options['namespace'] = 'namespace '.$this->namespace.';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'baseValidator');

        $this->filesystem->put($filePath, $data);
    }
}
