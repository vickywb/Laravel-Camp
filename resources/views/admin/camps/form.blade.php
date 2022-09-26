<div class="container">
    <div class="row col-md-10 offset-1">
        <div class="card-body">
            <div class="col-12">
                <div class="card card-xl-stretch">
                    <div class="card-body pt-8">
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center mb-2">
                                <span class="required">Title</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title', $camp->title) }}" required />
                            @if ($errors->has('title'))
                                <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center mb-2">
                                <span class="required">Price</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" name="price" value="{{ old('price', $camp->price) }}" required />
                            @if ($errors->has('price'))
                                <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <a href="{{ route('admin.camp.index') }}" class="btn btn-light btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
@endsection