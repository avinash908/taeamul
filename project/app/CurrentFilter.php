<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentFilter
{
	public static function category($childcat = null, $subcat = null, $cat = null)
	{
		if(empty($childcat))
		{
            if(empty($subcat))
            {
                if(empty($cat))
                {
                    return false;
                }
                else{
                    return $cat;
                }
            }
            else{
                return $subcat;
            }
        }
        else{
            return $childcat->name;
        }
	}
}
