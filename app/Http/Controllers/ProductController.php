<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Model\Price;
use App\Model\Product;
use App\Http\Requests\PriceRequest as Request;

class ProductController extends Controller
{
    private $productModel;
    private $priceModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->priceModel = new Price();
    }

    public function findById($id) {
        return $this->productModel->findById($id);
    }

    public function findAll() {
        return $this->productModel->findAll();
    }

    public function create(ProductRequest $request) {
        $newProduct = $request->all();
        (new Product($newProduct))->save();
        return response()->json("", 201);
    }

    public function update($id, Request $request) {
        $data = $request->all();
        $this->productModel->updateProduct($id, $data);
        return response()->json("", 204);
    }

    public function destroy($id) {
        $this->productModel->remove($id);
        return response()->json("", 204);
    }

    public function createPriceProduct($idProduct, Request $request) {
        $data = $request->all();
        $data["product_id"] = $idProduct;
        $this->priceModel->createProduct($data);
        return response()->json("", 201);
    }

    public function updatePriceProduct($idProduct, $idPrice, Request $request) {
        $data = $request->all();
        $data["product_id"] = $idProduct;
        $this->priceModel->updatePrice($idPrice, $data);
        return response()->json("", 204);
    }

    public function destroyPriceProduct($idProduct, $idPrice) {
        $this->priceModel->removePrice($idPrice);
        return response()->json("", 204);
    }
}
