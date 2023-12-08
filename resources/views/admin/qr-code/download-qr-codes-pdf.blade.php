<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qr Code List</title>
    <style type="text/css">
        html,
        body {
            margin: 0 auto;
            padding: 0;
        }

        @if(setting()->get('paper_size') == 'custom')
        .page-wrapper {
            width: {{ setting()->get('width') * 72 . 'pt' }};
            height: {{ setting()->get('height') * 72 . 'pt' }};
        }
        @endif
    </style>
</head>
<body>
<div class="page-wrapper">
    @foreach($qrCodes as $qrCode)
        <table class="table table-sm align-middle" width='100%'>
            <tbody>
            <tr>
                @if(setting()->get('position') == 'top-left')
                    <td style=" height: 50px;">
                    <span style="float: left;">
                        {!! get_qr_code_or_barcode($qrCode->code) !!}
                    </span>
                    </td>
                    <td style=" height: 50px;"></td>
                @endif
                @if(setting()->get('position') == 'top-right')
                    <td style=" height: 50px;"></td>
                    <td style=" height: 50px;">
                    <span style="float: right;">
                        {!! get_qr_code_or_barcode($qrCode->code) !!}
                    </span>
                    </td>
                @endif
            </tr>
            <tr>
                <td style="height:800px;"></td>
                <td></td>
            </tr>
            <tr>
                @if(setting()->get('position') == 'bottom-left')
                    <td style=" height: 50px; text-align:left;">
                    <span style="float: left;">
                        {!! get_qr_code_or_barcode($qrCode->code) !!}
                    </span>
                    </td>
                    <td style=" height: 50px;"></td>
                @endif
                @if(setting()->get('position') == 'bottom-right')
                    <td style=" height: 50px;"></td>
                    <td>
                    <span style="float: right;">
                        {!! get_qr_code_or_barcode($qrCode->code) !!}
                    </span>
                    </td>
                @endif
            </tr>
            </tbody>
        </table>
        <div style="page-break-before:always;">
        </div>
    @endforeach
</div>
</body>

</html>
