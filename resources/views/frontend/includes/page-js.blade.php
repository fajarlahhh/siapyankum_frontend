<script src="/assets/js/bundle.js"></script>
<script src="/assets/js/theme/default.min.js"></script>
<script src="/assets/js/apps.min.js"></script>
<script src="/assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/assets/plugins/gritter/js/jquery.gritter.min.js"></script>
<script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<script>
	$(document).ready(function() {
		App.init();

        $('[data-toggle="tooltip"]').tooltip();
	});

</script>

@stack('scripts')
