
@php
	if($list){
		$style = $list[$field]['style'];
		$data = $list[$field]['data'];

		$config = config($data);
		if(\Illuminate\Support\Str::startsWith($data,'platform') && trans('res.option.'.substr($data,9))){
			$config = trans('res.option.'.substr($data,9));
		}
	}

	
@endphp
@if($style)
	<span class="label {{ config($style)[$key] }}">
		{{ $config[$key] }}
	</span>
@else
	<span class="label {{ config('platform.style_label')[current(array_keys(array_keys(config($data)),$key))%13] }}">
		{{ $config[$key] }} - {{ $key }}</span>
@endif
