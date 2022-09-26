<div class="container">
    <div class="row col-md-10 offset-1">
        <div class="card-body">
            <div class="col-12">
                <div class="card card-xl-stretch">
                    <div class="card-body pt-8">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center mb-2">
                                <span class="required">Camp Title</span>
                            </label>
                            <select class="form-select" aria-label="Default select example" name="camp_id" required>
                                <option>Select One</option>
                                @foreach ($camps as $camp)
                                <option value="{{ $camp->id }}"
                                @if (old('camp_id', $camp->id ) == $campBenefit->camp_id)
                                    selected
                                @endif
                                >
                                {{ $camp->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('camp_id'))
                                <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('camp_id') }}</div>
                            @endif
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center mb-2">
                                <span class="required">Camp Benefit Name</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name', $campBenefit->name) }}" required />
                            @if ($errors->has('name'))
                                <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('name') }}</div>
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