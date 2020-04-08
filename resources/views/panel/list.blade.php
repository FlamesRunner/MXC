@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br />
            <h3><b>Your services</b></h3>
            <hr>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <br />
            @forelse($accounts as $account)
                <div class="card">
                    <div class="card-header">{{ $account->username }} on {{ $servers[md5($account->serverID)][0]->hostname }}</div>
                    <div class="card-body">
                        <b>Account details at a glance:</b> <br />
                        Hosted domains: {{ $servers[md5($account->serverID)][1]["vdomains"] }}/{{ $servers[md5($account->serverID)][2]["vdomains"] }}<br />
                        Hosted email accounts: {{ $servers[md5($account->serverID)][1]["nemails"] }}/{{ $servers[md5($account->serverID)][2]["nemails"] }}<br />
                        Disk usage: {{ $servers[md5($account->serverID)][1]["quota"] }}/{{ $servers[md5($account->serverID)][2]["quota"] }} MB (about {{ round(($servers[md5($account->serverID)][1]["quota"] / $servers[md5($account->serverID)][2]["quota"]) * 10000) / 100 }}%)
                    </div>
                    <div class="card-footer"><a style="float: right" href="{{ route('accounts.manage', ['accountID' => $account->id]) }}">Manage</a></div>
                </div>
            @empty
                <div class="card">
                    <div class="card-header">N/A</div>
                    <div class="card-body">No accounts were found :(</div>
                </div>
            @endforelse
            <br />
            <div style="display: flex; align-items: center; justify-content: center">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
