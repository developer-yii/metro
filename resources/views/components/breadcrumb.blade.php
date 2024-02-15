<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if (isset($breadcrumbs))
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (!$loop->last)
                            <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a></li>
                            @else
                                <li class="breadcrumb-item active">{{ $breadcrumb['title'] }}</li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </div>

            <h4 class="page-title">{{ $pageTitle ?? '' }}</h4>

        </div>
    </div>
</div>
