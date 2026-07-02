<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcademicYearRequest;
use App\Http\Requests\UpdateAcademicYearRequest;
use App\Http\Resources\AcademicYearResource;
use App\Services\AcademicYearService;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    protected $service;

    public function __construct(AcademicYearService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return AcademicYearResource::collection(
            $this->service->getAll()
        );
    }

    public function store(StoreAcademicYearRequest $request)
    {
        $academicYear = $this->service->create($request->validated());

        return new AcademicYearResource($academicYear);
    }

    public function show($id)
    {
        return new AcademicYearResource(
            $this->service->find($id)
        );
    }

    public function update(UpdateAcademicYearRequest $request, $id)
    {
        $academicYear = $this->service->update(
            $id,
            $request->validated()
        );
        return new AcademicYearResource($academicYear);
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json([
            'message' => 'Academic Year deleted successfullly.'
        ]);
    }
}
