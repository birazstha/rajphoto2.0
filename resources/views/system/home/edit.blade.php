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
                          @if (isset($transaction->income_id) || isset($transaction->expense_id))

                              {{-- Transaction Type --}}
                              <div class="mb-3">
                                  <label for="" class="form-label">Transaction Type</label>
                                  <select name="transaction_type" id="transaction-type"
                                      class="form-control transaction-type" required>
                                      <option value="">Select Transaction Type</option>
                                      <option value="income" {{ isset($transaction->income_id) ? 'selected' : '' }}>
                                          Income
                                      </option>
                                      <option value="expense" {{ isset($transaction->expense_id) ? 'selected' : '' }}>
                                          Expense
                                      </option>
                                  </select>
                              </div>

                              {{-- Transaction Title --}}
                              <div class="mb-3">
                                  <label for="" class="form-label">Transaction Type</label>
                                  @if (isset($transaction->income_id))
                                      <select name="transaction_title_id" id="transaction_title"
                                          class="form-control transaction_title" required>
                                          <option value="">Select Income Title</option>
                                          @foreach ($incomes as $income)
                                              <option value="{{ $income->id }}"
                                                  {{ $income->id === $transaction->income_id ? 'selected' : '' }}>
                                                  {{ $income->name }}</option>
                                          @endforeach
                                      </select>
                                  @elseif(isset($transaction->expense_id))
                                      <select name="transaction_title_id" id="transaction_title"
                                          class="form-control transaction_title" required>
                                          <option value="">Select Expense Title</option>
                                          @foreach ($expenses as $expense)
                                              <option value="{{ $expense->id }}"
                                                  {{ $expense->id === $transaction->expense_id ? 'selected' : '' }}>
                                                  {{ $expense->title }}</option>
                                          @endforeach
                                      </select>
                                  @endif

                              </div>
                          @endif


                          {{-- Amount --}}
                          <div class="mb-3">
                              <label for="" class="form-label">Amount</label>
                              <input type="number" class="form-control" name="amount"
                                  value="{{ $transaction->amount }}">
                          </div>

                          {{-- Bill Id --}}
                          @if (!empty($transaction->bills))
                              <input type="hidden" name="transactionType" value="bill">
                              <input type="hidden" name="billId" value="{{ $transaction->bills->id }}">
                          @endif



                          {{-- Payment Method --}}
                          <div class="mb-3">
                              <label for="" class="form-label">Payment Gateway</label>
                              <select name="" class="form-control payment_method_other" required>
                                  <option value="cash">Cash</option>
                                  <option value="online" {{ $transaction->payment_method ? 'selected' : '' }}>Online
                                  </option>
                              </select>
                          </div>

                          {{-- Payment Gateway --}}

                          <div
                              class="form-group row toggle-payment-other {{ empty($transaction->payment_method) ? ' d-none' : '' }}">
                              <div class="mb-3">
                                  <label for="" class="form-label col-sm-2">Amount</label>
                                  <div class="col-sm-10" style="display: flex; flex-direction:row; align-item:center">
                                      @foreach ($payments as $payment)
                                          <div class="form-check col-sm-5">
                                              <input class="form-check-input" name="payment_method" type="radio"
                                                  id="flexRadioDefault1" value="{{ $payment->id }}"
                                                  {{ $payment->id === $transaction->payment_method ? 'checked' : '' }}>
                                              <label class="form-check-label" for="flexRadioDefault1">
                                                  <img src="{{ asset('public/uploads/payment-method/' . $payment->image) }}"
                                                      height="50px" alt="">
                                              </label>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>


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
