@extends('layouts.app_panel_module')
@section('content')
<style>
    html, body {
        background-color: white;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div style="margin-top: -20px">
    <span id="responseArea"></span>
    <div class="table-responsive" id="tblDomains">
        <table class="table">
            <thead>
                <th>Domain</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @forelse ($domains as $domain)
                    <tr>
                        <td>{{ $domain }}</td>
                        <td><a href="#" onclick="deleteDomain('{{ $domain }}')">Delete domain</a></td>
                    </tr>
                @empty
                    <tr>
                        <td>You do not have any domains in your account. This should not happen. Please contact support.</td>
                        <td>N/A</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <br />
    <center>{{ $domains->links() }}</center>
    <br />
    <div style="position: fixed; bottom: 0; width: 100%">
        {{ Form::open(array('url' => route('accounts.domain.create', ['accountID' => $accountID]), 'id' => 'createForm')) }}
            <div class="input-group">
                <input type="text" name="domain" class="form-control" id="domain" placeholder="New domain..." />
                <div class="input-group-append">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-outline-secondary" id="createBtn" value="Create" />
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>
<script>
    var error_array = {
        "e4": '<div class="alert alert-danger">There was an error adding your domain. Please try again later.</div>',
        "e3": '<div class="alert alert-warning">The domain already exists in the system. It cannot be added at this time.</div>',
        "e2": '<div class="alert alert-warning">The domain entered is invalid.</div>',
        "e1": '<div class="alert alert-warning">Insufficient permissions. This should not normally happen. Please contact support.</div>',
        "e0": '<div class="alert alert-success">Your domain was added successfully. The domain list will refresh shortly.</div><br />',
    };
    $("#createForm").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();
        $("input").attr('disabled', 'disabled');
        $("a").attr('disabled', 'disabled');
        $("a").hide();
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
                    case '-4':
                        $("#responseArea").html(error_array["e4"]);
                        break;
                    case '-3':
                        $("#responseArea").html(error_array["e3"]);
                        break;
                    case '-2':
                        $("#responseArea").html(error_array["e2"]);
                        break;
                    case '-1':
                        $("#responseArea").html(error_array["e1"]);
                        break;
                    case '0':
                        $("#responseArea").html(error_array["e0"]);
                        $("nav").fadeOut(500);
                        $("#tblDomains").fadeOut(500).queue(function() {
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
                    $("#domain").val("");
                    $("input").removeAttr('disabled');
                    $("#responseArea").fadeIn();
                    $("a").removeAttr('disabled');
                    $("#createBtn").removeAttr('disabled');
                    $("a").show();
                }
            }
        });
    });

    function deleteDomain(domain) {
        $("input").attr('disabled', 'disabled');
        $("a").attr('disabled', 'disabled');
        $("a").hide();
        $("#responseArea").fadeOut();
        $.ajax({
            type: "POST",
            url: '{{ route("accounts.domain.delete", ["accountID" => $accountID]) }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { domain: domain },
            success: function(data) {
                switch(data.trim()) {
                    case '-5':
                        $("#responseArea").html('<div class="alert alert-danger">This domain is protected; at least one domain must be present in your account at any time.</div>');
                        break;
                    case '-4':
                        $("#responseArea").html('<div class="alert alert-danger">There was an error removing your domain. Please try again later.</div>');
                        break;
                    case '-3':
                        $("#responseArea").html('<div class="alert alert-warning">The domain does not exist in the system. It cannot be removed at this time.</div>');
                        break;
                    case '-2':
                        $("#responseArea").html('<div class="alert alert-warning">The domain you entered is invalid.</div>');
                        break;
                    case '-1':
                        $("#responseArea").html('<div class="alert alert-warning">Insufficient permissions. This should not normally happen. Please contact support.</div>');
                        break;
                    case '0':
                        $("#responseArea").html('<div class="alert alert-success">Your domain was removed successfully. The domain list will refresh shortly.</div><br />');
                        $("nav").fadeOut(500);
                        $("#tblDomains").fadeOut(500).queue(function() {
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
                    $("a").removeAttr('disabled');
                    $("a").show();
                }
            }
        });
    }
</script>
@endsection
