<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\V1\Faq\CreateFaqRequest;
use App\Http\Requests\V1\Faq\UpdateFaqRequest;
use App\Http\Resources\V1\FaqResource;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FaqController extends ApiController
{
    public function index(Request $request): ResourceCollection
    {
        $params = $request->all();

        $faqs = Faq::query()->paginate($params['limit'] ?? 10);
        return $this->respondWithSuccess(FaqResource::collection($faqs));
    }

    public function show(int $id): JsonResource
    {
        $faq = Faq::query()->findOrFail($id);
        return $this->respondWithSuccess(new FaqResource($faq));
    }

    public function store(CreateFaqRequest $request): JsonResponse
    {
        $faq = Faq::create($request->validated());
        return $this->respondWithSuccessCreate(new FaqResource($faq));
    }

    public function update(UpdateFaqRequest $request, int $id): JsonResource
    {
        $faq = Faq::query()->findOrFail($id);
        $faq->update($request->validated());

        return $this->respondWithSuccess(new FaqResource($faq));
    }

    public function destroy(int $id): JsonResponse
    {
        $faq = Faq::query()->findOrFail($id);
        $faq->delete();

        return $this->noContent();
    }
}
