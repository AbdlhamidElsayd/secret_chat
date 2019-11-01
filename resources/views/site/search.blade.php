
@extends('site.layouts')
@section('content')
    <div class="row container main" >
        @foreach($users as $user)
        <div class="col-4 col-md-2 mt-1 mb-3 zoom">
            <a href="javascript:" data-id="{{ $user->id }}" class="start_chat">
                <img class=" img_card" src="{{  route('image_show', $user->image) }}" alt="hello img">
            </a>
            <h4 class="name">{{  $user->name }}</h4>
        </div>
        @endforeach
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('.start_chat').click(function () {
            var id = $(this).attr('data-id');
            var action = "{{ route('start_chat') }}";
            $.ajax({
                url:  action,
                type: 'POST',
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, id: id},
                success: function(data, status){
                    window.location = "{{ route('chat') }}";
                }
            });
        });
    });
</script>
@endsection




