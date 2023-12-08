<div class="row">
    <div class="col-md-12">
        <h6 class="d-flex align-items-center border rounded bg-success text-white py-2 px-2">
            <i class="bi bi-arrow-right me-2"></i> Test Email Service
        </h6>
    </div>
    <div class="col-md-12">
        <form action="{{ url('/common/send-test-email') }}" method="post" class="modal-body bg-white p-4">
            @csrf
            @method('POST')

            <div class="form-group mb-3">
                <label for="email" class="mb-1">
                    Email Address: <span class="text-danger">*</span>
                </label>
                <input type="email" class="form-control" name="email" id="email"
                       placeholder="Enter your email"
                       value="{{ old('email') }}">
                @error('email')
                <div class="error text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group d-flex justify-content-end mb-2">
                <input type="reset" class="btn btn-secondary me-2" value="Reset">
                <input type="submit" class="btn btn-primary" value="Send Test Email">
            </div>
        </form>
    </div>
</div>