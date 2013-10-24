<?php

return array(

    /**
     * Here are the configuration setting for the:
     *     - php artisan produce <name>
     * command. Sensible defaults have been provided,
     * but feel free to change any of them.
     */

    /*=====================================================
     * Repositories Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create repositories? (true|false)
     * | Where should the repositories be stored? (string)
     * | Which namespace should repositories be given? (empty|string)
     */
    'repositories' => true,
    'repositories_path' => app_path().'/acme/repositories',
    'repositories_namespace' => 'Acme\Repositories',

    /*=====================================================
     * Models Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create models? (true|false)
     * | Where should the models be stored? (string)
     * | Which namespace should models be given? (empty|string)
     */
    'models' => true,
    'models_path' => app_path().'/acme/models',
    'models_namespace' => 'Acme\Models',

    /*=====================================================
     * Controllers Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create controllers? (true|false)
     * | Where should the controllers be stored? (string)
     * | Which namespace should controllers be given? (empty|string)
     */
    'controllers' => true,
    'controllers_path' => app_path().'/acme/controllers',
    'controllers_namespace' => 'Acme\Controllers',

    /*=====================================================
     * Views Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create views? (true|false)
     * | Where should the views be stored? (string)
     * | Which master views should views extends? (empty|string)
     */
    'views' => true,
    'views_path' => app_path().'/acme/views',
    'views_extend' => 'master',

    /*=====================================================
     * View Composers Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create view composers? (true|false)
     * | Where should the view composers be stored? (string)
     * | Which namespace should view composers be given? (empty|string)
     */
    'composers' => true,
    'composers_path' => app_path().'/acme/composers',
    'composers_namespace' => 'Acme\Composers',

    /*=====================================================
     * Migrations Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create migrations? (true|false)
     * | Where should the migrations be stored? (string)
     * | Which namespace should migrations be given? (empty|string)
     */
    'migrations' => true,
    'migrations_path' => app_path().'/acme/database/migrations',
    'migrations_namespace' => '',

    /*=====================================================
     * Seeds Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create seeds? (true|false)
     * | Where should the seeds be stored? (string)
     * | Which namespace should seeds be given? (empty|string)
     */
    'seeds' => true,
    'seeds_path' => app_path().'/acme/database/seeds',
    'seeds_namespace' => '',

    /*=====================================================
     * Validators Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create validators? (true|false)
     * | Where should the validators be stored? (string)
     * | Which namespace should validators be given? (empty|string)
     */
    'validators' => true,
    'validators_path' => app_path().'/acme/validators',
    'validators_namespace' => 'Acme\Validators',

    /*=====================================================
     * Tests Configuration Settings
     * ====================================================
     * | Should the 'artisan produce' command create tests? (true|false)
     * | Where should the tests be stored? (string)
     * | Which namespace should tests be given? (empty|string)
     */
    'tests' => true,
    'tests_path' => app_path().'/acme/tests',
    'tests_namespace' => 'Acme\Tests',

);
