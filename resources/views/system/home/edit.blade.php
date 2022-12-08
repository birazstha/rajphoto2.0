  <!-- Modal -->
  <div class="modal fade" id="editTrasaction{{ $transaction->id }}" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Transaction</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('transactions.update', $transaction->id) }}" method="post">
                      @csrf
                      <input type="hidden" name="_method" value="PUT">
                      <div class="form-group">


                          <div class="form-group">
                              <label for="" class="form-label">Amount</label>
                              <input type="number" class="form-control" name="amount"
                                  value="{{ $transaction->amount }}">
                          </div>

                          @if (!empty($transaction->bills))
                              <input type="hidden" name="transactionType" value="bill">
                              <input type="hidden" name="billId" value="{{ $transaction->bills->id }}">
                          @endif

                      </div>

                      <div class="modal-footer">
                          <button type="submit" class="btn btn-sm btn-success">
                              <i class="fa fa-recycle"></i> Update
                          </button>

                          <button type="reset" class="btn btn-sm btn-secondary">
                              <i class="fa fa-save"></i> Clear
                          </button>
                      </div>
                  </form>

              </div>

          </div>
      </div>
  </div>
