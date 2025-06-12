<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $table = "products";

    public static function allProduct()
    {
        $model = new static;
        $sql = "SELECT products.*, categories.name as cate_name FROM products JOIN categories ON products.category_id=categories.id ORDER BY products.id DESC";

        $stmt = $model->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
}
