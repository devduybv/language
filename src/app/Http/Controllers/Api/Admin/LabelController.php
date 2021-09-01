<?php

namespace VCComponent\Laravel\Language\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use VCComponent\Laravel\Language\Repositories\LabelRepository;
use VCComponent\Laravel\Language\Transformers\LabelTransformer;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class LabelController extends ApiController
{

    protected $repository;
    public function __construct(LabelRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = $repository->getEntity();
        if (config('language.auth_middleware.admin.middleware') !== '') {
            $this->middleware(
                config('language.auth_middleware.admin.middleware'),
                ['except' => config('language.auth_middleware.admin.except')]
            );
        }

        $this->transformer = LabelTransformer::class;
    }
    public function index(Request $request)
    {
        $query = $this->entity;
        if ($request->has('type')) {
            $query = $this->repository->applyQueryScope($query, 'type', $request->type);
        }

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['type', 'name', 'value'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);
        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }
        if ($request->has('page')) {
            $per_page = $request->has('per_page') ? (int) $request->get('per_page') : 15;
            $labels = $query->paginate($per_page);
            return $this->response->paginator($labels, $transformer);
        }
        $labels = $query->get();
        return $this->response->collection($labels, $transformer);

    }
}
