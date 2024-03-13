@extends('backend.layouts.main')
@section('title','Danh mục')
@section('content')
  <h3>Tạo danh mục</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form action="{{ url("/category/store") }}" method="post" enctype="multipart/form-data">
    @csrf
    <fieldset class="form-group">
      <label for="">Tên danh mục:</label>
      <input type="text" name="name" class="form-control" id="name_cate" onkeyup="ChangeToSlug();" placeholder="" value="{{ old("name","") }}">
    </fieldset>
    <fieldset class="form-group">
      <label for="">Slug danh mục</label>
      <input type="text" name="slug" class="form-control" id="slug" placeholder="" value="{{ old("slug","") }}">
    </fieldset>
    <fieldset class="form-group">
    <label for="">Ảnh danh mục</label>
    <input type="file" name="image" class="form-control" id="" placeholder="">
    </fieldset>
    <fieldset class="form-group">
    <label for="">Mô tả danh mục</label>
    <textarea name="desc" class="form-control" rows="10" id="cate_desc">{{ old("desc","") }}</textarea>
    </fieldset>
    <button type="submit" class="btn btn-outline-info">Thêm danh mục</button>
  </form>
@endsection
@section('appendjs')
  <script src="{{ asset("/tinymce/tinymce.min.js") }}"></script>
  <script>
    tinymce.init({
      selector: '#cate_desc'
    });
    function ChangeToSlug()
   {
    var title, slug;
 
    //Lấy text từ thẻ input title 
    title = document.getElementById("name_cate").value;
 
    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();
 
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@'+ slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('slug').value = slug;
}
  </script>
@endsection