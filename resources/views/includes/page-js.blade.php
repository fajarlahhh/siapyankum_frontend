<script src="{{ asset('/assets/js/bundle.js') }}"></script>
<script src="{{ asset('/assets/js/theme/default.min.js') }}"></script>
<script src="{{ asset('/assets/js/apps.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/gritter/js/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>

<script>
	$(document).ready(function() {
		App.init();

        $('[data-toggle="tooltip"]').tooltip();

		@if(Session::get('swal_pesan'))
            swal("{{ Session::get('swal_judul') }}", "{{ Session::get('swal_pesan') }}", "{{ Session::get('swal_tipe') }}");
        @endif

        @if(Session::get('gritter_judul'))
	    setTimeout(function() {
			$.gritter.add({
				title: '{{ Session::get('gritter_judul').' '.Auth::user()->pengguna_nama.'!' }}',
				text: '{{ Session::get('gritter_teks') }}',
				image: '{{ Session::get('gritter_gambar') }}',
				sticky: true,
				time: '',
				class_name: 'my-sticky-class'
			});
		}, 1000);
        @endif


        Pusher.logToConsole = true;

        var pusher = new Pusher('d93e7eade798d00e7755', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            var pending = parseInt($('#pending').html());
            $('#pending').html(pending + 1);
        });

        $.ajax({
            type: "get",
            url: "notif" ,
            cache: false,
            success: function (data) {
                $('#pending').html(data);
            }
        });
	});

</script>

@stack('scripts')
