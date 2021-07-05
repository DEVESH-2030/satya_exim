    <script src="{{url('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('custom/css/toastr.min.css') }}">
		<script src="{{ asset('custom/js/toastr.min.js') }}"></script>

    @if(session()->has('success'))
      <script>
          toastr.success('<strong>{{session()->get('success')}}</strong>');
      </script>
    @elseif(session()->has('error'))
      <script>
        toastr.error('<strong>{{session()->get('error')}}</strong>');
      </script>
    @endif