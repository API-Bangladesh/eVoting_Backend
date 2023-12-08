<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png"/>
    <meta name="misapplication-TileColor" content="#ffffff"/>
    <meta name="theme-color" content="#ffffff"/>
    <title>Qr Code List With Ballots</title>
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

        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: #c5d7f2;
        !important;
        }
    </style>
</head>

<body>
<div class="page-wrapper">
    @foreach($qrCodes as $qrCode)
        <table id="table" style="width: 100%; margin: auto; background-color: #fff">
            @if(setting()->get('position') == 'top-left')
                <tr class="code-details">
                    <td style="padding: 20px; padding-bottom: 10px; width: 100%; border-bottom: 1px solid #ddd; text-align: left;">
                       <span style="display: inline-block;">
                           {!! get_qr_code_or_barcode($qrCode->code) !!}
                       </span>
                    </td>
                </tr>
            @endif
            @if(setting()->get('position') == 'top-right')
                <tr class="code-details">
                    <td style="padding: 20px; padding-bottom: 10px; width: 100%; border-bottom: 1px solid #ddd; text-align: right;">
                       <span style="display: inline-block;">
                           {!! get_qr_code_or_barcode($qrCode->code) !!}
                       </span>
                    </td>
                </tr>
            @endif
            <tr class="company-details">
                <td style="padding: 20px; padding-bottom: 0px; width: 100%">
                    <table style="max-width: 500px; margin: auto; width: 100%">
                        <tbody>
                        <tr>
                            <td>
                                <h5 style="margin: 0; margin-bottom: 5px; font-size: 18px">
                                    {{ setting()->get('organization_name') }}
                                </h5>
                                <p style="margin: 0">
                                    <small>
                                        {{ setting()->get('address') }}
                                    </small>
                                </p>
                            </td>
                            <td style="text-align: right">
                                <img src="{{ get_uploaded_file_url(setting()->get('icon'), 'public') }}" alt="icon"
                                     style="max-height: 50px; width: 50px; display: inline-block"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            @foreach($ballots as $ballot)
                <tr class="ballots-widget">
                    <td style="width: 100%; padding: 20px; padding-bottom: 0px">
                        <p style="border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 15px">Select
                            Any ({{ $ballot->vote_limit }}) For
                            <strong>{{ optional($ballot->position)->name }}</strong>
                        </p>
                        <table class="table-striped" style="width: 100%; text-align: left; background-color: #cfe2ff"
                               cellpadding="0" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="padding: 10px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">#SL</th>
                                <th style="padding: 10px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1);white-space: nowrap;">
                                    {{ optional($ballot->position)->name }} Candidate
                                </th>
                                <th style="padding: 10px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1)">Image</th>
                                <th style="padding: 10px; border-bottom: 0.05rem solid rgba(0, 0, 0, 1); width: 150px">
                                    Vote
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ballot->ballotItems as $key => $ballotItem)
                                <tr>
                                    <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                                        {{ $key += 1 }}
                                    </td>
                                    <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">{{ optional($ballotItem->candidate)->name }}</td>
                                    <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
                                        <img
                                                src="{{ get_uploaded_file_url(optional($ballotItem->candidate)->icon, 'public') }}"
                                                alt="icon" style="width: 50px; max-height: 50px"/>
                                    </td>
                                    <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1)"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
            @if(setting()->get('position') == 'bottom-left')
                <tr class="code-details">
                    <td style="padding: 20px; padding-bottom: 10px; width: 100%; border-bottom: 1px solid #ddd; text-align: left;">
                    <span style="display: inline-block;">
                        {!! get_qr_code_or_barcode($qrCode->code) !!}
                    </span>
                    </td>
                </tr>
            @endif
            @if(setting()->get('position') == 'bottom-right')
                <tr class="code-details">
                    <td style="padding: 20px; padding-bottom: 10px; width: 100%; border-bottom: 1px solid #ddd; text-align: right;">
                    <span style="display: inline-block;">
                        {!! get_qr_code_or_barcode($qrCode->code) !!}
                    </span>
                    </td>
                </tr>
            @endif
        </table>
        <div style="page-break-before:always;"></div>
    @endforeach
</div>
</body>
</html>
