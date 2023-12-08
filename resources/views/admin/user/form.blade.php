<div class="text-lg-end">
    @if(is_enable_offline_voting_function())
        <div class="row align-items-center form-group mb-3 @if(Route::currentRouteName() === 'edit-user') d-none @endif">
            <p class="col-lg-3 col-form-label mb-0">
                <input class="form-check-input flex-shrink-0" type="checkbox" name="is_create_officer" value="1"
                       @if($user->isOfficer()) checked @endif id="create-officer"/>
            </p>
            <div class="col flex-grow-1 text-start ">
                <label for="create-officer" class="col-form-label">Create Officer</label>
            </div>
        </div>
    @endif
    <div id="show-counter-officer" @if($user->isOfficer()) style="display:
        block;"
         @else style="display: none;" @endif>
        <div class="row align-items-center form-group mb-3">
            <label for="counter_officer_id" class="col-lg-3 col-form-label">Counter Officer:</label>
            <div class="col flex-grow-1">
                @if(Route::currentRouteName() == 'edit-user' && $user->isOfficer())
                    <input type="text" class="form-control rounded-pill ps-4"
                           value="{{ optional($user->counterOfficer)->name }}"
                           readonly>
                @else
                    <select class="form-control form-select rounded-pill ps-4" name="counter_officer_id"
                            id="counter_officer_id">
                        <option disabled selected> Select Counter Officer</option>
                        @foreach(get_counter_officer_list() as $counterOfficer)
                            <option @if($counterOfficer->id == $user->counter_officer_id) selected
                                    @endif value="{{ old('counter_officer_id', $counterOfficer->id) }}">
                                {{ $counterOfficer->name }}</option>
                        @endforeach
                    </select>
                @endif
                @error('counter_officer_id')
                <div class="text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group-wrapper">
        <div class="row align-items-center form-group mb-3 ">
            <label for="username" class="col-lg-3 col-form-label">
                Username: <span class="text-danger">*</span>
            </label>
            <div class="col flex-grow-1">
                <input type="text" class="form-control rounded-pill ps-4" id="username" name="username"
                       value="{{ old('username', $user->username) }}" placeholder="Username"/>
                @error('username')
                <div class="text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row align-items-center form-group mb-3 ">
            <label for="email" class="col-lg-3 col-form-label">
                Email: <span class="text-danger">*</span>
            </label>
            <div class="col flex-grow-1">
                <input type="email" class="form-control rounded-pill ps-4" id="email" name="email"
                       value="{{ old('email', $user->email) }}" placeholder="Email"/>
                @error('email')
                <div class="text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row align-items-center form-group mb-3 ">
            <label for="name" class="col-lg-3 col-form-label">Full Name:</label>
            <div class="col flex-grow-1">
                <input type="text" class="form-control rounded-pill ps-4" id="name"
                       value="{{ old('name', $user->name) }}" placeholder="Full Name" name="name"/>
                @error('name')
                <div class="text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row align-items-center form-group mb-3">
        <label for="password" class="col-lg-3 col-form-label">
            Password: <span class="text-danger">*</span>
        </label>
        <div class="col flex-grow-1">
            <input type="password" class="form-control rounded-pill ps-4" id="password"
                   value="{{ old('password') }}" placeholder="Password (Type Here..)" name="password"
                   autocomplete="new-password"/>
        </div>
        @error('password')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="row align-items-center form-group mb-3">
        <label for="select-role" class="col-lg-3 col-form-label">
            Select Role: <span class="text-danger">*</span>
        </label>
        <div class="col flex-grow-1">
            <select class="form-control form-select rounded-pill ps-4" id="select-role" name="role_id">
                <option value="">Select a role</option>
                @foreach(get_role_list() as $role)
                    <option @if($user->hasRole($role->name)) selected
                            @endif value="{{ $role->id }}"> {{ $role->name }} </option>
                @endforeach
            </select>
            @error('role_id')
            <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        function checkCreateOfficer(value) {
            if (value === true) {
                $('#show-counter-officer').slideDown();
                $('.form-group-wrapper').slideUp();
                $("#select-role > option").each(function () {
                    let officer = $(this).text().trim().toLowerCase();
                    if (officer === 'officer') {
                        $("#select-role > option").removeAttr('selected');
                        $(this).attr("selected", "selected");
                        $('#select-role').css({
                            'pointer-events': 'none',
                            'background': '#e7e7e7'
                        });
                    }
                });
            } else {
                if ($('.add-user-form').length) {
                    $('#show-counter-officer').slideUp();
                    $('.form-group-wrapper').slideDown();
                    $("#select-role > option").each(function () {
                        let optionText = $(this).text().trim().toLowerCase();
                        if (optionText === 'select a role') {
                            $("#select-role > option").removeAttr('selected');
                            $(this).attr("selected", "selected");
                            $('#select-role').removeAttr('style');
                        }
                    });
                }
            }
        }

        checkCreateOfficer($('#create-officer').is(":checked"))
        $('#create-officer').change(function (e) {
            checkCreateOfficer($(this).is(":checked"));
        });
    })
</script>
