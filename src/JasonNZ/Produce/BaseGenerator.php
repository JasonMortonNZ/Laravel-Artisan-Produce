<?php namespace JasonNZ\Produce;

abstract class BaseGenerator
{
        /**
     * Class & file name
     *
     * @var string
     */
    protected $name;

    /**
     * Namespace
     *
     * @var string
     */
    protected $namespace;

    /**
     * Configuration object
     *
     * @var Config
     */
    protected $config;

    /**
     * Filesystem object
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Determine if resouce should be generated, from config entry.
     *
     * @param  bool $resource
     * @return bool
     */
    public function shouldCreate($resource)
    {
        return $resource == true ? true : false;
    }

    /**
     * Check to see if folder exists.
     *
     * @param  string $folderName
     * @return bool
     */
    public function folderExists($folderName)
    {
        if ($this->filesystem->exists($folderName)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check to see if file exists.
     *
     * @param  string $fileName
     * @return bool
     */
    public function fileExists($fileName)
    {
        return $this->folderExists($fileName);
    }

    /**
     * Create a folder
     *
     * @param  string $path
     * @return void
     */
    public function createFolder($path)
    {
        $this->filesystem->makeDirectory($path, 0777, true, true);
    }

    /**
     * Prepare data to write to file.
     *
     * @var $options array
     * @var $dataType string
     * @return string
     */
    public function prepareData($options, $dataType)
    {
        $data = $this->filesystem->get(__DIR__ . '/templates/' . $dataType . 'Template.txt');
        foreach ($options as $key => $value) {
            $data = str_replace('{{'.$key.'}}', $value, $data);
        }

        return $data;
    }
}
