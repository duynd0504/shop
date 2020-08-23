@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
     <div class="panel panel-default">
       <div class="panel-heading">
          Liệt kê thương hiệu sản phẩm
       </div>
       <div class="row w3-res-tb">
         <div class="col-sm-5 m-b-xs">
           <select class="input-sm form-control w-sm inline v-middle">
             <option value="0">Bulk action</option>
             <option value="1">Delete selected</option>
             <option value="2">Bulk edit</option>
             <option value="3">Export</option>
           </select>
           <button class="btn btn-sm btn-info">Apply</button>   
           <a href="{{URL::to('/add-category-product')}}" > <button class="btn btn-sm btn-danger" type="button" >Thêm Thương Hiệu</button>              
         </div>
         <div class="col-sm-4">
         </div>
         <div class="col-sm-3">
           <div class="input-group">
             <input type="text" class="input-sm form-control" placeholder="Search">
             <span class="input-group-btn">
               <button class="btn btn-sm btn-default" type="button">Tìm!</button>
             </span>
           </div>
         </div>
       </div>
       <div class="table-responsive">
        <?php 
        $message = Session::get('message'); 
		    if($message){
			  echo '<span class="text-alert">'. $message. '</span>';
        Session::put('message',null); 
        
		    }
	      ?>
         <table class="table table-striped b-t b-light">
           <thead>
             <tr>
               <th style="width:20px;">
                 <label class="i-checks m-b-none">
                   <input type="checkbox"><i></i>
                 </label>
               </th>
               <th>Tên thương hiệu</th>
               <th>Mô tả</th>
               <th>Trạng thái</th>
               {{-- <th>Chi tiết</th>
               <th>Xoá</th> --}}
               <th style="width:30px;"></th>
             </tr>
           </thead>
           <tbody>
             @foreach ($all_brand_product as $key => $brand_pro)
             <tr>
               <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
               <td>{{$brand_pro->brand_name}}</td>
               <td><span class="text-ellipsis">{{$brand_pro->brand_desc}}</span></td>
               <td><span class="text-ellipsis">
              <?php if($brand_pro -> brand_status == 0){ ?>
              <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}"><span class="badge badge-pill badge-dark">Not Active</span></a> 
              <?php }else{ ?> 
              <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"><span class="badge badge-pill badge-success">Active</span></a>
              <?php } ?>
              </span></td> 
               <td>
                <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}">
                  <span class="glyphicon glyphicon-pencil" style="color: green"></span>
                </a>
                <a href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}"  onclick="return confirm('Bạn có muốn xoá không ?')">
                  <span class="glyphicon glyphicon-remove" style="color: #F78199"></span>
                
               </td>
               {{-- <td><a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i></a></td>
               <td><a href="" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a></td> --}}
             </tr>
             @endforeach 
           </tbody>
         </table>
       </div>
       <footer class="panel-footer">
         <div class="row">
           
           <div class="col-sm-5 text-center">
             <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
           </div>
           <div class="col-sm-7 text-right text-center-xs">                
             <ul class="pagination pagination-sm m-t-none m-b-none">
               <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
               <li><a href="">1</a></li>
               <li><a href="">2</a></li>
               <li><a href="">3</a></li>
               <li><a href="">4</a></li>
               <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
             </ul>
           </div>
         </div>
       </footer>
     </div>
   </div>
@endsection