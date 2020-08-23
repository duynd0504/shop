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
    
        public function add_brand_product()
        {
            return view ('admin.add_brand_product');
        }
        //Route::get('/all-category-product','CategoryProduct@all_category_product' )
        public function all_brand_product()
        {
            $all_brand_product = DB::table('tbl_brand')->get(); 
            $manage_brand_product = view('admin.all_brand_product')-> with('all_brand_product',$all_brand_product);
            return view ('admin_layout')->with('admin.all_brand_product',$manage_brand_product);
        }
        //save-brand-product ( them mot danh muc )
        public function save_brand_product(Request $request)
        {
            $data = array();  
            $data['brand_name']= $request -> brand_product_name; 
            $data['brand_desc']= $request -> brand_product_desc; 
            $data['brand_status']= $request -> brand_product_status; 
            
            DB::table('tbl_brand')-> insert($data);
            Session::put('message','Thêm thành công 1 thương hiệu!');

            return redirect('all-brand-product'); 
        

        }
        //lay id tu thanh dia chi 
        public function unactive_brand_product($brand_product_id){
            DB::table('tbl_brand') -> where('brand_id',$brand_product_id)->update(['brand_status'=> 1]);
            Session::put('message','Đổi trạng thái thành công!');
            return redirect('all-brand-product');
        }
        //lay id tu thanh dia chi 
        public function active_brand_product($brand_product_id){
            DB::table('tbl_brand') -> where('brand_id',$brand_product_id)->update(['brand_status'=> 0]);
            Session::put('message','Đổi trạng thái thành công!');
            return redirect('all-brand-product');
        }
        public function edit_brand_product($brand_product_id)
        {
            $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get(); 
            $manage_brand_product = view('admin.edit_brand_product')-> with('edit_brand_product',$edit_brand_product);
            return view ('admin_layout')->with('admin.edit_brand_product',$manage_brand_product);
            return view ('admin.edit_category_product');
        }
        public function delete_brand_product($brand_product_id)
        {
            DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
            Session::put('message','Xoá danh mục thành công!');
            return redirect('all-brand-product');
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
