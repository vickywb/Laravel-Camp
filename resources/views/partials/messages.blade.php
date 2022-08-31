@if (session('errors'))
    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row">
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-light">Error</h4>
            @if(session('errors'))
                <span>{{ session('errors') }}</span>
            @endif
        </div>
    </div>
@endif