@extends('backend.layouts.main')
@section('title','Danh mục')
@section('content')
   @if(session('mess'))
     <div class="alert alert-info">
        {{ session('mess') }}
     </div>
   @endif
   <h3>Danh sách danh mục</h3>
   <div style="padding: 20px; border: 1px solid #4e73df;margin-bottom: 10px">
   <form name="search_cate" method="get" action="{{ htmlspecialchars($_SERVER["REQUEST_URI"]) }}" class="form-inline">
       <input name="cate_name" value="" class="form-control" style="width: 350px; margin-right: 20px" placeholder="Nhập tên danh mục bạn muốn tìm kiếm ..." autocomplete="off">
        <select name="  " class="form-control" style="">
            <option value="">Sắp xếp</option>
            <option value="cate_asc">ID tăng dần</option>
            <option value="cate_desc">ID giảm dần</option>
        </select>
        <div>
           <input type="submit" class="btn btn-success ml-4" value="Search">
       </div>
       <div style="padding:10px 0px">
           <a href="#" id="clear-search" class="btn btn-warning ml-2">Clear filter</a>
       </div>
       <input type="hidden" name="page" value="1">
   </form>
  </div>
  <a href="{{ url("/category/add") }}" class="btn btn-primary">Thêm danh mục</a>
  <table class="table table-bordered mt-4" id="dataTable" width="100%" cellspacing="0">
<thead>
    <tr>
        <th>ID danh mục</th>
        <th>Ảnh đại diện</th>
        <th>Tên danh mục</th>
        <th>Hành động</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID danh mục</th>
        <th>Ảnh đại diện</th>
        <th>Tên danh mục</th>
        <th>Hành động</th>
    </tr>
</tfoot>
<tbody>
	@if(isset($categories) && !empty($categories))
	   @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>

        <td>
            @if($category->image)
               <?php 
                 $category->image = str_replace("public/","",$category->image);
               ?> 
            @endif
            <div>
                <img src="{{ asset("storage/$category->image") }}" width="100px" height="auto">
            </div>   
        </td>
        <td>{{ $category->name }}</td>
        <td>
            <a href="{{ url("/category/edit/$category->id") }}" class="btn btn-outline-warning">Sửa</a>
            <a href="{{ url("/category/delete/$category->id") }}" class="btn btn-outline-danger">Xóa</a>
        </td>
    </tr>
      @endforeach
    @else
      Chưa có bản ghi nào trong bảng này
    @endif
</tbody>
</table>
 {{ $categories->links() }}
@endsection
@section('appendjs')
<script type="text/javascript">
   $(document).ready(function () {
       $("#clear-search").on("click", function (e) {
           e.preventDefault();
           $("input[name='cate_name']").val('');
           $("form[name='search_cate']").trigger("submit");
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