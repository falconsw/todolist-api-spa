<?php

namespace App\Service;

use App\Entity\TodoList;
use App\Repository\TodoListRepository;
use Doctrine\ORM\EntityNotFoundException;

class TodoListService
{

    /**
     * @var TodoListRepository
     */
    private TodoListRepository $_todoListRepository;

    public function __construct(TodoListRepository $todoListRepository)
    {
        $this->_todoListRepository = $todoListRepository;
    }

    /**
     * @param array $data
     * @return TodoList
     */
    public function addTodoList(array $data): TodoList
    {

        $todoList = new TodoList();
        $todoList->setTitle($data['title']);
        $todoList->setStatus($data['status'] ?? false);

        $this->_todoListRepository->add($todoList, true);

        return $todoList;
    }

    /**
     * @param int $todoListId
     * @param array $data
     * @return TodoList
     * @throws EntityNotFoundException
     */
    public function updateTodoList(int $todoListId, array $data): TodoList
    {
        $todoList = $this->getTodoList($todoListId);
        $todoList->setTitle($data['title'] ?? $todoList->getTitle());
        $todoList->setStatus($data['status'] ?? false);
        $this->_todoListRepository->update($todoList, true);

        return $todoList;
    }

    /**
     * @param int $todoListId
     * @return TodoList
     * @throws EntityNotFoundException
     */
    public function getTodoList(int $todoListId): TodoList
    {
        $todoList = $this->_todoListRepository->find($todoListId);
        if (!$todoList) {
            throw new EntityNotFoundException('Todo list not found');
        }

        return $todoList;
    }

    /**
     * @param int $todoListId
     * @return TodoList
     * @throws EntityNotFoundException
     */
    public function deleteTodoList(int $todoListId): TodoList
    {
        $todoList = $this->getTodoList($todoListId);
        $this->_todoListRepository->remove($todoList, true);

        return $todoList;
    }

    /**
     * @return TodoList[]
     */
    public function getAllTodoLists(): array
    {
        return $this->_todoListRepository->findAll();
    }

}