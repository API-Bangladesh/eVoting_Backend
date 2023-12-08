<!DOCTYPE html>

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png"/>
    <meta name="misapplication-TileColor" content="#ffffff"/>
    <meta name="theme-color" content="#ffffff"/>
    <title>Application Submission List</title>
    <style>
        .page-break {
            /*page-break-after: always !important;*/
        }
    </style>
</head>

<body>
<table style="width: 100%; text-align: left;" cellpadding="0" cellspacing="0" class="page-break">
    <tbody>
    <tr>
        <td style="width: 70%;">
            <p style="margin-bottom: 0; font-size: 26px;">{{ setting()->get('organization_name') }}</p>
            <p style="margin-bottom: 0;">Date: {{ now() }}</p>
            <p style="margin-bottom: 60px;">Application Submission List</p>
        </td>
        <td style="width: 30%; text-align: center;">
            @if(setting()->get('icon') !== Null && setting()->get('logo_type') == 'img-logo')
                <img src="{{ get_uploaded_file_url(setting()->get('icon'), 'public') }}" alt="Logo"
                     class="img-fluid" style="max-height: 50px"/>
            @endif
        </td>
    </tr>
    </tbody>
</table>

<table class="table-striped" style="width: 100%; text-align: left;" cellpadding="0" cellspacing="0">
    <thead style="background-color: #cfe2ff">
    <tr>
        <th style="padding: 10px;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
            Member ID
        </th>
        <th style="padding: 10px;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
            Member Name
        </th>
        <th style="padding: 10px;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
            Email Address
        </th>
        <th style="padding: 10px;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 150px">
            Form Data
        </th>
        <th style="padding: 10px;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 100px">
            Created
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($applications as $application)
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $application->form_data['member_id'] }}</td>
            <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $application->form_data['name'] }}</td>
            <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $application->form_data['email'] }}</td>
            <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                <div style="width: 250px;">
                    @foreach($application->form_data as $key => $value)
                        <kbd class="d-inline-block mb-1">
                            {{ \Illuminate\Support\Str::title($key) }} : {{ $value }}</kbd>
                    @endforeach
                </div>
            </td>
            <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ \Carbon\Carbon::parse($application->created_at)->format('d M, Y') }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>

</html>
