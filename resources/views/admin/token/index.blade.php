@extends('admin.layout.master')
@section('title', 'All Generated Tokens')

@section('content')
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Generated Tokens</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        <span class="d-inline-block me-3">
                            Total Tokens:
                            <strong class="text-cyan">
                                {{ $tokens->total() }}
                            </strong>
                        </span>
                        @can('lock tokens')
                            @if(count($tokens) > 0)
                                <a href="{{ route('lock-online-token-generation') }}" id="btn-lock-token-generation"
                                   class="btn btn-primary btn-sm px-3 rounded-pill @if(setting()->get('lock_online_token')) disabled @endif">
                                    <i class="bi bi-lock me-1"></i> {{ setting()->get('lock_online_token') ? 'Locked' : 'Lock Token Generation' }}
                                </a>
                                @if(setting()->get('lock_online_token'))
                                    <span>{{ setting()->get('updated_at') }}</span>
                                @endif
                            @endif
                        @endcan
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Token</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tokens as $key=>$token)
                            <tr>
                                <td>{{ $key + $tokens->firstItem() }}</td>
                                <td>{{ $token->token }}</td>
                                @if($token->is_used == 1 )
                                    <td>
                                        <span class="bg-danger text-white rounded px-1">
                                           Used
                                        </span>
                                    </td>
                                @else
                                    <td>
                                        <span class="bg-success text-white rounded px-1">
                                            Unused
                                        </span>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $tokens->links() }}

            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(function () {
            $('#btn-lock-token-generation').on('click', function (e) {
                let confirm = prompt("Type 'LOCK' to confirm. \nLock the token generation after confirm.");
                if (confirm !== null) {
                    if (confirm !== 'LOCK') {
                        e.preventDefault();
                        e.stopPropagation();
                        return;
                    }
                } else {
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }
            });
        });
    </script>
@endsection
