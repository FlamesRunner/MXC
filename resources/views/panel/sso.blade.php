<!DOCTYPE html>
<html>
	<head>
		<title>Please wait</title>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	</head>
	<body>
		<form action="https://{{ $data[3] }}:2222/CMD_LOGIN" method="POST" id="ssoform">
			<input name="referer" value="/user/email/accounts" type="hidden" />
			<input name="FAIL_URL" value="{{ url('/misc/closetab') }}" type="hidden" />
			<input name="LOGOUT_URL" value="{{ url('/misc/closetab') }}" type="hidden" />
			<input name="username" value="{{ $data[0] }}" type="hidden" />
			<input name="password" value="{{ $data[1] }}" type="hidden" />
		</form>
	</body>
	<script type="text/javascript">
		(function() {
			document.getElementById("ssoform").submit();
		})();
	</script>
</html>