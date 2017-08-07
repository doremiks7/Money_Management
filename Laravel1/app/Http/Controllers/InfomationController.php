<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\InfomationRequest;
use App\User;
use Hash;
use Auth;
use Illuminate\Support\Facades\Input;
use File;


class InfomationController extends Controller
{

    public function getUpdate()
    {
        $data = User::find(Auth::user()->id);
        $avatar_user = $data->avatar;
    	return view('information.information', compact('avatar_user'));
    }

    public function postUpdate(InfomationRequest $request, $id)
    {
    	$data = User::find($id);
        $old_image = $data->avatar;
    	$data->name = $request->name;
    	$data->address = $request->address;
    	$data->phone = $request->phone;
    	$data->sex = $request->rdoStatus;
    	$data->date_birth = $request->date_birth;


        $img = $request->file('upd_avatar');
        /*$img_name = $img->getClientOriginalName();
        $data->avatar = $img_name;
        $des = 'public/upload/images';
        File::delete('public/upload/images/'.$old_image);
        $img->move($des, $img_name);

    	$data->save();*/
        if($img != null)
        {
            if(Input::file('upd_avatar')->isValid()){
                $img_name = $img->getClientOriginalName();
                $data->avatar = $img_name;
                $des = 'public/upload/images';
                File::delete('public/upload/images/'.$old_image);
                $img->move($des, $img_name);
            }  
        }
        else{
            $data->avatar = $request->old_img;
        }

         $data->save();
    	return back()->with('success', 'You have been changed you infomation successful');
    }

    public function getChangePassword()
    {
    	return view('information.changepassword');
    }

    public function postChangePassword()
    {
    	$user = User::find(Auth::user()->id);
    	if(Hash::check(Input::get('oldpassword'), $user['password'])  && (Input::get('password') == Input::get('password_confirmation')))
    	{
    		$user->password = bcrypt(Input::get('password'));
    		$user->save();
    		return back()->with('success', 'password has changed successful');
    	}
    	else
    	{
    		return back()->with('error', 'Change has serveral errors');
    	}
    }
}
