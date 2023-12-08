@extends('admin.layout.master')
@section('title', 'Import Voters')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Import Voter Data</h3>
            <div class="row">
                <div class="col-md-12">

                    @include('common.alert-message')

                    <form action="{{ route('store-imported-voters') }}" method="post"
                          class="import-voters-data p-4 is-drop-shadow bg-white rounded" enctype="multipart/form-data">
                        @csrf
                        @method("POST")

                        <div class="form-group row">
                            <div class="form-group col-md-6 mb-3 mb-md-0">
                                <label for="upload-file" class="label text-center p-4 d-block border rounded">
                                    <i class="bi bi-cloud-upload display-5"></i>
                                    <span class="title text-muted fw-normal">
                                        <var>
                                            <strong>Browse</strong> file (.xls, .csv)
                                        </var>
                                    </span>
                                    <input type="file" name="excelfile" class="form-control  d-none" id="upload-file"
                                           accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                </label>
                                <a href="{{ asset('assets/file/import_voter_data_demo.xlsx') }}" download>
                                    Download Demo File
                                </a>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="upload-zip-file" class="label text-center p-4 d-block border rounded">
                                    <i class="bi bi-file-earmark-arrow-up display-5"></i>
                                    <span class="title text-muted fw-normal">
                                        <var>
                                            <strong>Browse</strong> file (.zip)
                                        </var>
                                    </span>
                                    <input type="file" name="zipfile" class="form-control candidate-img-file d-none"
                                           id="upload-zip-file"
                                           accept="zip, application/octet-stream, application/zip, application/x-zip, application/x-zip-compressed"/>
                                </label>
                                <a href="{{ asset('assets/file/import_voter_image_data.zip') }}" download>
                                    Download Demo File
                                </a>
                            </div>
                        </div>
                        <button type="submit"
                                class="btn btn-import-data btn-primary text-light px-4 rounded disabled mt-3">
                            <i class="bi bi-check2-circle"></i>
                            Submit
                        </button>

                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <small class="d-block" style="line-height: 1.4rem;">
                                    <span class="text-decoration-underline text-warning font-weight-light">
                                        INSTRUCTIONS:
                                    </span>
                                    <br>
                                    1. Please download the demo file and arrange your member/voter data according to
                                    demo CSV template.
                                    <br>
                                    2. Please rename your member/voter picture according to the member/voter ID and
                                    upload as a zip file.
                                    <br>
                                    3. For better understand please download both CSV and image demo zip file and check.
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(function () {
            let files = {};

            function checkObjectKey() {
                if (Object.keys(files).length > 0) {
                    $('.btn-import-data').removeClass('disabled');
                } else {
                    $('.btn-import-data').addClass('disabled');
                }
            }

            $('#upload-file').on('change', function (e) {
                files[e.target.files[0].name] = e.target.files[0].name;
                checkObjectKey();
            });
            $('#upload-zip-file').on('change', function (e) {
                files[e.target.files[0].name] = e.target.files[0].name;
                checkObjectKey();
            });
        });
    </script>
@endsection
