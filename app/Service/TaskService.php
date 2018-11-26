<?php

namespace App\Service;

use App\Repository\TaskRepository;
use Illuminate\Support\Facades\Cache;

/**
 * Class TaskService
 */
class TaskService
{
    const CACHE_TIME = 60;

    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $page
     *
     * @return array
     */
    public function tasks($page)
    {
        $tasks = Cache::remember('task_' . $page, self::CACHE_TIME, function () use ($page) {
            return $this->repository->getTasks($page);
        });

        return $tasks;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function task($id)
    {
        return $this->repository->getTask($id);
    }
}