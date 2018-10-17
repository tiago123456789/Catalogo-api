<?php

namespace App\Model;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "description", "user_id", "category_id"];

    protected $hidden = ["created_at", "updated_at"];

    public function prices() {
        return $this->hasMany(Price::class);
    }

    public function findAll() {
        return Product::with(["prices" => function($query) { $query->where("active", true); }])->get();
    }

    public function findById($id) {
        $product = $this->find($id);

        if ($product == null) {
            throw new NotFoundException();
        }

        $product["prices"] = $product->prices()->get();

        return $product;
    }

    public function updateProduct($id, $data) {
        $product = $this->findById($id);
        $product->update($data);
    }

    public function remove($id) {
        $product = $this->findById($id);
        $product->delete();
    }
}
