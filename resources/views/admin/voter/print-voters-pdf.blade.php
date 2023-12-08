<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png"/>
    <title>Printable Voter List</title>
    <style>
        .page-break {
            page-break-after: always !important;
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
            <p style="margin-bottom: 60px;">Printable Voter List</p>
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
    <tbody>
    @php($count = 0)
    @foreach($voters as $key => $voter)
        @php($count += 1)
        <tr style="background-color: #cfe2ff;">
            <th style="padding: 6px; text-align: left; text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
                #ID
            </th>
            <th style="padding: 6px; text-align: left; text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
                Name
            </th>
            <th style="padding: 6px;  text-align: left; text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
                MEMBER ID
            </th>
            <th style="padding: 6px;  text-align: left; text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">
                Category
            </th>
            <th style="padding: 6px;  text-align: left; text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 150px">
                Email
            </th>
            <th style="padding: 6px; text-align: left; text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 150px">
                Phone
            </th>
            <th style="padding: 6px; text-align: left; text-transform: uppercase;font-size: 12px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 150px">
                Image
            </th>
        </tr>
        <tr>
            <td style="padding: 20px 4px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                {{ $voter->id }}</td>
            <td style="padding: 20px 4px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->name }}</td>
            <td style="padding: 20px 4px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->member_id }}</td>
            <td style="padding: 20px 4px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->category }}</td>
            <td style="padding: 20px 4px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->email_address }} </td>
            <td style="padding: 20px 4px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                {{ $voter->contact_number }} </td>
            <td style="padding: 20px 4px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                <img src="{{ get_uploaded_file_url($voter->image, 'public') }}" alt="photo"
                     style="height: 100px;"/></td>
        </tr>
        @if($count == 4)
            <tr class="page-break"></tr>
            @php($count = 0)
        @endif
    @endforeach
    </tbody>
</table>

</body>

</html>
