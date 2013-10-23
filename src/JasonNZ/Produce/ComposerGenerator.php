<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem as Filesystem;

class ComposerGenerator extends BaseGenerator
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
        $this->namespace = $this->config->get('produce::composers_namespace');

        if ($this->shouldCreate($this->config->get('produce::composers'))) {
            $path = $this->config->get('produce::composers_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
            }
            $this->createComposerFile();
            $this->checkComposerInitFileExists();
            $this->updateComposersInitFile();
        }
    }

    /**
     * Create composer file.
     *
     * @return void
     */
    protected function createComposerFile()
    {
        $path = $this->config->get('produce::composers_path') . "/" . ucfirst($this->name) . 'Composer.php';
        $options = array(
            'name' => ucfirst($this->name)
        );
        $this->namespace != "" ? $options['namespace'] = 'namespace '.$this->namespace.';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'composer');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }
    }

    /**
     * Check to see if view composer initiation file exists.
     * If not create it.
     *
     * @return void
     */
    protected function checkComposerInitFileExists()
    {
        $path = $this->config->get('produce::composers_path').'/composers.php';
        if (! $this->filesystem->exists($path)) {
            $this->createComposersInitFile($path);
        }
    }

    /**
     * Create view composers initiation file
     *
     * @param  string $path
     * @return void
     */
    protected function createComposersInitFile($path)
    {
        $options = array();
        $this->namespace != "" ? $options['namespace'] = 'namespace '.$this->namespace.';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'composerInit');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }
    }

        /**
    * Updates the view composers initiation file to
    * include new view composer.
    *
    * @return void
    */
    public function updateComposersInitFile()
    {
        $path = $this->config->get('produce::composers_path').'/composers.php';
        $composerNamespace = $this->config->get('produce::composers_namespace').'\\'.ucfirst($this->name).'Composer';
        $viewName = strtolower($this->name).'.index';
        $data = "View::composer('{$viewName}', '{$composerNamespace}');\n";

        $this->filesystem->append($path, $data);
    }
}
