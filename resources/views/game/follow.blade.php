@extends('game.public.layout') 

@section('content')
<section
	style="box-sizing: border-box; background-color: rgb(255, 255, 255);">
	<section class="" style="box-sizing: border-box;">
		<section class=""
			style="margin-top: 10px; margin-bottom: 10px; padding-right: 15px; padding-left: 15px; text-align: center; box-sizing: border-box;">
			<section
				style="box-sizing: border-box; width: 8em; height: 8em; display: inline-block; vertical-align: bottom; border-radius: 100%; border: 2px solid rgb(95, 156, 239); box-shadow: rgb(204, 204, 204) 1px 1px 2px; background-image: url(/img/follow1.png); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"
				class="">
			</section>
			<section class=""
				style="border: 1px solid rgb(95, 156, 239); border-radius: 1em; padding: 4em 15px 10px; margin-top: -4em; box-sizing: border-box;">
				<section class="" style="box-sizing: border-box;">
					<section class="" style="box-sizing: border-box;">
						<section class="" style="font-size: 24px; box-sizing: border-box;">
							<section style="box-sizing: border-box;">
								<br style="box-sizing: border-box;">
							</section>
						</section>
					</section>
				</section>
				<section class="" style="box-sizing: border-box;">
					<section class="" style="box-sizing: border-box;">
						<section class="" style="box-sizing: border-box;">
							<section style="box-sizing: border-box;">{{ $message }}</section>
							<section style="box-sizing: border-box;">长按识别二维码！</section>
						</section>
					</section>
				</section>
				<section class="" style="box-sizing: border-box;">
					<section class=""
						style="padding-top: 0.5em; padding-bottom: 0.5em; box-sizing: border-box;">
						<section class=""
							style="height: 1px; box-sizing: border-box; background-color: rgb(95, 156, 239);"></section>
					</section>
				</section>
				<section class="" style="box-sizing: border-box;">
					<section class="" style="box-sizing: border-box;">
						<section class="" style="box-sizing: border-box;">
							<section style="box-sizing: border-box;">微信：量子防务在线</section>
						</section>
					</section>
				</section>
				<section class="" style="box-sizing: border-box;">
					<section class=""
						style="margin: auto; padding-top: 5px;  box-sizing: border-box;">
						<img
							style="box-sizing: border-box; vertical-align: middle; width: 180px; visibility: visible !important; height: 180px;"
							class="" data-ratio="1" data-w="222"
							data-src="{{asset('/img/erm2.png')}}"
							data-type="jpeg" 
							src="{{asset('/img/erm2.png')}}">
					</section>
				</section>
			</section>
		</section>
	</section>
</section>
@endsection
