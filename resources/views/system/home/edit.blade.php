  <!-- Modal -->
  <div class="modal fade" id="editTrasaction{{ $transaction->id }}" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="">
                      <div class="form-group">

                          {{-- {{ $transaction->bills}} --}}


                          @if ($transaction->bills)
                              <label for="" class="form-label">Paid Amount</label>
                              <input type="number" class="form-control" value="{{ $transaction->paid_amount }}">
                          @endif
                          <label for="" class="form-label">Amount</label>
                          <input type="number" class="form-control" value="{{ $transaction->amount }}">
                      </div>
                  </form>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save</button>
              </div>
          </div>
      </div>
  </div>
