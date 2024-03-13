@extends('backend.layouts.main')
@section('title','Xóa danh mục')
@section('content')
  <h3>Xóa danh mục</h3>
  <form method="post" action="{{ url("/category/destroy/$dataCate->id") }}">
    @csrf
  	<fieldset class="form-group">
  		<label for="">ID danh mục:</label>
  		<p>{{ $dataCate->id }}</p>
  	</fieldset>
  	<fieldset class="form-group">
  		<label for="">Tên danh mục</label>
  		<p>{{ $dataCate->name }}</p>
  	</fieldset>
  	<button type="submit" class="btn btn-outline-danger">Xác nhận xóa danh mục</button>
  </form>
@endsection