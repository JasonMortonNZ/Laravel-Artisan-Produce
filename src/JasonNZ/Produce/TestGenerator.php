<?php namespace JasonNZ\Produce;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem as Filesystem;

class TestGenerator extends BaseGenerator
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
     * Generate required test files
     *
     * @return void
     */
    public function generate($name)
    {
        $this->name = $name;

        if ($this->shouldCreate($this->config->get('produce::tests'))) {
            $path = $this->config->get('produce::tests_path');
            if (! $this->folderExists($path)) {
                $this->createFolder($path);
            }
            $this->createTestFiles();
        }
    }

    /**
     * Create test files.
     *
     * @return void
     */
    protected function createTestFiles()
    {
        $path = $this->config->get('produce::tests_path') . '/' . ucfirst($this->name) . 'Test.php';
        $options = array(
            'name' => ucfirst($this->name)
        );
        $this->namespace != "" ? $options['namespace'] = 'namespace '.$this->namespace.';' : $options['namespace'] = '';
        $data = $this->prepareData($options, 'test');

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $data);
        }
    }
}
