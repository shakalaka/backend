<?php

namespace App\Http\Controllers;

use App\Service\TaskService;
use Illuminate\Http\Request;

/**
 * Class TaskController
 */
class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    private $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * Представление списка задач
     *
     * @param Request $request
     *
     * @return array
     */
    public function tasks(Request $request)
    {
        $page = $request->get('page', 1);

        return response()->json($this->service->tasks($page));
    }

    /**
     * Представление задачи
     *
     * @param int $id Идентификатор задачи
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function task($id)
    {
        $task = $this->service->task($id);

        return response()->json($task);
    }
}