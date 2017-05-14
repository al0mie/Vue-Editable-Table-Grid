<?php

namespace App\Controllers;

use App\Services\UserService;
use Symfony\Component\HttpFoundation\{JsonResponse, Request};

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getOne($id) : JsonResponse
    {
        return new JsonResponse($this->userService->getOne($id));
    }

    /**
     * Get all users
     *
     * @return JsonResponse
     */
    public function getAll() : JsonResponse
    {
        return new JsonResponse($this->userService->getAll());
    }

    /**
     * Store a new user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request)
    {
        $user = $this->getDataFromRequest($request);
        return new JsonResponse($this->userService->save($user));
    }

    /**
     * Update the selected user
     *
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request) : JsonResponse
    {
        $user = $this->getDataFromRequest($request);
        return new JsonResponse($this->userService->update($id, $user));
    }

    /**
     * Delete the selected user
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        return new JsonResponse($this->userService->delete($id));
    }

    /**
     * Uniform all data
     *
     * @param Request $request
     * @return array
     */
    public function getDataFromRequest(Request $request) : array 
    {
        return $request->request->all();
    }
}
