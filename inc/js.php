<!-- slider.js -->
<link type="text/css" href="/base/css/camera.css" rel="stylesheet" media="all" />
<script src='/base/js/jquery.easing.1.3.js'></script>
<script src='/base/js/jquery.mobile.customized.min.js'></script>
<script src="/base/js/camera.js"></script>

<script>
	jQuery(function(){
		jQuery('#camera_wrap').camera({
			height: '600px',
			fx: 'mosaic',
			autoAdvance: true,
			hover: false,
			loader: 'none',
			pagination: false,
			navigation: false,
			navigationHover: false,
			playPause: false,
			pauseOnClick: false,
			time: 2000,
			transPeriod: 1500,
			portrait: false,
		});
	});
</script>

<!-- textslider.js -->
<link type="text/css" href="/base/css/animate.css" rel="stylesheet">
<script src="/base/js/jquery.lettering.js"></script>
<script src="/base/js/jquery.textillate.js"></script>

<script>
	jQuery(function(){
		$('.textef1').textillate({
			// ループのオンオフ、falseの場合、outは発動しない
			loop: true,
			// テキストが置き換えられるまでの表示時間
			minDisplayTime: 8000,
			// フェードインのエフェクトの詳細設定
			in: {
				// エフェクトの名前（animate.cssをご参照下さい）
				effect: 'fadeInLeft',
			},
			out: {
				effect: 'fadeOutRight',
			}
		});

		$('.textef2').textillate({
			loop: true,
			minDisplayTime: 6000,
			initialDelay: 800,
		in: {
			effect: 'fadeInLeft',
		},
		out: {
			effect: 'fadeOutRight',
		}
		});

		$('.textef3').textillate({
			loop: true,
			minDisplayTime: 4500,
			initialDelay: 2000,
		in: {
			effect: 'fadeInLeft',
		},
		out: {
			effect: 'fadeOutRight',
		}
		});
		
		$('.textef4').textillate({
			loop: false,
		in: {
			effect: 'fadeInLeft',
		},
		});
	});
</script>