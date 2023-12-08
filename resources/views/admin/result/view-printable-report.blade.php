<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Printable Voting Result</title>
    <style type="text/css">
        html,
        body {
            margin: 0 auto;
            padding: 0;
            line-height: normal;
        }

        .page-wrapper {
            width: 595pt;
        }

        .table {
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6
        }

        .table tr th, .table tr td {
            border: 1px solid #666666;
            padding: 0.5rem 0.5rem
        }

        .table tr th {
            text-align: left;
        }

        .table caption {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <table style="margin-bottom: 40px;" width='100%'>
        <tbody>
        <tr>
            <td style="text-align: center;">
                <p style="margin-bottom: 0;">
                    <strong>{{ setting()->get('organization_name') }}</strong>
                    <br>
                    Election of {{ setting()->get('election_year') }}
                    <br>
                    Date: {{ \Carbon\Carbon::now()->format('d, M Y h:i:s a') }}
                </p>
            </td>
        </tr>
        </tbody>
    </table>

    <table cellpadding="15" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td style="width: 50%">
                <table class="table" cellpadding="0" cellspacing="0" width='100%'>
                    <caption>Overall Voting Summery</caption>
                    <tbody>
                    <tr>
                        <td>Total Voters</td>
                        <td style="text-align: right;">
                            {{ get_count_total_voters() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Total Vote Casted</td>
                        <td style="text-align: right;">
                            {{ get_count_total_casted_votes() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Total Absent</td>
                        <td style="text-align: right;">
                            {{ get_count_total_absent_voters() }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%">
                &nbsp;
            </td>
        </tr>
        <tr>
            @if(is_enable_online_voting_function())
                <td style="width: 50%">
                    <table class="table" cellpadding="0" cellspacing="0" width='100%'>
                        <caption>Online Voting Summery</caption>
                        <tbody>
                        <tr>
                            <td>Total Voters</td>
                            <td style="text-align: right;">
                                {{ get_count_online_voters() }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total Checked In</td>
                            <td style="text-align: right;">
                                {{ get_count_online_check_in() }}
                            </td>
                        </tr>
                        <tr>
                            <td>Vote Casted</td>
                            <td style="text-align: right;">
                                {{ get_count_online_casted_votes() }}
                            </td>
                        </tr>
                        <tr>
                            <td>Absent</td>
                            <td style="text-align: right;">
                                {{ get_count_online_absent_voters() }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            @endif
            @if(is_enable_offline_voting_function())
                <td style="width: 50%">
                    <table class="table" cellpadding="0" cellspacing="0" width='100%'>
                        <caption>Offline Voting Summery</caption>
                        <tbody>
                        <tr>
                            <td>Total Voters</td>
                            <td style="text-align: right;">
                                {{ get_count_offline_voters() }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total Checked In</td>
                            <td style="text-align: right;">
                                {{ get_count_offline_check_in() }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total Valid Ballots</td>
                            <td style="text-align: right;">
                                {{ get_count_offline_casted_votes() }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total Invalid Ballots / Absent</td>
                            <td style="text-align: right;">
                                {{ get_count_offline_absent_voters() }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            @endif
        </tr>
        <tr>
            <td colspan="2">
                <hr/>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 100%">
                @foreach($ballots as $ballot)
                    <table class="table" style="margin-bottom: 25px;" cellpadding="0" cellspacing="0" width='100%'>
                        <caption>
                            {{ optional($ballot->position)->name }} Voting Summery,
                            Win ({{ $ballot->vote_limit }}) Only
                        </caption>
                        <tbody>
                        @foreach($ballot->ballotItems as $key => $ballotItem)
                            <tr>
                                <td style="width: 25px; text-align: center;">
                                    {{ $key += 1 }}
                                </td>
                                <td style="display: flex; align-items: center;">

                                    <img
                                            src="{{ get_uploaded_file_url(optional($ballotItem->candidate)->icon) }}"
                                            alt="img" class="img-fluid" width="50"
                                            style="margin-right: 20px; border: 1px solid #dddddd; padding: 3px; border-radius: 4px;">
                                    {{ optional($ballotItem->candidate)->name }}
                                </td>
                                <td style="text-align: right;">
                                    {{ optional($ballotItem->candidate)->offline_vote_count ?? 0 }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <p style="float: right;">
                    ----------------------------
                    <br>
                    Signature of CEC
                </p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>

</html>
