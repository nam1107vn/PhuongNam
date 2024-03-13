@extends('backend.layouts.main')
@section('title','Trang xóa sản phẩm')
@section('content')
  <h4>Xóa sản phẩm</h4>
  <form action="{{ url("/sanpham/destroy/$product->id") }}" method="post" name="product">
     @csrf
      <div class="form-group">
           <label for="product_name">ID sản phẩm:</label>
           <p>{{ $product->id }}</p>
       </div>
       <div class="form-group">
           <label for="product_name">Tên sản phẩm:</label>
           <p>{{ $product->product_name }}</p>
       </div>
       <button type="submit" class="btn btn-outline-danger">Xóa sản phẩm</button>
  </form>
@endsection