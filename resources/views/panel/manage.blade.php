@extends('layouts.app')
@section('content')

@extends('panel.domainsModal', ['accountID' => $account[0]->id])
@extends('panel.dkimModal', ['accountID' => $account[0]->id])
@extends('panel.spfModal', ['accountID' => $account[0]->id])
@extends('panel.externalClientModal', ['server_hostname' => $account[5]->hostname])

<div class="container">
    <br />
    <div class="row">
        <div class="col col-md-10">
            <h3><b>Your account ({{ $account[0]->username }})</b></h3>
            <p>Welcome! Here, you may create email accounts, log in to any addresses you create with one click, etc. If this is your first time, it is suggested that you use the setup wizard to properly configure your DNS settings.</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><h4>Usage details</h4></div>
                    <hr>
                    <!-- Disk usage -->
                    <span style="font-size: 8pt">Disk usage ({{ (round($account[1]["quota"] * 100)/100)}}MB/{{ $account[2]["quota"] }}MB)</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $account[3]['disk'] }}%" aria-valuenow="{{ $account[3]['disk'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- Domain usage -->
                    <div style="padding-top: 10px"></div>
                    <span style="font-size: 8pt">Hosted domains ({{ $account[1]["vdomains"] }}/{{ $account[2]["vdomains"] }})</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $account[3]['domains'] }}%" aria-valuenow="{{ $account[3]['domains'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- Subdomain usage -->
                    <div style="padding-top: 10px"></div>
                    <span style="font-size: 8pt">Subdomains ({{ $account[1]["nsubdomains"] }}/{{ $account[2]["nsubdomains"] }})</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $account[3]['subdomains'] }}%" aria-valuenow="{{ $account[3]['subdomains'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- Forwarder usage -->
                    <div style="padding-top: 10px"></div>
                    <span style="font-size: 8pt">Mail forwarders ({{ $account[1]["nemailf"] }}/{{ $account[2]["nemailf"] }})</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $account[3]['forwarders'] }}%" aria-valuenow="{{ $account[3]['forwarders'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- Email account usage -->
                    <div style="padding-top: 10px"></div>
                    <span style="font-size: 8pt">Hosted email accounts ({{ $account[1]["nemails"] }}/{{ $account[2]["nemails"] }})</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $account[3]['accounts'] }}%" aria-valuenow="{{ $account[3]['accounts'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div style="padding-top: 10px"></div>
                </div>
            </div>
            <br />
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><h4>Check mail</h4></div>
                    <hr>
                    {{ Form::open(array('url' => route('accounts.sso', ['accountID' => $account[0]->id]), "id" => "ssoform", "target" => "_blank"))}}
                    <!--<select class="form-control" name="email" for="ssoform">
                        @forelse($account[4] as $email_account)
                            <option value="{{ $email_account }}">{{ $email_account}}</option>
                        @empty
                            <option value="">N/A</option>
                        @endforelse
                    </select>
                    <br />-->
                    <p>You will be redirected to DirectAdmin's email account page where you can sign on to your email accounts. This will open in a new tab.</p>
                    <button class="btn btn-primary btn-raised btn-block" type="submit">One-click login</button>
                    {{ Form::close() }}
                </div>
            </div>
            <br />
        </div>
        <div class="col col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><h4>Management</h4></div>
                    <hr>
                    <br />
                    <div class="options">
                        <figure>
                            <a href="#" style="color: black">
                                <img src="/img/046-server.png" style="width: 48px; height: 48px" />
                                <figcaption>Setup wizard</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="#" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#domainsModal" style="color: black">
                                <img src="/img/027-world-wide-web.png" style="width: 48px; height: 48px" />
                                <figcaption>Hosted domains</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="#" style="color: black">
                                <img src="/img/018-layers.png" style="width: 48px; height: 48px" />
                                <figcaption>Subdomains</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="#" style="color: black">
                                <img src="/img/002-envelope.png" style="width: 48px; height: 48px" />
                                <figcaption>Email addresses</figcaption>
                            </a>
                        </figure>
                    </div>
                    <br />
                    <div class="options">
                        <figure>
                            <a href="#" data-toggle="modal" data-target="#dkimModal" style="color: black">
                                <img src="/img/011-key.png" style="width: 48px; height: 48px" />
                                <figcaption>DKIM Keys</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="#" data-toggle="modal" data-target="#spfModal" style="color: black">
                                <img src="/img/043-lock.png" style="width: 48px; height: 48px" />
                                <figcaption>SPF Records</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="#" style="color: black">
                                <img src="/img/009-ux-design.png" style="width: 48px; height: 48px" />
                                <figcaption>Vacation messages</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="#" style="color: black">
                                <img src="/img/014-shield.png" style="width: 48px; height: 48px" />
                                <figcaption>Spam filtering</figcaption>
                            </a>
                        </figure>
                    </div>
                </div>
            </div>
            <br />
            <div class="card" style="padding-bottom: 7px">
                <div class="card-body">
                    <div class="card-title"><h4>Mail client</h4></div>
                    <hr>
                    <br />
                    <div class="options">
                        <figure>
                            <a href="https://{{ $account[5]->hostname }}/roundcube" target="_blank" style="color: black">
                                <img src="/img/roundcube.png" style="width: 48px; height: 46px" />
                                <figcaption style="font-size: 10pt">RoundCube</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="https://mail.mxlogin.com" target="_blank" style="color: black">
                                <img src="/img/crossbox.png" style="width: 48px; height: 48px" />
                                <figcaption>CrossBox</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="https://{{ $account[5]->hostname }}/rainloop" target="_blank" style="color: black">
                                <img src="/img/rainloop.png" style="width: 48px; height: 48px" />
                                <figcaption>Rainloop</figcaption>
                            </a>
                        </figure>
                        <figure>
                            <a href="#" data-toggle="modal" data-target="#externalClientModal" style="color: black">
                                <img src="/img/020-devices.png" style="width: 48px; height: 48px" />
                                <figcaption>External client</figcaption>
                            </a>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <p style="font-size: 10px">Credit: Some icons designed by <a target="_blank" href="https://www.flaticon.com/">Flaticon</a>; RoundCube, CrossBox and Rainloop's icons are property of their respective owners.</p>
</div>
@endsection
