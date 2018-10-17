<?php

namespace App\Model;

use App\Exceptions\BusinessLogicException;
use App\Exceptions\MessageException;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ["product_id", "active", "value", "price_promotional"];

    protected $hidden = ["created_at", "updated_at", "product_id"];

    public function createProduct($data) {
        if ($data["active"]) {
            $existPriceActiveToProductSpecified = count($this->getPriceWithProductIdAndActiveTrue($data["product_id"])) > 0;
            if ($existPriceActiveToProductSpecified) {
                throw new BusinessLogicException(MessageException::EXIST_PRICE_ACTIVE_TO_PRODUCT);
            }
        }

        Price::create($data);
    }

    public function removePrice($id) {
        $product = $this->findById($id);

        if ($product && $product->active) {
            throw new BusinessLogicException(MessageException::PRICE_USING_IN_PRODUCT);
        }

        $product->delete();
    }

    public function updatePrice($idPrice, $dataModified) {
        $price = $this->findById($idPrice);
        $price->update($dataModified);
    }

    private function findById($id) {
        $price = $this->find($id);

        if ($price == null) {
            throw new NotFoundException();
        }

        return $price;
    }

    private function getPriceWithProductIdAndActiveTrue($idProduct) {
        return $this
                ->where("product_id", $idProduct)
                ->where("active", true)
                ->get();
    }
}
