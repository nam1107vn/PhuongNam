@extends('backend.layouts.main')
@section('title','Trang sửa sản phẩm')
@section('content')
  @if(session("story"))
     <div class="alert alert-info">
        {{ session("story") }}
     </div>
  @endif
  <h4>Sửa sản phẩm</h4>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form name="produc" method="post" enctype="multipart/form-data" action='{{ url("/sanpham/update/$product->id") }}'>
    @csrf
    <fieldset class="form-group">
      <label for="">Tên sản phẩm</label>
      <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" id="" placeholder="">
    </fieldset>
    <fieldset class="form-group">
      <label for="">Trạng thái sản phẩm:</label>
      @php
        if($product->product_status == 1){
           $checkRadio = " checked";
        }
        else
        {
           $checkRadio = "";
        }
      @endphp
      <input type="radio" {{ $checkRadio }} name="product_status" id="" value="1"> Đang mở bán
      @php
        if($product->product_status == 2){
           $checkRadio = " checked";
        }
        else
        {
           $checkRadio = "";
        }
      @endphp
      <input type="radio" name="product_status"  {{ $checkRadio }} id="" value="2"> Tạm thời ngừng bán bán
    </fieldset>
    <fieldset class="form-group">
      <label for="">Ảnh sản phẩm</label>
      <input type="file" class="form-control" id="" placeholder="" name="product_image">
      <?php 
         $product->product_image = str_replace("public/","",$product->product_image);
      ?>
      @if($product->product_image)
        <div>
            <img src="{{ asset("storage/$product->product_image") }}" style="width: 200px; height: auto">
        </div>
      @endif
    </fieldset>
    <fieldset class="form-group">
      <label for="product_desc">Mô tả sản phẩm</label>
      <textarea name="desc" id="product_desc" class="form-control" rows="10">{{ $product->desc }}</textarea>
    </fieldset>
    <div>
        <label for="product_desc">Preview Mô tả sản phẩm</label>
        <div>
           {!! $product->desc !!}
        </div>
    </div>
    <fieldset class="form-group">
      <label for="product_publish">Thời gian mở bán sản phẩm</label>
      <input type="text" name="product_publish" class="form-control" value="{{ $product->product_publish }}" style="width: 250px" id="product_publish" placeholder="">
    </fieldset>
    <fieldset class="form-group">
      <label for="">Giá sản phẩm</label>
      <input type="number" name="product_price" class="form-control" value="{{ $product->product_price }}" id="" placeholder="">
    </fieldset>
    <fieldset class="form-group">
      <label for="">Tồn kho sản phẩm</label>
      <input type="text" name="product_quantity" class="form-control" value="{{ $product->product_quantity }}" id="" placeholder="">
    </fieldset>

    <input class="btn btn-outline-info" type="submit" value="Sửa sản phẩm">
  </form>
@endsection
@section('appendjs')
  <link rel="stylesheet" href="{{ asset("/be-asset/js/bootstrap-datetimepicker.min.css") }}" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
  <script src="{{ asset("/be-asset/js/bootstrap-datetimepicker.min.js") }}"></script>
  <script type="text/javascript">
     $(function(){
        $('#product_publish').datetimepicker({
           format:"YYYY-MM-DD HH:mm:ss",
           icons: {
             time: 'far fa-clock',
             date: 'far fa-calendar',
             up: 'fas fa-arrow-up',
             down: 'fas fa-arrow-down',
             previous: 'fas fa-chevron-left',
             next: 'fas fa-chevron-right',
             today: 'fas fa-calendar-check',
             clear: 'far fa-trash-alt',
             close: 'far fa-times-circle'
            }
        });
     });
  </script>
  <script src="{{ asset("/tinymce/tinymce.min.js") }}"></script>
  <script>
    tinymce.init({
      selector: '#product_desc'
  });
</script>
@endsection
