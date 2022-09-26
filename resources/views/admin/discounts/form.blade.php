<div class="container">
    <div class="row col-md-10 offset-1">
        <div class="card-body">
            <div class="col-12">
                <div class="card card-xl-stretch">
                    <div class="card-body pt-8">
                        <input type="hidden" name="id" value="{{ $discount->id }}">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center mb-2">
                                <span class="required">Discount Title</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title', $discount->title) }}" required />
                            @if ($errors->has('title'))
                                <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center mb-2">
                                <span class="required">Discount Code</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" name="code" value="{{ old('title', $discount->code) }}" required />
                            @if ($errors->has('title'))
                                <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center mb-2">
                                <span class="required">Discount Type</span>
                            </label>
                            <select class="form-select" aria-label="Default select example" name="type" required>
                                <option>Select One</option>
                                @foreach ($typeMaps as $key => $typeMap)
                                <option value="{{ $key }}"
                                @if (old('type', $typeMap->type ?? '' ) == $key)
                                    selected
                                @endif
                                >
                                {{ $typeMap}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('type'))
                                <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center mb-2">
                                <span class="required">Discount Amount</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" name="amount" value="{{ old('price', $discount->amount) }}" required />
                            @if ($errors->has('amount'))
                                <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('amount') }}</div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <a href="{{ route('admin.discount.index') }}" class="btn btn-light btn-sm">Cancel</a>
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