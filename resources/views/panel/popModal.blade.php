<div class="modal fade" id="popModal" tabindex="-1" role="dialog" aria-labelledby="popModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popModalLabel">Email accounts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{ route('accounts.domain.pop', ['accountID' => $accountID]) }}" style="width: 100%; height: 460px; border: 0; display: block"></iframe>
            </div>
        </div>
    </div>
</div>
