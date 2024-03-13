@extends('backend.layouts.main')
@section('title','Trang tạo mới sản phẩm')
@section('content')
  <h4>Tạo mới sản phẩm</h4>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form name="produc" method="post" enctype="multipart/form-data" action="{{ url('/sanpham/store') }}">
    @csrf
    <fieldset class="form-group">
      <label for="">Tên sản phẩm</label>
      <input type="text" name="product_name" class="form-control" id="" placeholder="" value="{{ old('product_name',"") }}">
    </fieldset>
    <fieldset class="form-group">
      <label for="">Trạng thái sản phẩm:</label>
      <input type="radio" name="product_status" id="" value="1"> Đang mở bán
      <input type="radio" name="product_status" id="" value="2"> Tạm thời ngừng bán bán
    </fieldset>
    <fieldset class="form-group">
      <label for="product_image">Ảnh sản phẩm</label>
      <input type="file" class="form-control" id="product_image" placeholder="" name="product_image">
    </fieldset>
    <fieldset class="form-group">
      <label for="product_desc">Mô tả sản phẩm</label>
      <textarea name="desc" class="form-control" rows="10" id="product_desc">{{ old('desc',"") }}</textarea>
    </fieldset>
    <fieldset class="form-group">
      <label for="product_publish">Thời gian mở bán sản phẩm</label>
      <input type="text" name="product_publish" class="form-control" style="width: 250px" id="product_publish" placeholder="" value="{{ old('product_publish',"") }}">
    </fieldset>
    <fieldset class="form-group">
      <label for="">Giá sản phẩm</label>
      <input type="number" name="product_price" class="form-control" style="width: 250px" id="" placeholder="" value="{{ old('product_price',"") }}">
    </fieldset>
    <fieldset class="form-group">
      <label for="">Tồn kho sản phẩm</label>
      <input type="text" name="product_quantity" class="form-control" style="width: 250px" id="" placeholder="" value="{{ old('product_quantity',"") }}">
    </fieldset>

    <input class="btn btn-outline-info" type="submit" value="Thêm sản phẩm">
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
