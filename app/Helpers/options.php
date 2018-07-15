<?php
	use App\Options;
	
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
	function active_class_path($paths, $classes = null)
{
    foreach ((array) $paths as $path) {
        if (request()->is($path)) {
            return 'class="' . ($classes ? $classes . ' ' : '') . 'active"';
        }
    }
    return $classes ? 'class="' . $classes . '"' : '';
}

?>