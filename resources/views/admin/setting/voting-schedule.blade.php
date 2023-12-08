@extends('admin.layout.master')
@section('title', 'Voting Schedule')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Voting Schedule</h3>

            @include('common.alert-message')

            <div class="row">
                <div class="col-md-12">

                    <form action="{{ route('update-voting-schedule') }}" method="post"
                          class="application-form p-4 is-drop-shadow bg-white rounded">
                        @csrf
                        @method('PUT')

                        <div class="text-lg-end">
                            <div class="row align-items-center form-group mb-3">
                                <label for="election_year" class="col-lg-3 col-form-label">
                                    Election Of The Year:
                                </label>
                                <div class="col flex-grow-1">
                                    <input type="number" class="form-control rounded-pill ps-4" placeholder="YYYY"
                                           name="election_year" id="election_year"
                                           value="{{ old('election_year', $setting->election_year) }}"/>
                                    @error('election_year')
                                    <div class="error text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="voting-date" class="col-lg-3 col-form-label">
                                    Voting Date:
                                </label>
                                <div class="col flex-grow-1 position-relative">
                                    <input type="text" class="form-control rounded-pill date-picker ps-4"
                                           name="voting_schedule_start_date" id="voting-date"
                                           value="{{ old('voting_schedule_start_date', $setting->voting_schedule_start_date) }}"
                                           placeholder="YYYY-MM-DD" autocomplete="off"/>
                                    @error('voting_schedule_start_date')
                                    <div class="error text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center form-group mb-3">
                                <label for="voting-start-time" class="col-lg-3 col-form-label">
                                    Voting Time <br/> <small class="text-primary">(start : End)</small> :
                                </label>
                                <div class="col flex-grow-1 position-relative">
                                    <input type="text" class="form-control rounded-pill time-picker ps-4"
                                           name="voting_schedule_start_time" id="voting-start-time" placeholder="00:00"
                                           value="{{ old('voting_schedule_start_time', $setting->voting_schedule_start_time) }}"/>
                                </div>
                                <div class="col flex-grow-1 position-relative">
                                    <input type="text" class="form-control rounded-pill time-picker ps-4"
                                           name="voting_schedule_end_time" id="voting-end-time" placeholder="00:00"
                                           value="{{ old('voting_schedule_end_time', $setting->voting_schedule_end_time) }}"/>
                                </div>
                            </div>
                            {{--                            <div class="row align-items-center form-group mb-3">--}}
                            {{--                                <label for="remaining-date-time" class="col-lg-3 col-form-label">Remaining Date &--}}
                            {{--                                    Hours:</label>--}}
                            {{--                                <div class="col flex-grow-1">--}}
                            {{--                                    <input type="text" readonly--}}
                            {{--                                           value="{{ \Carbon\Carbon::parse($setting->voting_schedule_start_date)->diffForHumans() }}"--}}
                            {{--                                           class="form-control rounded-pill ps-4" id="remaining-date-time"/>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            @if(is_enable_online_voting_function())
                                <div class="row align-items-center form-group mb-3">
                                    <label for="application_subscription_start_date" class="col-lg-3 col-form-label">
                                        Online Vote Application <br/>
                                        <small class="text-primary">(start : End)</small> :
                                    </label>
                                    <div class="col flex-grow-1 position-relative">
                                        <input type="text" name="application_subscription_start_date"
                                               id="application_subscription_start_date"
                                               class="form-control rounded-pill date-picker ps-4"
                                               placeholder="MM-DD-YYYY"
                                               value="{{ old('application_subscription_start_date', $setting->application_subscription_start_date) }}"/>
                                    </div>
                                    <div class="col flex-grow-1 position-relative">
                                        <input type="text" name="application_subscription_end_date"
                                               class="form-control rounded-pill date-picker ps-4"
                                               placeholder="MM-DD-YYYY"
                                               value="{{ old('application_subscription_end_date', $setting->application_subscription_end_date) }}"/>
                                    </div>
                                </div>
                            @endif
                            @if(is_enable_offline_voting_function())
                                <div class="row align-items-center form-group mb-3">
                                    <label for="officer_secret_code" class="col-lg-3 col-form-label">
                                        Officer Secret Code:
                                    </label>
                                    <div class="col flex-grow-1">
                                        <input type="number" class="form-control rounded-pill ps-4"
                                               name="officer_secret_code"
                                               id="officer_secret_code"
                                               value="{{ old('officer_secret_code', $setting->officer_secret_code) }}"/>
                                        @error('officer_secret_code')
                                        <div class="error text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="offset-lg-3">
                            <button type="submit" class="btn btn-info text-light px-4 rounded-pill">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(function () {
            let dateObj = {};

            function remainingDateTime({date = undefined, time = undefined}) {
                if (date !== undefined && date !== '' && time !== undefined && time !== '') {
                    let remaining;
                    let selectedDate = date;
                    let selectedTime = moment(time.toString(), 'HH:mm').format('HH:mm');

                    // let isToday = moment(moment(selectedDate, 'DD-MM-YYYY')).isSame(moment(moment(), 'DD-MM-YYYY'), 'day');
                    // if (isToday === true) {
                    //     let isBeforeTime = moment(moment(selectedDate).format()).isSameOrBefore(moment().format());
                    //     isBeforeTime ? remaining = 'Time is not valid' : remaining = moment().preciseDiff(selectedDate, moment().format())
                    // } else {
                    //     remaining = moment(moment().format('YYYY-MM-DD hh:mm')).preciseDiff(`${date} ${selectedTime}`);
                    // }

                    remaining = moment(moment().format('YYYY-MM-DD hh:mm')).preciseDiff(`${date} ${selectedTime}`);
                    $('#remaining-date-time').val(remaining);
                }
            }

            dateObj['date'] = $('#voting-date').val();
            dateObj['time'] = $('#voting-start-time').val();
            remainingDateTime(dateObj);

            $('#voting-date').on('change', function (e) {
                let date = $(this).val();
                if (date) {
                    dateObj['date'] = date;
                    remainingDateTime(dateObj);
                }
            });

            $('#voting-start-time').on('dp.change', function (e) {
                if (e.date._d) {
                    let time = moment(e.date._d).format('hh:mm A');
                    dateObj['time'] = time;
                    remainingDateTime(dateObj);
                }
            });
        });
    </script>
@endsection
