<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests; 
use Session; 
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
{
    //Route::get('/add-category-product','CategoryProduct@add_category_product' )
    
    public function add_category_product()
    {
        return view ('admin.add_category_product');
    }
    //Route::get('/all-category-product','CategoryProduct@all_category_product' )
    public function all_category_product()
    {
        $all_category_product = DB::table('tbl_category_product')->get(); 
        $manage_category_product = view('admin.all_category_product')-> with('all_category_product',$all_category_product);
        return view ('admin_layout')->with('admin.all_category_product',$manage_category_product);
    }
    //save-category-product ( them mot danh muc )
    public function save_category_product(Request $request)
    {
            $data = array();  
            $data['category_name']= $request -> category_product_name; 
            $data['category_desc']= $request -> category_product_desc; 
            $data['category_status']= $request -> category_product_status; 
            
            DB::table('tbl_category_product')-> insert($data);
            Session::put('message','Thêm thành công!');

           return redirect('all-category-product'); 
           

    }
    //lay id tu thanh dia chi 
    public function unactive_category_product($category_product_id){
        DB::table('tbl_category_product') -> where('category_id',$category_product_id)->update(['category_status'=> 1]);
        Session::put('message','Đổi trạng thái thành công!');
        return redirect('all-category-product');
    }
    //lay id tu thanh dia chi 
    public function active_category_product($category_product_id){
        DB::table('tbl_category_product') -> where('category_id',$category_product_id)->update(['category_status'=> 0]);
        Session::put('message','Đổi trạng thái thành công!');
        return redirect('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get(); 
        $manage_category_product = view('admin.edit_category_product')-> with('edit_category_product',$edit_category_product);
        return view ('admin_layout')->with('admin.edit_category_product',$manage_category_product);
        //return view ('admin.edit_category_product');
    }
    public function delete_category_product($category_product_id)
    {
       DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
       Session::put('message','Xoá danh mục thành công!');
       return redirect('all-category-product');
    }
    public function update_category_product(Request $request,$category_product_id)
    {
       $data = array(); 
       $data['category_name']= $request -> category_product_name; 
       $data['category_desc']= $request -> category_product_desc; 
       DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
       Session::put('message','Cập nhật thành công!');
       return redirect('all-category-product');
    }
}
