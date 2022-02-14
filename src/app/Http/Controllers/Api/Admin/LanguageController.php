<?php

namespace VCComponent\Laravel\Language\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use VCComponent\Laravel\Language\Repositories\LanguageRepository;
use VCComponent\Laravel\Language\Transformers\LanguageTransformer;
use VCComponent\Laravel\Language\Validators\LanguageValidator;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;
use VCComponent\Laravel\Vicoders\Core\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends ApiController
{

    protected $repository;
    protected $validator;
    public function __construct(LanguageRepository $repository, LanguageValidator $validator)
    {
        $this->repository = $repository;
        $this->entity = $repository->getEntity();
        $this->validator = $validator;
        if (config('translate.auth_middleware.admin.middleware') !== '') {
            $this->middleware(
                config('translate.auth_middleware.admin.middleware'),
                ['except' => config('translate.auth_middleware.admin.except')]
            );
        }
        else{
            throw new Exception("Admin middleware configuration is required");
        }

        $this->transformer = LanguageTransformer::class;
    }
    public function index(Request $request)
    {
        $query = $this->entity;

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['name'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);
        $per_page = $request->has('per_page') ? (int) $request->get('per_page') : 15;
        $laguages = $query->paginate($per_page);

        return $this->response->paginator($laguages, new $this->transformer());
    }
    public function store(Request $request)
    {
        $this->validator->isValid($request, 'RULE_CREATE');
        $data = $request->all();
        $language = $this->entity->create($data);

        return $this->response->item($language, new $this->transformer());
    }
    public function show(Request $request, $id)
    {
        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        $language = $this->repository->find($id);

        return $this->response->item($language, $transformer);
    }
    function list(Request $request) {
        $query = $this->entity;

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['name'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);

        $laguages = $query->get();

        return $this->response->collection($laguages, new $this->transformer());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('languages')->ignore($id),
            ],
            'code' => [
                'required',
                Rule::unique('languages')->ignore($id),
            ],
        ]);
        $data = $request->all();
        $language = $this->repository->update($data, $id);

        return $this->response->item($language, new $this->transformer());
    }

    public function destroy($id)
    {
        $language = $this->entity->find($id);
        if (!$language) {
            throw new NotFoundException('language');
        }

        $this->repository->delete($id);

        return $this->success();
    }

    // public function bulkUpdateStatus(Request $request)
    // {
    //     $this->repository->bulkUpdateStatus($request);
    //     return $this->success();
    // }

    // public function updateStatus(Request $request, $id)
    // {
    //     $this->repository->updateStatus($request, $id);
    //     return $this->success();
    // }
}
