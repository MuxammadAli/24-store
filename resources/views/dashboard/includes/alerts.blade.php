    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">@lang('admin.info')</h4>
            <p class="mb-0">
                {{ session()->pull('success') }}
            </p>
        </div>
    @endif

    @if(session()->has('info'))
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">@lang('admin.info')</h4>
            <p class="mb-0">
                {{ session()->pull('info') }}
            </p>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">@lang('admin.info')</h4>
            <p class="mb-0">
                {{ session()->pull('error') }}
            </p>
        </div>
    @endif
