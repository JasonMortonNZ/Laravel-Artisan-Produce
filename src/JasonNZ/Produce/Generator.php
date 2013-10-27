<?php namespace JasonNZ\Produce;

class Generator
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Generate resouces
     *
     * @return void
     */
    public function generateAll()
    {
        $this->generateRepository();
        $this->generateModel();
        $this->generateMigration();
        $this->generateSeed();
        $this->generateViews();
        $this->generateController();
        $this->generateComposer();
        $this->generateValidator();
        $this->generateTests();
    }

    /**
     * Generate repository file
     *
     * @return void
     */
    public function generateRepository()
    {
        $repositoryGenerator = \App::make('RepositoryGenerator');

        return $repositoryGenerator->generate($this->name);
    }

    /**
     * Generate model file
     *
     * @return void
     */
    public function generateModel()
    {
        $modelGenerator = \App::make('ModelGenerator');

        return $modelGenerator->generate($this->name);
    }

    /**
     * Generate migration file
     *
     * @return void
     */
    public function generateMigration()
    {
        $migrationGenerator = \App::make('MigrationGenerator');

        return $migrationGenerator->generate($this->name);
    }

    /**
     * Generate seed file
     *
     * @return void
     */
    public function generateSeed()
    {
        $seedGenerator = \App::make('SeedGenerator');

        return $seedGenerator->generate($this->name);
    }

    /**
     * Generate view files
     *
     * @return void
     */
    public function generateViews()
    {
        $viewsGenerator = \App::make('ViewGenerator');

        return $viewsGenerator->generate($this->name);
    }

    /**
     * Generate controller file
     *
     * @return void
     */
    public function generateController()
    {
        $controllerGenerator = \App::make('ControllerGenerator');

        return $controllerGenerator->generate($this->name);
    }

    /**
     * Generate view composer file
     *
     * @return void
     */
    public function generateComposer()
    {
        $composerGenerator = \App::make('ComposerGenerator');

        return $composerGenerator->generate($this->name);
    }

    /**
     * Generate validator file
     *
     * @return void
     */
    public function generateValidator()
    {
        $validatorGenerator = \App::make('ValidatorGenerator');

        return $validatorGenerator->generate($this->name);
    }

    /**
     * Generate test files
     *
     * @return void
     */
    public function generateTests()
    {
        $testsGenerator = \App::make('TestGenerator');

        return $testsGenerator->generate($this->name);
    }
}
