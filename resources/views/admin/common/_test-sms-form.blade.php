<div class="row">
    <div class="col-md-12">
        <h6 class="d-flex align-items-center border rounded bg-warning text-white py-2 px-2">
            <i class="bi bi-arrow-right me-2"></i> Test SMS Service
        </h6>
    </div>
    <div class="col-md-12">
        <form action="{{ url('/common/send-test-sms') }}" method="post" class="modal-body bg-white p-4">
            @csrf
            @method('POST')

            <div class="form-group mb-3">
                <label for="phone" class="mb-1">
                    Phone Number: <span class="text-danger">*</span>
                </label>
                <input type="tel" class="form-control" name="phone" id="phone"
                       placeholder="Enter your phone"
                       value="{{ old('phone') }}">
                @error('phone')
                <div class="error text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group d-flex justify-content-end mb-2">
                <input type="reset" class="btn btn-secondary me-2" value="Reset">
                <input type="submit" class="btn btn-primary" value="Send Test Sms">
            </div>
        </form>
    </div>
</div>