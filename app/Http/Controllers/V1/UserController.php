<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\V1\User\CreateUserRequest;
use App\Http\Requests\V1\User\UpdateUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends ApiController
{
    public function index(Request $request): ResourceCollection
    {
        $params = $request->all();

        $users = User::query()->paginate($params['limit'] ?? 10);
        return $this->respondWithSuccess(UserResource::collection($users));
    }

    public function show(int $id): JsonResource
    {
        $user = User::query()->findOrFail($id);
        return $this->respondWithSuccess(new UserResource($user));
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        return $this->respondWithSuccessCreate(new UserResource($user));
    }

    public function update(UpdateUserRequest $request, int $id): JsonResource
    {
        $user = User::query()->findOrFail($id);
        $user->update($request->validated());

        return $this->respondWithSuccess(new UserResource($user));
    }

    public function destroy(int $id): JsonResponse
    {
        $user = User::query()->findOrFail($id);
        $user->delete();

        return $this->noContent();
    }
}
