<?php
	use App\Options;
	use App\Shifts;
	use Carbon\Carbon;
	use App\Categories;
	use App\Products;
	use App\Employees;
	use App\Attendances;
	
	function get_locale(){
		if (Auth::check()){
			return $locale = Auth::user()->locale ? Auth::user()->locale : global_locale() ;	
		}elseif(global_locale()){
			return $locale = global_locale() ? global_locale() : App::getLocale() ;	
		}else{
			return App::getLocale();
		}
	}
	function global_locale() {
		$option = new Options;
		$locale = $option::where('key','locale')->first();
		if($locale){
			return $locale->value;	
		}else{
			return config('app.locale', 'en');
		}
		
	}
	function get_option($key = null) {
		 if ($key) {
			$options = new Options;
			$option = $options::where('key',$key)->first();
			if($option){
				if($option->value){
					return $option->value;
				}else{
					return "No Value assigned to this key";
				}
			}else{
				return "No key assigned with this name";
			}
		}else{
			return "you must supply key to get_option() function";
		}
	}
	function get_shift() {
		$shifts = Shifts::where('active',1)->limit(1)->get()->first();
		return $shifts->id;
	}
	function get_current_shift_date() {
		$shifts = Shifts::where('active',1)->limit(1)->get();
		return $shifts[0]->created_at;
	}
	function check_shift() {
		$time = Carbon::today()->Format('Y-m-d');
		$shifts = Shifts::where('active',1)->limit(1)->get()->first();
		$shift_time = $shifts->created_at;
		if($time != $shift_time) {
			return False;
		}else{
			return true;
		}
		
	}
	function category_name($id) {
		$category = Categories::find($id);
		return $category->cat_name;
	}
	function get_status($status) {
		if($status){
			return '<span class="label label-success">' . __("Active"). '</span>';
		}else{
			return '<span class="label label-danger">' . __("Inactive"). '</span>';
		}
	}
	function getEntitlements($employee_id) {
        $employee = Employees::find($employee_id);
        if($employee){
        $rate = $employee->rate;
        $attendances = $employee->attendances->count();
        $entitlements = $rate * $attendances;
        $payments = $employee->payments->sum('paid');
        $net = $entitlements - $payments ;
        $response = ['Entitlements' => $net ];
        return $net;
        }else{
            return response()->json( ['Entitlements'=>'faild']  ,200);
        }
    }
	function get_product_name($id) {
		// if($id != null)
		// {
		return $product = Products::find($id);
		// if($product->count() > 0)
		// {
		// return $product->name;
		// }
		// }else{
		// 	return 'deleted';
		// }
	}
	function humanFilesize($size, $precision = 2) {
		$units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
		$step = 1024;
		$i = 0;
	
		while (($size / $step) > 0.9) {
			$size = $size / $step;
			$i++;
		}
		
		return round($size, $precision).$units[$i];
	}
?>