<?php
namespace App\Helpers;


/**
*Image Helper Class
*/

use App\Models\User;
use App\Helpers\GravatarHelper;


class ImageHelper{
	public static function getUserImage($id){
		$user = User::find($id);
		$avatar_url = "";
		if(!is_null($user)){
           if($user->avatar == NULL){
           	//return him avatar image
           	if(GravatarHelper::validate_gravatar($user->email)){
           		$avatar_url = GravatarHelper::gravatar_image($user->email,100);

           	}else{
             $avatar_url=url('assets/images/user.png');
           	}


           }else{
           	$avatar_url=url('assets/images/users/'.$user->avatar);
           }
		}else{
			//return redirect('/');
		}
		return $avatar_url;
	}
}