@extends('admin_layout')
@section('admin_content')
<div class="row">
     <div class="col-lg-12">
             <section class="panel">
                 <header class="panel-heading">
                     Thêm Danh Mục Sản Phẩm
                 </header>
                 {{-- <?php 
                    $message = Session::get('message'); 
                    if($message){
                        echo '<h5>'. $message. '</h5>';
                        Session::put('message',null); 
                    }
	             ?> --}}
                 <div class="panel-body">
                     <div class="position-center">
                     <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                         {{ csrf_field() }}
                         <div class="form-group">
                             <label for="exampleInputEmail1">Tên danh mục:</label>
                             <input type="text" class="form-control" name="category_product_name" id="exampleInputEmail1" placeholder="Tên danh mục">
                         </div>
                         <div class="form-group">
                             <label for="exampleInputPassword1">Mô tả danh mục:</label>
                             <textarea style="resize: none" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"> </textarea>
                         </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái:</label>
                            <select class="form-control input-sm m-bot15" name="category_product_status">
                                 <option value="0">Ẩn</option>
                                 <option value="1">Hiện</option>
                                 
                            </select>
                         </div>
                        
                         <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                     </form>
                     </div>

                 </div>
             </section>

     </div>
@endsection