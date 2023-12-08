@extends('admin.layout.master')
@section('title', 'Create Application Form')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Application Form</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="addFieldModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Custom Field</h5>
                                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="#" class="add-field-form modal-body px-5">
                                    <div class="form-group mb-3">
                                        <label for="add-input-label" class="mb-1">
                                            Input Label <span class="text-danger">*</span>
                                        </label>
                                        <input id="add-input-label" type="text" class="form-control rounded-pill ps-4"
                                               required="required" name="add-input-label"
                                               placeholder="Enter Label Name"/>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="add-input-placeholder" class="mb-1">
                                            Input Placeholder
                                        </label>
                                        <input id="add-input-placeholder" type="text"
                                               class="form-control rounded-pill ps-4"
                                               name="add-input-placeholder" placeholder="Enter Placeholder Name"/>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="add-input-type" class="mb-1">
                                            Input Type <span class="text-danger">*</span>
                                        </label>
                                        <select id="add-input-type" class="form-select form-control rounded-pill ps-4"
                                                required="required">
                                            <option selected disabled>Select Input Type</option>
                                            <option value="text">Text</option>
                                            <option value="email">Email</option>
                                            <option value="number">Number</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" checked
                                                   id="is-field-required"/>
                                            <label class="form-check-label" for="is-field-required">
                                                Is This Field Required?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <button type="submit"
                                                class="btn btn-primary rounded-pill px-4 btn-sm">Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('store-application-form') }}" method="POST"
                          class="application-form p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        @method('POST')

                        <div
                                class="create-new-field d-flex align-items-center justify-content-end gap-2 mb-4 border-bottom pb-3">
                            <button type="button" class="btn btn-add-field btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addFieldModal">
                                <i class="bi bi-plus-lg me-1"></i> Add New Field
                            </button>
                            <a href="{{ setting()->get('online_application_form_url') }}"
                               class="btn btn-add-field btn-info btn-sm" target="_blank">
                                <i class="bi bi-view-list me-1"></i> View Demo
                            </a>
                        </div>
                        <div id="form-body" class="text-lg-end">
                            @forelse($formFields as $key => $formField)
                                @if($key <= 3)
                                    {{--Unsortable fields--}}
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="#" class="col-lg-3 col-form-label">
                                            {{ $formField['label'] }}
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="{{ $formField['type'] }}"
                                                   name="{{ $formField['name'] }}"
                                                   class="form-control rounded-pill ps-4 disabled" readonly
                                                   is-required="{{ $formField['required'] ?? '' }}"
                                                   placeholder="{{ $formField['placeholder'] }}"/>
                                        </div>
                                    </div>
                                @else

                                    @if($key == 4)
                                        {{--Sortable fields--}}
                                        <div class="sortable"> @endif
                                            <div class="row align-items-center form-group  mb-3">
                                                <label for="#" class="col-lg-3 col-form-label">
                                                    {{ $formField['label'] }}
                                                </label>
                                                <div class="col flex-grow-1">
                                                    <input type="{{ $formField['type'] }}"
                                                           name="{{ $formField['name'] }}"
                                                           class="form-control rounded-pill ps-4 disabled" readonly
                                                           is-required="{{  $formField['required'] }} "
                                                           placeholder="{{ $formField['placeholder'] }}"/>
                                                </div>
                                                <div
                                                        class="col flex-grow-0 d-flex align-items-center form-group-action">
                                                    <button type="button" class="btn btn-sm btn-remove btn-danger">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-handle">
                                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                    d="M20 16.25L28.705 21.3275L24.9887 22.39L27.645 26.9913L25.48 28.2413L22.8238 23.6413L20.045 26.3288L20 16.25ZM17.5 7.5H20V10H26.25C26.5815 10 26.8995 10.1317 27.1339 10.3661C27.3683 10.6005 27.5 10.9185 27.5 11.25V16.25H25V12.5H12.5V25H17.5V27.5H11.25C10.9185 27.5 10.6005 27.3683 10.3661 27.1339C10.1317 26.8995 10 26.5815 10 26.25V20H7.5V17.5H10V11.25C10 10.9185 10.1317 10.6005 10.3661 10.3661C10.6005 10.1317 10.9185 10 11.25 10H17.5V7.5ZM5 17.5V20H2.5V17.5H5ZM5 12.5V15H2.5V12.5H5ZM5 7.5V10H2.5V7.5H5ZM5 2.5V5H2.5V2.5H5ZM10 2.5V5H7.5V2.5H10ZM15 2.5V5H12.5V2.5H15ZM20 2.5V5H17.5V2.5H20Z"
                                                                    fill="black"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            @if($key == (count($formFields) - 1))
                                        </div>
                                    @endif
                                @endif

                            @empty
                                {{--Default fields--}}
                                <div class="row align-items-center form-group mb-3">
                                    <label for="#" class="col-lg-3 col-form-label">Full Name:</label>
                                    <div class="col flex-grow-1">
                                        <input type="text" name="fullName"
                                               class="form-control rounded-pill ps-4 disabled" readonly
                                               is-required="true"
                                               placeholder="Full Name"/>
                                    </div>
                                </div>
                                <div class="row align-items-center form-group mb-3">
                                    <label for="#" class="col-lg-3 col-form-label">Email Address:</label>
                                    <div class="col flex-grow-1">
                                        <input type="email" name="email" class="form-control rounded-pill ps-4 disabled"
                                               readonly is-required="true"
                                               placeholder="Email Address"/>
                                    </div>
                                </div>
                                <div class="row align-items-center form-group mb-3">
                                    <label for="#" class="col-lg-3 col-form-label">Member ID:</label>
                                    <div class="col flex-grow-1">
                                        <input type="text" name="member_id"
                                               class="form-control rounded-pill ps-4 disabled" readonly
                                               isRequired="true"
                                               placeholder="Member ID"/>
                                    </div>
                                </div>
                                <div class="row align-items-center form-group mb-3">
                                    <label for="#" class="col-lg-3 col-form-label">Phone Number:</label>
                                    <div class="col flex-grow-1">
                                        <input type="number" name="number"
                                               class="form-control rounded-pill ps-4 disabled" readonly
                                               is-required="true"
                                               placeholder="Phone Number"/>
                                    </div>
                                </div>
                                <div class="sortable">
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="#" class="col-lg-3 col-form-label">
                                            Country (Currently Living):
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" name="country"
                                                   class="form-control rounded-pill ps-4 disabled" readonly
                                                   is-required="true"
                                                   placeholder="Country (Currently Living)"/>
                                        </div>
                                        <div class="col flex-grow-0 d-flex align-items-center form-group-action">
                                            <button type="button" class="btn btn-sm btn-remove btn-danger">
                                                <i class="bi bi-x"></i>
                                            </button>
                                            <button type="button" class="btn btn-handle">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                            d="M20 16.25L28.705 21.3275L24.9887 22.39L27.645 26.9913L25.48 28.2413L22.8238 23.6413L20.045 26.3288L20 16.25ZM17.5 7.5H20V10H26.25C26.5815 10 26.8995 10.1317 27.1339 10.3661C27.3683 10.6005 27.5 10.9185 27.5 11.25V16.25H25V12.5H12.5V25H17.5V27.5H11.25C10.9185 27.5 10.6005 27.3683 10.3661 27.1339C10.1317 26.8995 10 26.5815 10 26.25V20H7.5V17.5H10V11.25C10 10.9185 10.1317 10.6005 10.3661 10.3661C10.6005 10.1317 10.9185 10 11.25 10H17.5V7.5ZM5 17.5V20H2.5V17.5H5ZM5 12.5V15H2.5V12.5H5ZM5 7.5V10H2.5V7.5H5ZM5 2.5V5H2.5V2.5H5ZM10 2.5V5H7.5V2.5H10ZM15 2.5V5H12.5V2.5H15ZM20 2.5V5H17.5V2.5H20Z"
                                                            fill="black"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center form-group mb-3">
                                        <label for="#" class="col-lg-3 col-form-label">
                                            Reason For Online Vote:
                                        </label>
                                        <div class="col flex-grow-1">
                                            <input type="text" name="reason"
                                                   class="form-control rounded-pill ps-4 disabled" readonly
                                                   is-required="true"
                                                   placeholder="Reason For Online Vote"/>
                                        </div>
                                        <div class="col flex-grow-0 d-flex align-items-center form-group-action">
                                            <button type="button" class="btn btn-sm btn-remove btn-danger">
                                                <i class="bi bi-x"></i>
                                            </button>
                                            <button type="button" class="btn btn-handle">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                            d="M20 16.25L28.705 21.3275L24.9887 22.39L27.645 26.9913L25.48 28.2413L22.8238 23.6413L20.045 26.3288L20 16.25ZM17.5 7.5H20V10H26.25C26.5815 10 26.8995 10.1317 27.1339 10.3661C27.3683 10.6005 27.5 10.9185 27.5 11.25V16.25H25V12.5H12.5V25H17.5V27.5H11.25C10.9185 27.5 10.6005 27.3683 10.3661 27.1339C10.1317 26.8995 10 26.5815 10 26.25V20H7.5V17.5H10V11.25C10 10.9185 10.1317 10.6005 10.3661 10.3661C10.6005 10.1317 10.9185 10 11.25 10H17.5V7.5ZM5 17.5V20H2.5V17.5H5ZM5 12.5V15H2.5V12.5H5ZM5 7.5V10H2.5V7.5H5ZM5 2.5V5H2.5V2.5H5ZM10 2.5V5H7.5V2.5H10ZM15 2.5V5H12.5V2.5H15ZM20 2.5V5H17.5V2.5H20Z"
                                                            fill="black"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="offset-lg-3">
                            <button type="submit" id="btn-app-form-save"
                                    class="btn btn-info text-light px-4 rounded-pill">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(function () {
            if ($('form.application-form').length) {
                $('form.application-form').on('submit', function (e) {
                    e.stopPropagation();
                    e.preventDefault();

                    let form = $(this);

                    // all value getting form app-form
                    let fieldPair = [];

                    $(this).find('input:not([type="hidden"])').each(function () {
                        let type = $(this).attr('type') || 'type';
                        let label = $(this).closest('.row').find('label').text() || 'label';
                        let name = $(this).attr('name') || 'name';
                        let placeholder = $(this).attr('placeholder') || 'placeholder';
                        let isRequired = $(this).attr('is-required');

                        fieldPair.push({
                            'type': type,
                            'name': name,
                            'placeholder': placeholder,
                            'label': label,
                            'required': isRequired,
                        });
                    });

                    $.ajax({
                        type: 'POST',
                        url: '/store-application-form',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_data': fieldPair
                        },
                        success: function (response) {
                            // Notification
                            if (response.status !== undefined && response.status === true) {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true,
                                    "positionClass": "toast-bottom-right",
                                }
                                toastr.success(response.message);
                            } else {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true,
                                    "positionClass": "toast-bottom-right",
                                }
                                toastr.warning(response.message);
                            }

                            // Redirect execution
                            if (response.redir !== undefined && response.redir.length > 0) {
                                setTimeout(function () {
                                    document.location.href = response.redir;
                                }, response.redirAfter);
                            }
                        }
                    });
                });
            }
        });
    </script>
@endsection
