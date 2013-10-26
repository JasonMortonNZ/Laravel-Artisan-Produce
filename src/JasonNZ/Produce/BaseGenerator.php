<?php namespace JasonNZ\Produce;

use Illuminate\Support\Pluralizer;

abstract class BaseGenerator
{
    /**
     * Class & file name
     *
     * @var string
     */
    protected $name;

    /**
     * Singular resource name
     *
     * @var string
     */
    protected $singularName;

    /**
     * Plural resource name
     *
     * @var string
     */
    protected $pluralName;

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
     * Set names ($name, $singularName, $pluralName)
     *
     * @param string $name
     */
    protected function setNames($name)
    {
        $this->name = strtolower($name);
        $this->singularName = Pluralizer::singular($this->name);
        $this->pluralName = Pluralizer::plural($this->name);
    }

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
