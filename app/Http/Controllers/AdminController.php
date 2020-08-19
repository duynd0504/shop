<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests; 
use Session; 
use Illuminate\Support\Facades\Redirect; 
//use Illuminate\Support\Facades\Session;
session_start();

class AdminController extends Controller
{
    public function index()
    {
        return view ('admin_login');
    }
    public function showDashboard()
    {
        return view ('admin.dashboard');
    }
    // Hàm xử lý chức năng đăng nhập
    public function dashboard(Request $request)
    {
       $admin_email = $request -> admin_email;  
       $admin_password = md5($request -> admin_password);  
       //kiem tra trong DB  
       $result = DB::table('tbl_admin')-> where ('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
       if($result){
            Session::put ('admin_name',$result->admin_name);
            Session::put ('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
       }
       else 
       {
            Session::put ('mess' , 'Mật khẩu hoặc tài khoản bị sai. Vui lòng nhập lại !');
            return Redirect::to('/admin');
       }           

    }
    // Xu ly ham Logout
    public function logout()
    {
        Session::put ('admin_name',null);
        Session::put ('admin_id',null);
        return Redirect::to('/admin');
    }
}
