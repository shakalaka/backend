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

    /**
     * Количество записей на странице
     *
     * @var int
     */
    private $onPage = 10;

    /**
     * Возвращает список тасков
     *
     * @param int $page Номер страницы
     *
     * @return array
     */
    public function getTasks($page = 1)
    {
        $response = [];
        $from = ($page === 1) ? 1 : $this->onPage * $page;
        $to = ($page === 1) ? $page * $this->onPage : $page * $this->onPage + $this->onPage;

        $to = $this->limit($to);

        for ($i = $from; $i <= $to; $i++) {
            $response[] = $this->getTask($i);
        }


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
        if ($to > 1000) {
            $to = 1000;
        }

        return $to;
    }
}