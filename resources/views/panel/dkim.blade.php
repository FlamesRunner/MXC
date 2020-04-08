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
    <select name="domain" id="domain" class="form-control">
        <option value="null">(select a domain from the dropdown)</option>
        @foreach ($domains as $domain)
            <option value="{{ $domain }}">{{ $domain }}</option>
        @endforeach
    </select>
    <div id="responseArea" style="display: none">
        <br />
        <div class="alert alert-info">
            <p><b>DNS record type:</b> TXT</p>
            <p><b>Selector:</b> x._domainkey</p>
            <p><b>Contents:</b> <pre id="dkimContents"></pre></p>
        </div>
    </div>
    <div id="errorArea" style="display: none">
        <br />
        <div class="alert alert-danger">The DKIM key could not be retrieved for your selection. Please try again later.</div>
    </div>
</div>
<script>
    $("#domain").change(function() {
        var domain = $("#domain").val();
        if (domain == "null") {
            $("#responseArea").fadeOut();
            $("#errorArea").fadeOut();
        } else {
            $("#responseArea").fadeOut();
            $("#errorArea").fadeOut();
            $("select").attr('disabled', 'disabled');
            var url = '{{ route("accounts.domain.dkim.get", ["accountID" => $accountID]) }}';
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { domain: domain },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.status == "success") {
                        $("#dkimContents").html(response.key);
                        $("#responseArea").fadeIn();
                    } else {
                        $("#errorArea").fadeIn();
                    }
                    $("select").removeAttr('disabled');
                }
            });
        }
    });
</script>
@endsection
