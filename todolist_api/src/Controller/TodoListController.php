<?php

namespace App\Controller;

use App\Service\TodoListService;
use Doctrine\ORM\EntityNotFoundException;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TodoList;

/**
 * @Route("/api")
 */
class TodoListController extends AbstractController
{

    /**
     * @Route("/todolist", name="todolist_index", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns the list",
     *     @Model(type=TodoList::class)
     *    )
     * )
     * @param TodoListService $todoListService
     * @return JsonResponse
     */
    public function index(TodoListService $todoListService): JsonResponse
    {
        return $this->json($todoListService->getAllTodoLists());
    }

    /**
     * @Route("/todolist/{id}", name="todolist_show", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns the data of the list",
     *     @Model(type=TodoList::class)
     *   )
     * )
     * @param int $id
     * @param TodoListService $todoListService
     * @return JsonResponse
     * @throws EntityNotFoundException
     */
    public function show(int $id, TodoListService $todoListService): JsonResponse
    {
        return $this->json($todoListService->getTodoList($id));
    }

    /**
     * @Route("/todolist", name="todolist_create", methods={"POST"})
     * @OA\RequestBody(
     *     required=true,
     *     @Model(type=TodoList::class, groups={"upsert_dto"})
     * )
     * @OA\Response(
     *     response=200,
     *     description="Returns the data of the list",
     *     @Model(type=TodoList::class)
     *  )
     * )
     * @param Request $request
     * @param TodoListService $todoListService
     * @return JsonResponse
     */
    public function create(Request $request, TodoListService $todoListService): JsonResponse
    {
        return $this->json($todoListService->addTodoList(json_decode($request->getContent(), true)));
    }

    /**
     * @Route("/todolist/{id}", name="todolist_update", methods={"PUT"})
     * @OA\RequestBody(
     *     required=true,
     *     @Model(type=TodoList::class, groups={"upsert_dto"})
     * )
     * @OA\Response(
     *     response=200,
     *     description="Returns the data of the list",
     *     @Model(type=TodoList::class)
     *  )
     * )
     * @param int $id
     * @param Request $request
     * @param TodoListService $todoListService
     * @return JsonResponse
     * @throws EntityNotFoundException
     */
    public function update(int $id, Request $request, TodoListService $todoListService): JsonResponse
    {
        return $this->json($todoListService->updateTodoList($id, json_decode($request->getContent(), true)));
    }

    /**
     * @Route("/todolist/{id}", name="todolist_delete", methods={"DELETE"})
     * @OA\Response(
     *     response=200,
     *     description="Returns the data of the list",
     *     @Model(type=TodoList::class)
     * )
     * @param int $id
     * @param TodoListService $todoListService
     * @return JsonResponse
     * @throws EntityNotFoundException
     */
    public function delete(int $id, TodoListService $todoListService): JsonResponse
    {
        return $this->json($todoListService->deleteTodoList($id));
    }


}
