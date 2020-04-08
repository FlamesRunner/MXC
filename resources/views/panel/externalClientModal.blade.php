<div class="modal fade" id="externalClientModal" tabindex="-1" role="dialog" aria-labelledby="externalClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="externalClientModalLabel">Check your email from an external client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>To access your email accounts, use the following details:</p>
                <pre style="margin-bottom: -15px">
IMAP server: {{ $server_hostname }}
SMTP server: {{ $server_hostname }}
IMAP ports: 993 (SSL), 143 (plaintext)
SMTP ports: 465 (SSL), 25 (plaintext), 587 (STARTTLS)
POP3 ports: 995 (SSL), 110 (plaintext) 

Username: Your email address
Password: The password to that email address
                </pre>
            </div>
        </div>
    </div>
</div>
