@extends('layouts.app_panel_module')
@section('content')
<style>
    html, body {
        background-color: white;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div style="margin-top: -20px; margin-bottom: -20px">
    <span id="responseArea"></span>
    <div class="table-responsive" id="tblPop">
        <table class="table">
            <thead>
                <th style="max-width: 220px;">Email account</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @forelse ($email_accounts as $email_account)
                    <tr>
                        <td style="max-width: 220px; overflow-x: auto">{{ $email_account }}</td>
                        <td><a href="#" onclick="deleteAccount('{{ $email_account }}')">Delete</a><cl> or </cl><a href="#" onclick="resetPassword('{{ $email_account }}')">reset password</a></td>
                    </tr>
                @empty
                    <tr>
                        <td>You do not have any email accounts in your account.</td>
                        <td>N/A</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <center>{{ $email_accounts->links() }}</center>
    <div style="position: fixed; bottom: 0; width: 100%">
        {{ Form::open(array('url' => route('accounts.domain.pop.new', ['accountID' => $accountID]), 'id' => 'createForm')) }}
            <select form="createForm" name="domain" id="domain" class="form-control">
                @forelse ($domains as $domain)
                    <option value="{{ $domain }}">{{ $domain }}</option>
                @empty
                    <option>No domains available</option>
                @endforelse
            </select>
            <br />
            <div class="input-group">
                <input type="text" name="address" class="form-control" id="address" placeholder="Address" />
                <div class="input-group-append">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-outline-secondary" id="createBtn" value="Create" />
                </div>
            </div>
        {{ Form::close() }}
        <p style="font-size: 10px; margin: 0">Creating <span id="addr_preview"></span>@<span id='dom_preview'>{{ $domains[0] }}</span></p>
    </div>
</div>

<script>
    $("#createForm").change(function() {
        $("#addr_preview").html($("#address").val());
        $("#dom_preview").html($("#domain").val());
    });
    $("#address").on("input", function() {
        $("#addr_preview").html($("#address").val());
        $("#dom_preview").html($("#domain").val());
    });
    $("#createForm").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();
        $("input").attr('disabled', 'disabled');
        $("a").attr('disabled', 'disabled');
        $("select").attr('disabled', 'disabled');
        $("a").hide();
        $("cl").hide();
        $("#responseArea").fadeOut();
        var url = form.attr('action');
        $("#createBtn").attr('disabled', 'disabled');
        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function(data) {
                switch(data.trim()) {
                    case '-5':
                        $("#responseArea").html('<div class="alert alert-danger">System error. Please try again later.</div>');
                        break;
                    case '-4':
                        $("#responseArea").html('<div class="alert alert-danger">The email address specified is invalid.</div>');
                        break;
                    case '-3':
                        $("#responseArea").html('<div class="alert alert-warning">The email address already exists.</div>');
                        break;
                    case '-2':
                        $("#responseArea").html('<div class="alert alert-warning">The domain selected is invalid.</div>');
                        break;
                    case '-1':
                        $("#responseArea").html('<div class="alert alert-warning">Insufficient permissions. This should not normally happen. Please contact support.</div>');
                        break;
                    default:
                        $("#responseArea").html('<div class="alert alert-success">Your email address was added successfully. The temporary password is as follows: <b>' + data.trim() + '</b>.</div><p>Click <a href="#" onclick="location.reload()">here</a> once you\'ve copied the password down to return to the listing.</p>');
                        $("nav").fadeOut(500);
                        $("#tblPop").fadeOut(500).queue(function() {
                            $("#responseArea").fadeIn();
                            $(this).dequeue();
                        });
                        break;
                }
                if (!isNaN(data.trim())) {
                    $("input").removeAttr('disabled');
                    $("select").removeAttr('disabled');
                    $("#responseArea").fadeIn();
                    $("cl").show();
                    $("a").removeAttr('disabled');
                    $("#createBtn").removeAttr('disabled');
                    $("a").show();
                }
            }
        });
    });

    function resetPassword(address) {
        $("input").attr('disabled', 'disabled');
        $("a").attr('disabled', 'disabled');
        $("a").hide();
        $("cl").hide();
        $("#responseArea").fadeOut();
        $.ajax({
            type: "POST",
            url: '{{ route("accounts.domain.pop.reset", ["accountID" => $accountID]) }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { address: address },
            success: function(data) {
                switch(data.trim()) {
                    case '-5':
                        $("#responseArea").html('<div class="alert alert-danger">Could not reset password for invalid email address.</div>');
                        break;
                    case '-4':
                        $("#responseArea").html('<div class="alert alert-danger">Could not reset password for non-existent email account.</div>');
                        break;
                    case '-3':
                        $("#responseArea").html('<div class="alert alert-warning">The domain specified does not exist.</div>');
                        break;
                    case '-2':
                        $("#responseArea").html('<div class="alert alert-warning">The domain you entered is invalid.</div>');
                        break;
                    case '-1':
                        $("#responseArea").html('<div class="alert alert-warning">Insufficient permissions. This should not normally happen. Please contact support.</div>');
                        break;
                    default:
                        $("#responseArea").html('<div class="alert alert-success">Your temporary password is as follows: <b>' + data.trim() + '</b></div><p>Click <a href="#" onclick="location.reload()">here</a> once you\'ve copied the password down to return to the listing.</p>');
                        $("nav").fadeOut(500);
                        $("#tblPop").fadeOut(500).queue(function() {
                            $("#responseArea").fadeIn();
                            $(this).dequeue();
                        });
                        break;
                }
                if (!isNaN(data.trim())) {
                    $("input").removeAttr('disabled');
                    $("#responseArea").fadeIn();
                    $("cl").show();
                    $("a").removeAttr('disabled');
                    $("a").show();
                }
            }
        });
    }

    function deleteAccount(address) {
        $("input").attr('disabled', 'disabled');
        $("a").attr('disabled', 'disabled');
        $("a").hide();
        $("cl").hide();
        $("#responseArea").fadeOut();
        $.ajax({
            type: "POST",
            url: '{{ route("accounts.domain.pop.delete", ["accountID" => $accountID]) }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { address: address },
            success: function(data) {
                switch(data.trim()) {
                    case '-5':
                        $("#responseArea").html('<div class="alert alert-danger">Could not remove invalid email address.</div>');
                        break;
                    case '-4':
                        $("#responseArea").html('<div class="alert alert-danger">Could not remove non-existent email account.</div>');
                        break;
                    case '-3':
                        $("#responseArea").html('<div class="alert alert-warning">The domain specified does not exist.</div>');
                        break;
                    case '-2':
                        $("#responseArea").html('<div class="alert alert-warning">The domain you entered is invalid.</div>');
                        break;
                    case '-1':
                        $("#responseArea").html('<div class="alert alert-warning">Insufficient permissions. This should not normally happen. Please contact support.</div>');
                        break;
                    case '0':
                        $("#responseArea").html('<div class="alert alert-success">The address was removed successfully. Please allow a moment for the list to refresh.</div><br />');
                        $("nav").fadeOut(500);
                        $("#tblPop").fadeOut(500).queue(function() {
                            $("#responseArea").fadeIn();
                            $(this).dequeue();
                        }).delay(2000).queue(function() {
                            location.reload(true);
                            $(this).dequeue();
                        });
                        break;
                    default:
                        $("#responseArea").html('<div class="alert alert-warning">' + data + '</div>');
                        break;
                }
                if (data.trim() != '0') {
                    $("input").removeAttr('disabled');
                    $("#responseArea").fadeIn();
                    $("cl").show();
                    $("a").removeAttr('disabled');
                    $("a").show();
                }
            }
        });
    }
</script>
@endsection
