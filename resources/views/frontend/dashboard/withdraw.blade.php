<div class="modal fade withdraws" id="withdraw" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('transactions.store') }}">
            <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Withdraw</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">

                        <div class="form-group">
                            <label class="form-label" for="">Amount</label>
                            <input type="number" class="form-control" name="withdrawn_amount" value=""
                                id="withdrawn_amount">
                        </div>
                        <input type="hidden" class="current_date" name="date">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                        <em class="glyph-icon icon-close"></em> {{ translate('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-sm btn-success" id="confirmDelete">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
