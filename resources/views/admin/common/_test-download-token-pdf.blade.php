<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Token</title>
    <style type="text/css">
        html,
        body {
            margin: 0 auto;
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }

        .page-wrapper {
            {{--width: {{ 3.0 * 72 . 'pt' }};--}}
            {{--height: {{ 11.7 * 72 . 'pt' }};--}}
             padding: 10px;
        }

        table {
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em solid #ccc;
            border-bottom: 0;
            border-collapse: collapse;
        }

        table td,
        table th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
            padding: 6px;
        }

        .page-wrapper table th {
            text-align: left;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
<center>
    <div class="page-wrapper">
        <table>
            <tbody>
            <tr>
                <td colspan="2" style="text-align: center; padding: 20px;">
                    <img src="{{ get_uploaded_file_url($offlineToken->image, 'public') }}" height="200"
                         alt="image">
                </td>
            </tr>
            <tr>
                <th>Token No.:</th>
                <th>{{ $offlineToken->token }}</th>
            </tr>
            <tr>
                <th>Name:</th>
                <th>{{ $offlineToken->voter_name }}</th>
            </tr>
            <tr>
                <th>Member ID:</th>
                <th>{{ $offlineToken->member_id }}</th>
            </tr>
            <tr>
                <th>Voter ID:</th>
                <th>{{ $offlineToken->voter_id }}</th>
            </tr>
            <tr>
                <th>Optional:</th>
                <th>{{ $offlineToken->card_no }}</th>
            </tr>
            <tr>
                <th>Counter No.:</th>
                <th>{{ $offlineToken->counter_number }}</th>
            </tr>
            <tr>
                <th>Counter Name:</th>
                <th>{{ $offlineToken->counter_name }}</th>
            </tr>
            <tr>
                <th>Date & Time:</th>
                <th>{{ \Carbon\Carbon::parse($offlineToken->created_at)->format('d M, Y h:i:s') }}</th>
            </tr>
            </tbody>
        </table>
    </div>
</center>
</body>

</html>
