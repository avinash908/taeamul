<?php
namespace App\Http\Services;

use App\User;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ShopService 
{
    public static function create(User $user,array $data)
    {
		$request = request();
        $input = $data;
			
    	// shop number with code
		$input['shop_number'] = $data['shop_number_code'].$data['shop_number'];

		// upload national id copy
		$files_path = 'assets/files/';
		if ($file = $request->file('national_copy')) 
        {              
            $file_n = time().$file->getClientOriginalName();
            $file->move(base_path('../'.$files_path),$file_n);            
        	$input['national_copy'] = $files_path .'/'. $file_n;
        } 

        // upload comercial registration copy

        if ($file = $request->file('comercial_reg_copy')) 
        {              
            $file_r = time().$file->getClientOriginalName();
            $file->move(base_path('../'.$files_path),$file_r);            
        	$input['comercial_reg_copy'] = $files_path .'/'. $file_r;
        }
		$user->update(['is_vendor'=>1,'status'=>0]);
		$user->shop()->create($input);

		return $user;
    }
}