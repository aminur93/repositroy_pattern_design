<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Service\category\CategoryServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        //get category

        $category = $this->categoryService->all();

        return response()->json([
            'category' => $category,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function store(CategoryRequest $request)
    {
        //store category data

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                $this->categoryService->store($request->validated());

                DB::commit();

                return \response()->json([
                    'message' => 'Category store successful',
                    'status_code' => 200
                ],Response::HTTP_CREATED);

            }catch (\Exception $exception){
                DB::rollBack();

                $error = $exception->getMessage();

                return \response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function edit($id)
    {
        //edit category data

        $category = $this->categoryService->edit($id);

        return \response()->json([
            'category' => $category,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function update(CategoryRequest $request, $id)
    {
        //update category data

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                $this->categoryService->update($request->validated(), $id);

                DB::commit();

                return \response()->json([
                    'message' => 'Category updated successful',
                    'status_code' => 200
                ],Response::HTTP_OK);

            }catch (\Exception $exception){
                DB::rollBack();

                $error = $exception->getMessage();

                return \response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function destroy($id)
    {
        //destroy category data

        $this->categoryService->destroy($id);

        return \response()->json([
            'message' => 'Category destroy successful',
            'status_code' => 200
        ],Response::HTTP_OK);
    }
}
