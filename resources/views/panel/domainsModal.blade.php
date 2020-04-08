<div class="modal fade" id="domainsModal" tabindex="-1" role="dialog" aria-labelledby="domainsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="domainsModalLabel">Hosted domains</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{ route('accounts.domains', ['accountID' => $accountID]) }}" style="width: 100%; height: 420px; border: 0; display: block; overflow: hidden"></iframe>
            </div>
        </div>
    </div>
</div>