<div class="modal fade" id="spfModal" tabindex="-1" role="dialog" aria-labelledby="spfModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="spfModalLabel">SPF record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{ route('accounts.domain.spf', ['accountID' => $accountID]) }}" style="width: 100%; height: 270px; border: 0; display: block"></iframe>
            </div>
        </div>
    </div>
</div>
