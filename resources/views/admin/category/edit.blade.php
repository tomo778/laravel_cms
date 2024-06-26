@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')

@include('admin._include.edit_header')
<form method="post" action="{{ request()->fullUrl() }}" name="{{ route('admin_val_category') }}">
	{{ csrf_field() }}

	@if (!empty($update_datas['id']))
	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">id</label>
		<div class="col-sm-10">
			{{@$update_datas['id']}}
		</div>
	</div>
	<input type="hidden" class="form-control" name="id" value="{{@$update_datas['id']}}">
	@endif

	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">タイトル</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="title" value="{{@$update_datas['title']}}">
			<div class="text-danger" data-errmes="title"></div>
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">内容</label>
		<div class="col-sm-10">
			<textarea type="text" name="text" class="form-control" rows="5">{{@$update_datas['text']}}</textarea>
			<div class="text-danger" data-errmes="text"></div>
		</div>
	</div>

	@include('admin._include.edit_footer')

</form>

@endsection