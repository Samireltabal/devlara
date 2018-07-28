@if(session('success'))
<script>notification('success',"{{ session('success') }}")</script>
@elseif(session('faild'))
<script>notification('faild',"{{ session('faild') }}")</script>
@elseif(session('warning'))
<script>notification('warning',"{{ session('warning') }}")</script>
@endif
@if( ! check_shift() && Auth::user()->hasRole('admin') )
<?php $locale = get_locale(); ?>
@if($locale == "ar")
<script>
    toast("{{__('Warning')}}","{{ __('Current shift date is obselete please go to Shifts panel and add new one') }}","red","fa fa-window-close",true,'topLeft');
</script>
@else
<script>
    toast("{{__('Warning')}}","{{ __('Current shift date is obselete please go to Shifts panel and add new one') }}","red","fa fa-window-close",false,'topRight');
</script>
@endif
@endif

@if( ! check_shift() && ! Auth::user()->hasRole('admin') )
<?php $locale = get_locale(); ?>
@if($locale == "ar")
<script>
    toast("{{__('Warning')}}","{{ __('Current shift date is obselete please Contact System Administrator') }}","red","fa fa-window-close",true,'topLeft');
</script>
@else
<script>
    toast("{{__('Warning')}}","{{ __('Current shift date is obselete please Contact System Administrator') }}","red","fa fa-window-close",false,'topRight');
</script>
@endif
@endif
