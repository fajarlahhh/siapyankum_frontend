<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('includes.head')
</head>
@php
	$bodyClass = (!empty($boxedLayout)) ? 'boxed-layout' : '';
	$bodyClass .= (!empty($paceTop)) ? 'pace-top ' : '';
	$bodyClass .= (!empty($bodyExtraClass)) ? $bodyExtraClass . ' ' : '';
	$sidebarHide = (!empty($sidebarHide)) ? $sidebarHide : '';
	$sidebarTwo = (!empty($sidebarTwo)) ? $sidebarTwo : '';
	$topMenu = (!empty($topMenu)) ? $topMenu : '';
	$footer = true;

	$pageContainerClass = (!empty($topMenu)) ? 'page-with-top-menu ' : '';
	$pageContainerClass .= (!empty($sidebarRight)) ? 'page-with-right-sidebar ' : '';
	$pageContainerClass .= (!empty($sidebarLight)) ? 'page-with-light-sidebar ' : '';
	$pageContainerClass .= (!empty($sidebarWide)) ? 'page-with-wide-sidebar ' : '';
	$pageContainerClass .= (!empty($sidebarHide)) ? 'page-without-sidebar ' : '';
	$pageContainerClass .= (!empty($sidebarMinified)) ? 'page-sidebar-minified ' : '';
	$pageContainerClass .= (!empty($sidebarTwo)) ? 'page-with-two-sidebar ' : '';
	$pageContainerClass .= (!empty($contentFullHeight)) ? 'page-content-full-height ' : '';

	$contentClass = (!empty($contentFullWidth) || !empty($contentFullHeight)) ? 'content-full-width ' : '';
	$contentClass .= (!empty($contentInverseMode)) ? 'content-inverse-mode ' : '';
@endphp
<body class="{{ $bodyClass }}" >
        <img src="/assets/img/login-bg/wallpaper.png" style="position: absolute;
        padding-right: 10px;
        padding-left: 10px;
        top: 120px !important;
        width: 100%;
        height: auto;
        opacity: 0.1; z-index: -1;">
	@include('frontend.includes.component.page-loader')

	<div id="page-container" class="page-container fade page-without-sidebar gradient-enabled {{ $pageContainerClass }}">
		<div id="content" class="content {{ $contentClass }}">
			<div class="row">
				<div class="col-3 col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xl-3 text-center">
					<img src="/assets/img/logo/favicon.png" height="60">
				</div>
				<div class="col-6 col-sm-6 col-xs-6 col-md-6 col-lg-6 col-xl-6 text-center">
					<h4 class="mt-2">SIAP YANKUM</h4>
					<small>Sistem Aplikasi Pelayanan Hukum</small>
				</div>
				<div class="col-3 col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xl-3 text-center">
					<img src="/assets/img/logo/ntb.png" height="60">
				</div>
				<div class="col-12">
                    <hr>
                    <div class="pull-right">
                        @if (Auth::user())
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>Hai, {{ Auth::user()->pengguna_nama }}</small>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('konsultasilogout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Log Out') }}</a>

                                <form id="logout-form" action="{{ route('konsultasilogout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>
			@yield('content')
		</div>

		@includeWhen($footer, 'frontend.includes.footer')
	</div>
	@include('frontend.includes.page-js')
</body>
</html>
