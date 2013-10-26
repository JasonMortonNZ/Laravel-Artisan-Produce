<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem as Filesystem;

class ViewGenerator extends BaseGenerator
{
    /**
     * View to extend
     *
     * @var string
     */
    protected $extends;

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
        $this->extends = $this->config->get('produce::views_extend');

        if ($this->shouldCreate($this->config->get('produce::views'))) {
            $path = $this->config->get('produce::views_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
            }
            $this->createViewFiles();
        }
    }

    /**
     * Create view files and folders.
     *
     * @return void
     */
    protected function createViewFiles()
    {
        $folderName = $this->config->get('produce::views_path') . '/' . strtolower($this->singularName);
        $fileNames = array('index', 'show', 'create', 'edit');

        if (! $this->folderExists($folderName)) {
            $this->createFolder($folderName);
        }

        foreach ($fileNames as $file) {
            $path = $folderName . '/' . $file . '.blade.php';
            $options = array('extends' => strtolower($this->extends));
            $data = $this->prepareData($options, 'view');

            if (! $this->filesystem->exists($path)) {
                $this->filesystem->put($path, $data);
            }

        }
    }
}
