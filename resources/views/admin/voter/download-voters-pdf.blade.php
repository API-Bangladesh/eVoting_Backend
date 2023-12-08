<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png"/>
    <meta name="misapplication-TileColor" content="#ffffff"/>
    <meta name="theme-color" content="#ffffff"/>
    <title>Download Voter List</title>
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
            <p style="margin-bottom: 60px;">Voter List</p>
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
        <th style="padding: 2px;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
            #ID
        </th>
        <th style="padding: 2px; text-align: left; text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
            Name
        </th>
        <th style="padding: 2px; text-align: left;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
            MEMBER ID
        </th>
        <th style="padding: 2px; text-align: left;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
            Category
        </th>
        <th style="padding: 2px; text-align: left;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 150px">
            Email
        </th>
        <th style="padding: 2px; text-align: left;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 150px">
            Phone
        </th>
        <th style="padding: 2px; text-align: left;text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 150px">
            Image
        </th>
    </tr>
    </thead>
    <tbody>
    <?php $start = request()->get('start'); ?>
    @foreach($voters as $key => $voter)
        <tr>
            <td style="padding: 2px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->id }}</td>
            <td style="padding: 2px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->name }}</td>
            <td style="padding: 2px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->member_id }}</td>
            <td style="padding: 2px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->category }}</td>
            <td style="padding: 2px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->email_address }} </td>
            <td style="padding: 2px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->contact_number }} </td>
            <td style="padding: 2px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                <img src="{{ get_uploaded_file_url($voter->image, 'public') }}" alt="photo"
                     style="width: 40px; max-height: 40px"/>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>

</html>
