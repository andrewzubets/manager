<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryManager;

/**
 * Base class for controller.
 */
abstract class Controller
{
    /**
     * Constructs controller.
     */
    public function __construct() {
        $this->repositoryManager = app('repository.manager');
    }

    /**
     * Repository manager.
     */
    protected RepositoryManager $repositoryManager;
}
