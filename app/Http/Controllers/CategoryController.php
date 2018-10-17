<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Http\Requests\CategoryRequest as Request;

class CategoryController extends Controller
{

    private $categoryModel;


    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Category[]
     */
    public function findAll()
    {
        return Category::all(["id", "name"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $this->categoryModel->salvar($data);
        return response()->json("", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Category
     * @throws \App\Exceptions\NotFoundException
     */
    public function findById($id)
    {
        return $this->categoryModel->findById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataModified = $request->all();
        $this->categoryModel->atualizar($id, $dataModified);
        return response()->json("", 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->categoryModel->remove($id);
        return response()->json("", 204);
    }
}
