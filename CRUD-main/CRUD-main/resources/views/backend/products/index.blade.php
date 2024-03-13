@extends('backend.layouts.main')
@section('title','Trang sản phẩm')
@section('content')
  
  <h4>Danh sách sản phẩm</h4>
  <div style="padding: 20px; border: 1px solid #4e73df;margin-bottom: 10px">
   <form name="search_product" method="get" action="{{ htmlspecialchars($_SERVER["REQUEST_URI"]) }}" class="form-inline">
       <input name="product_name" value="{{ $searchKeyword }}" class="form-control" style="width: 350px; margin-right: 20px" placeholder="Nhập tên sản phẩm bạn muốn tìm kiếm ..." autocomplete="off">
        <select name="product_status" class="form-control" style="width: 150px; margin-right: 20px">
           <option value="">Lọc theo trạng thái</option>
           <option value="1" {{ $productStatus == 1 ? " selected" : "" }}>Đang mở bán</option>
           <option value="2" {{ $productStatus == 2 ? " selected" : "" }}>Ngừng bán</option>
        </select>
        <select name="product_sort" class="form-control" style="">
            <option value="">Sắp xếp</option>
            <option value="price_asc" {{ $sort == "price_asc" ? " selected" : "" }}>Giá tăng dần</option>
            <option value="price_desc" {{ $sort == "price_desc" ? " selected" : "" }}>Giá giảm dần</option>
            <option value="quantity_asc" {{ $sort == "quantity_asc" ? " selected" : "" }}>Tồn kho tăng dần</option>
            <option value="quantity_desc" {{ $sort == "quantity_desc" ? " selected" : "" }}>Tồn kho giản dần</option>
        </select>
        <div>
           <input type="submit" name="search" class="btn btn-success ml-4" value="Lọc kết quả">
       </div>
       <div style="padding:10px 0px">
           <a href="#" id="clear-search" class="btn btn-warning ml-2">Clear filter</a>
       </div>
       <input type="hidden" name="page" value="1">
   </form>
  </div>
   {{ $products->links() }}
  @if(session('status'))
     <div class="alert alert-info">
         {{ session('status') }}
     </div>
  @endif
  <a class="btn btn-primary mt-4" href="{{ url('/sanpham/create') }}">Thêm sản phẩm</a>
  <table class="table table-bordered mt-4" id="dataTable" width="100%" cellspacing="0">
<thead>
    <tr>
        <th>ID</th>
        <th>Ảnh đại diện</th>
        <th>Tên sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Tồn kho</th>
        <th>Hành động</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Ảnh đại diện</th>
        <th>Tên sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Tồn kho</th>
        <th>Hành động</th>
    </tr>
</tfoot>
<tbody>
    @if(isset($products) && !empty($products))
       @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>
            @if($product->product_image)
               <?php 
                   $product->product_image = str_replace("public","",$product->product_image);
                ?>
                <div>
                    <img src="{{ asset("storage/$product->product_image") }}" width="100px" height="auto">
                </div>
            @endif
        </td>
        <td>
            {{ $product->product_name }}

            @if($product->product_status == 1)
               <p><span class="bg-success text-white">Đang bán</span></p>
            @endif
            @if($product->product_status == 2)
               <p><span class="bg-success text-white">Dừng bán</span></p>
            @endif
        </td>
        <td>{{ $product->product_price }}</td>
        <td>{{ $product->product_quantity }}</td>
        <td>
            <a href="{{ url("/sanpham/edit/$product->id") }}" class="btn btn-outline-warning">Sửa</a>
            <a href="{{ url("/sanpham/delete/$product->id") }}" class="btn btn-outline-danger">Xóa</a>
        </td>
    </tr>
       @endforeach  
    @else
      Chưa có bản ghi nào trong bảng này
    @endif
</tbody>
</table>
  {{ $products->links() }}
@endsection
@section('appendjs')
<script type="text/javascript">
   $(document).ready(function () {
       $("#clear-search").on("click", function (e) {
           e.preventDefault();
           $("input[name='product_name']").val('');
           $("select[name='product_status']").val('');
           $("select[name='product_sort']").val('');
           $("form[name='search_product']").trigger("submit");
       });
       $("a.page-link").on("click", function (e) {
           e.preventDefault();
           var rel = $(this).attr("rel");
           if (rel == "next") {

               var page = $("body").find(".page-item.active > .page-link").eq(0).text();

               console.log(" : " + page);

               page = parseInt(page);

               page += 1;

           } else if(rel == "prev") {

               var page = $("body").find(".page-item.active > .page-link").eq(0).text();

               console.log(page);

               page = parseInt(page);

               page -= 1;

           } else {

               var page = $(this).text();
           }
           console.log(page);
           page = parseInt(page);
           $("input[name='page']").val(page);
           $("form[name='search_product']").trigger("submit");
       });
   });
</script>
@endsection