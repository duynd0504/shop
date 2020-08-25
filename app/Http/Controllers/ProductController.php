<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests; 
use Session; 
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    //Route::get('/add-category-product','CategoryProduct@add_category_product' )
    
        public function add_product()
        {
            $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();  
            $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();  
            
            return view ('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        }
        //Route::get('/all-category-product','CategoryProduct@all_category_product' )
        public function all_product()
        {
            $all_product = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id') 
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->orderby('tbl_product.product_id','desc')->get();
            $manage_product = view('admin.all_product')-> with('all_product',$all_product);
            return view ('admin_layout')->with('admin.all_product',$manage_product);
        }
        //save-brand-product ( them mot danh muc )
        public function save_product(Request $request)
        {
            $data = array();  
            $data['product_name']= $request -> product_name; 
            $data['product_price']= $request -> product_price; 
            $data['product_desc']= $request -> product_desc; 
            $data['product_content']= $request -> product_content; 
            $data['category_id']= $request -> product_cate; 
            $data['brand_id']= $request -> product_brand; 
            $data['product_status']= $request -> product_status; 
            $get_image = $request -> file('product_image');        
            if($get_image){
                //lay ten file
                $get_name_image =   $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image -> move('public/uploads/product',$new_image);
                $data['product_image'] = $new_image; 
                DB::table('tbl_product')-> insert($data);
                Session::put('message','Thêm sản phẩm thành công!');
                return redirect('all-product'); 
            }
            $data['product_image'] = '';
            DB::table('tbl_product')-> insert($data);
            Session::put('message','Thêm sản phẩm thành công!');
            return redirect('all-product'); 
        

        }
        //lay id tu thanh dia chi 
        public function unactive_product($product_id){
            DB::table('tbl_product') -> where('product_id',$product_id)->update(['product_status'=> 1]);
            Session::put('message','Đổi trạng thái thành công!');
            return redirect('all-product');
        }
        //lay id tu thanh dia chi 
        public function active_product($product_id){
            DB::table('tbl_product') -> where('product_id',$brand_product_id)->update(['product_status'=> 0]);
            Session::put('message','Đổi trạng thái thành công!');
            return redirect('all-product');
        }
        public function edit_product($product_id)
        {
            // $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();  
            // $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get(); 
            $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get(); 
            $manage_product = view('admin.edit_product')-> with('edit_product',$edit_product);
            return view ('admin_layout')->with('admin.edit_product',$manage_product);
            return view ('admin.edit_product');
        }
        public function delete_product($product_id)
        {
            DB::table('tbl_product')->where('product_id',$product_id)->delete();
            Session::put('message','Xoá danh mục thành công!');
            return redirect('all-product');
        }
        public function update_brand_product(Request $request,$brand_product_id)
        {
            $data = array(); 
            $data['brand_name']= $request -> brand_product_name; 
            $data['brand_desc']= $request -> brand_product_desc; 
            DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
            Session::put('message','Cập nhật thành công!');
            return redirect('all-brand-product');
        }
}
