<?php

namespace App\Repository;

use App\Model\Task;

/**
 * Репозиторий тасков
 */
class TaskRepository
{
    const PAGE_NAME = 'Задача';
    const AUTHOR_NAME = 'Автор';
    const STATUS_NAME = 'Статус';
    const DESCRIPTION_NAME = 'Описание';
    
    const MAX_RESULT = 1000;

    /**
     * Количество записей на странице
     *
     * @var int
     */
    private $perPage = 10;

    /**
     * Возвращает список тасков
     *
     * @param int $page Номер страницы
     *
     * @return array
     */
    public function getTasks($page = 1)
    {
        $data = [];
        $from = ($page === 1) ? 1 : $this->perPage * $page;
        $to = ($page === 1) ? $page * $this->perPage : $page * $this->perPage + $this->perPage;

        $to = $this->limit($to);

        for ($i = $from; $i < $to; $i++) {
            $data[] = $this->getTask($i);
        }

        $response = [
            'data' => $data,
            'current_page' => $page,
            'per_page' => $this->perPage,
            'last_page' => self::MAX_RESULT/$this->perPage,
            'from' => $from,
            'to' => $to
        ];

        return $response;
    }

    /**
     * Возвращает задачу по идентификатору
     *
     * @param int $id Идентификатор задачи
     *
     * @return Task
     */
    public function getTask($id)
    {
        $id = $this->limit($id);

        $task = new Task();
        $task->id = $id;
        $task->title = sprintf('%s %d', self::PAGE_NAME, $id);
        $task->date = date('Y-m-d H:i:s', (time() + ($id * 60 * 60)));
        $task->author = sprintf('%s %d', self::AUTHOR_NAME, $id);
        $task->status = sprintf('%s %d', self::STATUS_NAME, $id);
        $task->description = sprintf('%s %d', self::DESCRIPTION_NAME, $id);

        return $task;
    }

    /**
     * Искусственный ограничитель
     *
     * @param int $to Идентификатор задачи
     *
     * @return int
     */
    private function limit($to)
    {
        if ($to > self::MAX_RESULT) {
            $to = self::MAX_RESULT;
        }

        return $to;
    }
}