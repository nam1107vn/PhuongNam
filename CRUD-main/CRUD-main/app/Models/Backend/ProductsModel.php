<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    //Khai báo tên bảng
    protected $table = 'products';
    //Khai báo khóa chính
    protected $primaryKey = 'id';

}
