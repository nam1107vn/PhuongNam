<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ProductsModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request) {
       //$products = ProductsModel::all();
       //$products = DB::table('products')->paginate(3);
       $searchKeyword = $request->query('product_name', "");
       $allProductStatus = [1,2];
       $queryORM = ProductsModel::where('product_name', "LIKE", "%".$searchKeyword."%");
       $productStatus = (int) $request->query('product_status', "");
       $sort = $request->query('product_sort',"");
       if (in_array($productStatus, $allProductStatus)) {
        $queryORM = $queryORM->where('product_status',$productStatus);
        }
        if($sort == "price_asc"){
           $queryORM->orderBy("product_price","asc");
        }
        if($sort == "price_desc"){
           $queryORM->orderBy("product_price","desc");
        }
        if($sort == "quantity_asc"){
           $queryORM->orderBy("product_quantity","asc");
        }
        if($sort == "quantity_desc"){
           $queryORM->orderBy("product_quantity","desc");
        }
       $products = $queryORM->paginate(3);
       //truyền dữ liệu xuống view
       $data = [];
       $data['products'] = $products;
       // truyền keyword search xuống view
       $data["searchKeyword"] = $searchKeyword;
       $data["productStatus"] = $productStatus;
       $data["sort"] = $sort;
       return view("backend.products.index",$data);
    }
    public function edit($id) {
       $product = ProductsModel::findOrFail($id);
       //truyền dữ liệu xuống view
       $data = [];
       $data['product'] = $product;
       return view("backend.products.edit",$data);
    }
    public function update(Request $request,$id){
        //validate dữ liệu
        $validateData = $request->validate([
            'product_name' => 'required',
            'desc' => 'required',
            'product_image' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'product_status' => 'required',
        ]);
        $product_name = $request->input('product_name',"");

        $desc = $request->input('desc', '');
        $product_publish = $request->input('product_publish', '');
        $product_price = $request->input('product_price', 0);
        $product_quantity = $request->input('product_quantity', 0);
        if(!$product_publish){
           $product_publish = date("Y-m-d H:i:s");
        }
        $product_status = $request->input('product_status', 0);
        // lấy đối tượng model dựa trên biến $id

        $product = ProductsModel::findOrFail($id);
        $product->product_name = $product_name;
        $product->desc = $desc;
        $product->product_publish = $product_publish;
        $product->product_quantity = $product_quantity;
        $product->product_price = $product_price;
        $product->product_status = $product_status;
        // gắn tạm product_image là rỗng "" vì ta chưa upload ảnh
        if($request->hasFile('product_image')){
          // nếu có ảnh mới upload lên và
          // trong biến $product->product_image có dữ liệu
          // có nghĩa là trước đó đã có ảnh trong db
          if($product->product_image){
             Storage::delete($product->product_image);
          }
            $pathProductImage = $request->file('product_image')->store('public/productimages');
            $product->product_image = $pathProductImage;
        }
       

        // lưu sản phẩm

      $product->save();
      return redirect("sanpham/edit/$id")->with("story","Sửa dữ liệu thành công!");

    }
    public function delete($id) {
       $product = ProductsModel::findOrFail($id);

       //truyền dữ liệu xuống view
       $data = [];
       $data['product'] = $product;
       return view("backend.products.delete",$data);
    }
    public function destroy($id){
        //lấy đối tượng model theo id
        $product = ProductsModel::findOrFail($id);
        $product->delete();
        //chuyển hướng về trang chủ
        return redirect("sanpham")->with("status","Xóa dữ liệu thành công!");
    }
    public function create() {
       return view("backend.products.create");
    }
    public function store(Request $request) {
      $validatedData = $request->validate([
         'product_name' => 'required',
         'desc' => 'required',
         'product_image' => 'required',
         'product_quantity' => 'required',
         'product_price' => 'required',
         'product_status' => 'require',
      ]);

      $product_name = $request->input('product_name',"");
      $desc = $request->input('desc', '');
      $product_publish = $request->input('product_publish', '');
      $product_price = $request->input('product_price', 0);
      $product_quantity = $request->input('product_quantity', 0);
      
      $pathProductImage = $request->file('product_image')->store('public/productimages');
      $product_status = $request->input('product_status',0);

      $product = new ProductsModel();

      //Khi $product_publish không được nhập dữ liệu
      //ta sẽ gán giá trị là time hiện tại theo định dạng Y-m-d H:i:s
      if(!$product_publish){
         $product_publish = date("Y-m-d H:i:s");
      }
      // gán dữ liệu từ request cho các thuộc tính của biến $product
      // $product là đối tượng khởi tạo từ model ProductsModel
      $product->product_name = $product_name;
      $product->desc = $desc;
      $product->product_publish = $product_publish;
      $product->product_quantity = $product_quantity;
      $product->product_price = $product_price;
       // gắn tạm product_image là rỗng "" vì ta chưa upload ảnh
      $product->product_image = $pathProductImage;
      $product->product_status = $product_status;
       // lưu sản phẩm

      $product->save();

      return redirect('sanpham')->with('status','Thêm dữ liệu thành công!');
    }
}
