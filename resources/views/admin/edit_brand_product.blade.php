@extends('admin_layout')
@section('admin_content')
<div class="row">
     <div class="col-lg-12">
             <section class="panel">
                 <header class="panel-heading">
                     Cập nhật thương hiệu sản phẩm
                 </header>
                 <div class="panel-body">
                      @foreach ($edit_brand_product as $key => $edit_value)
                     <div class="position-center">
                     <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="POST">
                         {{ csrf_field() }}
                         <div class="form-group">
                             <label for="exampleInputEmail1">Tên danh mục:</label>
                         <input type="text" value="{{$edit_value->brand_name}}" class="form-control" name="brand_product_name" id="exampleInputEmail1" placeholder="Tên danh mục">
                         </div>
                         <div class="form-group">
                             <label for="exampleInputPassword1">Mô tả danh mục:</label>
                             <textarea style="resize: none" name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"> {{$edit_value->brand_desc}}</textarea>
                         </div>                       
                         <button type="submit" name="update_brand_product" class="btn btn-success">Cập nhật thương hiệu</button>
                     </form>
                     </div>
                     @endforeach

                 </div>
             </section>

     </div>
@endsection