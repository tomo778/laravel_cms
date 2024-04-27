@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', '')
@section('body')
<div class="table-responsive">

	{{ $pagination->links('pagination::bootstrap-4') }}
	<div id="form-checkbox">
		<label for="form-select">チェックしたものを</label>
		<select id="form-select" class="form-control" name="form-select">
			<option value=""></option>
			<option value="1">公開にする</option>
			<option value="2">非公開にする</option>
			<option value="">--------</option>
			<option value="3">削除する</option>
		</select>
	</div>
	<hr>
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th width="50">id</th>
				<td width="50"><input type="checkbox" value="0" name="checkbox-all"></td>
				<th width="50">更新</th>
				<th width="50">状態</th>
				<th width="100">商品名</th>
				<th width="100">商品画像</th>
				<th>説明</th>
				<th width="100">価格</th>
				<th width="100">個数</th>
				<th width="100">作成日</th>
				<th width="100">更新日</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pagination as $k => $v)
			<tr>
				<td>{{$v['id']}}</td>
				<td><input type="checkbox" value="{{$v['id']}}" name="checkbox-val"></td>
				<td><a href="{{route('admin_create_product')}}/{{$v['id']}}">編集</a></td>
				<td>
					@if ($v['status'] == Config('const.STATUS_ON'))
					<span class="badge badge-info">{{Config('const.status')[$v['status']]}}</span>
					@else
					<span class="badge badge-danger">{{Config('const.status')[$v['status']]}}</span>
					@endif
				</td>
				<td>{{ Str::limit($v['title'], $limit = 30, $end = '...') }}</td>

				@if (is_file(Config::get('const.thumbnail_path') . $v['file_name']))
				<td><img src="{{ asset(Config::get('const.thumbnail_path') . $v['file_name']) }}?{{@$v['updated_at']}}" alt="dummy" width="100"></td>
				@else
				<td><img src="{{Config::get('const.noimg_path')}}" alt="dummy" width="100"></td>
				@endif

				<td>{{ Str::limit($v['text'], $limit = 100, $end = '...') }}</td>
				<td>{{$v['price']}}</td>
				<td>{{$v['num']}}</td>
				<td>{{$v['created_at']}}</td>
				<td>{{$v['updated_at']}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $pagination->links('pagination::bootstrap-4') }}

</div>
@endsection