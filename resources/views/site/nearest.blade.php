
@extends('site.layouts')
@section('content')
    <div class="row container main" id="content">
        {{-- @foreach($users as $user)
        <div class="col-4 col-md-2 mt-1 mb-3 zoom">
            <a href="javascript:" data-id="{{ $user->id }}" class="start_chat">
                <img class=" img_card" src="{{  route('image_show', $user->image) }}" alt="hello img">
            </a>
            <h4 class="name">{{  $user->name }}</h4>
        </div>
        @endforeach --}}
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#content').on("click", ".start_chat", function () {
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
<script>
    function initMap() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var action = "{{ route('nearest') }}";
                $.ajax({
                    url:  action,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {lat: pos.lat, lng: pos.lng, _token: CSRF_TOKEN},
                    success: function(data, status){
                        if(data.length > 0) {
                            var i;
                            for(i = 0; i < data.length; i++) {
                                $('#content').append(`
                                    <div class="col-4 col-md-2 mt-1 mb-3 zoom">
                                        <a href="javascript:" data-id="${data[i].id}" class="start_chat">
                                            <img class=" img_card" src="{{  route('image_show') }}/${data[i].image}" alt="hello img">
                                        </a>
                                        <h4 class="name">${data[i].name}</h4>
                                    </div>
                                `);
                            }
                        }
                    }
                });
            }, function() {
                $('#content').append(`<div class='text-center alert alert-danger'>Browser doesn't support Geolocation</div>`)
            });

        } else {
            // Browser doesn't support Geolocation
            $('#content').append(`<div class='text-center alert alert-danger'>Browser doesn't support Geolocation</div>`)
        }
    }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9UBKQHciVMSJZEoM640mtwKkTXavjrD4&callback=initMap">
</script>
@endsection




