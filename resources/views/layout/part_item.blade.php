<div class="col-md-6 mb-4">
    <article class="card shadow-sm">
        <div class="bd-placeholder-img card-img-top">
            <a href="{{ route('product', ['id' => $v['id']]) }}">
                @if (is_file(Config::get('const.image_path') . $v['file_name']))
                <img src="{{ asset(Config::get('const.image_path') . $v['file_name']) }}?{{@$v['updated_at']}}" class="rounded" width="100%" height="225">
                @else
                <img src="{{Config::get('const.noimg_path')}}" class="rounded" width="100%" height="225">
                @endif
            </a>
        </div>
        <div class="card-body">
            <p class="card-text">
            <h4><a href="{{ route('product', ['id' => $v['id']]) }}">{{$v['title']}}</a></h4>
            <div class="body">{{number_format($v['price'])}}円</div>
            <div>
                @foreach ($v['add_category'] as $k2 => $v2)
                <a href="{{ route('category', ['id' => $v2['id']]) }}"><span class="badge text-bg-primary">{{$v2['title']}}</span></a>
                @endforeach
            </div>
            <small class="text-muted">{{@$v['createdAtJa']}}</small>
        </div>
    </article>
</div>