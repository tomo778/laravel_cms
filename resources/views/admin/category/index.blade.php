@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
<div class="table-responsive">

	{{ $pagination->links('pagination::bootstrap-4') }}

	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th style="width: 40px">id</th>
				<th style="width: 60px">更新</th>
				<th>カテゴリ名</th>
				<th>説明</th>
				<th style="width: 120px">作成日</th>
				<th style="width: 120px">更新日</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pagination as $k => $v)
			<tr>
				<td>{{$v['id']}}</td>
				<td><a href="{{route('admin_create_category')}}/{{$v['id']}}">編集</a></td>
				<td>{{ Str::limit($v['title'], $limit = 30, $end = '...') }}</td>
				<td>{{ Str::limit($v['text'], $limit = 100, $end = '...') }}</td>
				<td>{{$v['created_at']}}</td>
				<td>{{$v['updated_at']}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $pagination->links('pagination::bootstrap-4') }}

</div>
@endsection