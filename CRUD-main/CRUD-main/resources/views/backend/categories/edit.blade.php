@extends('backend.layouts.main')
@section('title','Danh mục')
@section('content')
  @if(session('mess'))
    <div class="alert alert-info">
        {{ session('mess') }}
    </div>
  @endif
  <h3>Sửa danh mục</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form action="{{ url("/category/update/$dataCate->id") }}" method="post" enctype="multipart/form-data">
    @csrf
    <fieldset class="form-group">
      <label for="">Tên danh mục:</label>
      <input type="text" name="name" class="form-control" id="" placeholder="" value="{{ $dataCate->name }}">
    </fieldset>
    <fieldset class="form-group">
      <label for="">Slug danh mục</label>
      <input type="text" name="slug" class="form-control" id="" placeholder="" value="{{ $dataCate->slug }}">
    </fieldset>
    <fieldset class="form-group">
    <label for="">Ảnh danh mục</label>
    <input type="file" name="image" class="form-control mb-3" value="{{ $dataCate->image }}" id="" placeholder="">
    <?php 
       $dataCate->image = str_replace("public/","",$dataCate->image);
    ?>
    <img src="{{ asset("storage/$dataCate->image") }}" width="100px" height="auto">
    </fieldset>
    <fieldset class="form-group">
    <label for="">Mô tả danh mục</label>
    <textarea name="desc" class="form-control" rows="10" id="cate_desc">{{ $dataCate->desc }}</textarea>
    <div>{!! $dataCate->desc !!}</div>
    </fieldset>
    <button type="submit" class="btn btn-outline-info">Sửa danh mục</button>
  </form>
@endsection
@section('appendjs')
  <script src="{{ asset("/tinymce/tinymce.min.js") }}"></script>
  <script>
    tinymce.init({
      selector: '#cate_desc'
    });
  </script>
@endsection