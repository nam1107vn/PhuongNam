<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\CategoryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request){
        //$categories = CategoryModel::all();
        //$categories = DB::table('caterory')->paginate(3);
        $keyword = $request->query('cate_name',"");
        $queryORM = CategoryModel::where("name","LIKE","%".$keyword."%");
        $sort = $request->query("cate_sort","");
        if($sort == 'cate_asc'){
            $queryORM->orderBy("id","asc");
        }
        if($sort == 'cate_desc'){
            $queryORM->orderBy("id","desc");
        }
        $categories = $queryORM->paginate(3);
        $data = [];
        $data['categories'] = $categories;
        return view("backend.categories.index",$data);
    }
    public function create(){
        return view("backend.categories.create");
    }
    public function store(Request $request){
        $validatedData = $request->validate([
           'name'  => 'required',
           'slug'  => 'required',
           'desc'  => 'required',
           'image' => 'required',
        ]);

        $name  = $request->input('name',"");
        $slug  = $request->input('slug',"");
        $desc  = $request->input('desc',"");
        $image = $request->file('image')->store('public/categoryimages');


        $modelCate = new CategoryModel();

        $modelCate->name = $name;
        $modelCate->slug = $slug;
        $modelCate->desc = $desc;
        $modelCate->image = $image;

        $modelCate->save();

        return redirect("category")->with("mess","Thêm danh mục thành công!");
    }
    public function edit($id){
        $dataCate = CategoryModel::findOrFail($id);
        $data = [];
        $data['dataCate'] = $dataCate;
        return view("backend.categories.edit",$data);
    }
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
           'name' => 'required',
           'slug' => 'required',
           'desc' => 'required',
           'image' => 'required',
        ]);

        $name  = $request->input('name',"");
        $slug  = $request->input('slug',"");
        $desc  = $request->input('desc',"");

        $modelCate = CategoryModel::findOrFail($id);

        $modelCate->name = $name;
        $modelCate->slug = $slug;
        $modelCate->desc = $desc;
        if($request->hasFile("image")){
          // nếu có ảnh mới upload lên và
          // trong biến $product->image có dữ liệu
          // có nghĩa là trước đó đã có ảnh trong db
           if($modelCate->image){
              Storage::delete($modelCate->image);
           }
           $image = $request->file("image")->store("public/categoryimages");
           $modelCate->image = $image;
        }

        $modelCate->save();

        return redirect("category/edit/$id")->with("mess","Sửa danh mục thành công!");
    }
    
    public function delete($id){
        $dataCate = CategoryModel::findOrFail($id);
        $data = [];
        $data['dataCate'] = $dataCate;
        return view("backend.categories.delete",$data);
    }
    public function destroy($id){
        $dataCate = CategoryModel::findOrFail($id);
        $dataCate->delete();
        //Xóa xong chuyển trang
        return redirect('category')->with("mess","Xóa thành công!");
    }
}
