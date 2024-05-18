<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\V1\Review\CreateReviewRequest;
use App\Http\Requests\V1\Review\UpdateReviewRequest;
use App\Http\Resources\V1\ReviewResource;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewController extends ApiController
{
    public function index(Request $request): ResourceCollection
    {
        $params = $request->all();

        $reviews = Review::query()->paginate($params['limit'] ?? 10);
        return $this->respondWithSuccess(ReviewResource::collection($reviews));
    }

    public function show(int $id): JsonResource
    {
        $review = Review::query()->findOrFail($id);
        return $this->respondWithSuccess(new ReviewResource($review));
    }

    public function store(CreateReviewRequest $request): JsonResponse
    {
        $review = Review::create($request->validated());
        return $this->respondWithSuccessCreate(new ReviewResource($review));
    }

    public function update(UpdateReviewRequest $request, int $id): JsonResource
    {
        $review = Review::query()->findOrFail($id);
        $review->update($request->validated());

        return $this->respondWithSuccess(new ReviewResource($review));
    }

    public function destroy(int $id): JsonResponse
    {
        $review = Review::query()->findOrFail($id);
        $review->delete();

        return $this->noContent();
    }
}
