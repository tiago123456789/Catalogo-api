<?php

namespace App\Model;

use App\Exceptions\BusinessLogicException;
use App\Exceptions\MessageException;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name"];

    protected $hidden = ["created_at", "updated_at"];

    public function salvar($data) {
        $categoryWithNameExist = $this->getCategoryByName($data["name"]);
        if ($categoryWithNameExist) {
            throw new BusinessLogicException(MessageException::CATEGORY_ALREADY_EXIST);
        }
        
        (new Category($data))->save();
    }

    public function findById($id) {
        $category = $this->find($id);
        if ($category == null) {
            throw new NotFoundException(MessageException::NOT_FOUND);
        }
        return $category;
    }

    public function atualizar($id, $dataModified) {
        $category = $this->findById($id);
        $category->update($dataModified);
    }

    public function remove($id) {
        $this->findById($id);
        $this->delete($id);
    }

    private function getCategoryByName($name) {
        return $this->where("name", "like", "%{$name}%")->get()->first();
    }
}
