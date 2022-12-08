  <!-- Modal -->
  <div class="modal fade" id="deleteTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">


                  Are you sure you want to delete?

              </div>
              <div class="modal-footer">

                  <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-sm btn-danger">
                          <i class="fa fa-trash"></i> Delete
                      </button>
                  </form>

                  <button type="reset" class="btn btn-sm btn-secondary">
                      <i class="fa fa-save"></i> Clear
                  </button>
              </div>

          </div>
      </div>
  </div>
