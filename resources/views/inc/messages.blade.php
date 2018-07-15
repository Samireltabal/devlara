@if(session('success'))
<script>notification('success',"{{ session('success') }}")</script>
@elseif(session('faild'))
<script>notification('faild',"{{ session('faild') }}")</script>
@elseif(session('warning'))
<script>notification('warning',"{{ session('warning') }}")</script>
@endif