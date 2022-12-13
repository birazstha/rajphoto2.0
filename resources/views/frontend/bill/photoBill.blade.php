<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('public/css/frontend/bill.css') }}" media="all" />
    <link rel="stylesheet" href="../assests/css/print.css" media="print" />
    <script src="https://kit.fontawesome.com/f0dad6a07d.js" crossorigin="anonymous"></script>
    <title>Bill</title>
</head>

<body>
    <div class="main-container">
        <!-- Header starts -->
        <section class="header">
            <div class="left">
                <div class="header__bar"></div>
                <div class="logo">
                    <div class="logo-img">
                        <img src="{{ asset('public/logoo.png') }}" alt="" />
                    </div>
                    <div class="brand">
                        <div class="brand-name">Raj Photo Pasal</div>
                        <div class="slogan">We capture your precious moments...</div>
                    </div>
                </div>
            </div>
            <div class="bill-id">
                <div class="bill-id__background">
                    <span>Bill ID: {{ $bill->qr_code }}</span>
                </div>
            </div>
        </section>
        <!-- Header ends -->

        <!-- Customer Info starts -->
        <section class="customer-info__container">
            <div class="customer-info">
                <div class="owner-detail">
                    <div class="labels">
                        <p>Name</p>
                        <p>Contact</p>
                        <p>Order Date</p>
                        <p>Delivery Date</p>
                        <p>Payment Method</p>
                        <p>Billed By</p>
                    </div>
                    <div class="details">
                        <p>: {{ $bill->customers->name }}</p>
                        <p>: {{ $bill->customers->phone_number }}</p>
                        <p>: {{ $bill->ordered_date }}</p>
                        <p>: {{ $bill->delivery_date }}</p>
                        <p>: {{ $transaction->payment_gateway ? 'Online Payment' : 'Cash' }} </p>
                        <p>: {{ $bill->users->name }}</p>
                    </div>
                </div>
                <div class="qr-code">
                    {!! QrCode::size(100)->generate($bill->qr_code) !!}
                </div>
            </div>
        </section>
        <!-- Customer info ends -->

        <!-- Bill Detail Starts -->
        <section class="bill-container">
            <div class="table-container">
                <table class="room-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Particular</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>{{ $bill->billOrders[0]->orders->name }}</td>
                            <td>{{ $bill->billOrders[0]->sizes->name }}</td>
                            <td>{{ $bill->billOrders[0]->quantity }}</td>
                            <td>रु{{ $bill->billOrders[0]->rate }}/-</td>

                            <td>रु{{ $bill->billOrders[0]->total }}/-</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            @if (isset($bill->billOrders[1]))
                                <td>{{ $bill->billOrders[1]->orders->name }}</td>
                                <td>{{ $bill->billOrders[1]->sizes->name }}</td>
                                <td>{{ $bill->billOrders[1]->quantity }}</td>
                                <td>रु{{ $bill->billOrders[1]->rate }}/-</td>

                                <td>रु{{ $bill->billOrders[1]->total }}/-</td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>-</td>
                            @endif
                        </tr>

                        <tr>
                            <td>3.</td>
                            @if (isset($bill->billOrders[2]))
                                <td>{{ $bill->billOrders[2]->orders->name }}</td>
                                <td>{{ $bill->billOrders[2]->sizes->name }}</td>
                                <td>{{ $bill->billOrders[2]->quantity }}</td>
                                <td>रु{{ $bill->billOrders[2]->rate }}/-</td>

                                <td>रु{{ $bill->billOrders[2]->total }}/-</td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>-</td>
                            @endif
                        </tr>

                        <tr>
                            <td>4.</td>
                            @if (isset($bill->billOrders[3]))
                                <td>{{ $bill->billOrders[3]->orders->name }}</td>
                                <td>{{ $bill->billOrders[3]->sizes->name }}</td>
                                <td>{{ $bill->billOrders[3]->quantity }}</td>
                                <td>रु{{ $bill->billOrders[3]->rate }}/-</td>

                                <td>रु{{ $bill->billOrders[3]->total }}/-</td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>-</td>
                            @endif
                        </tr>


                    </tbody>
                </table>
            </div>
        </section>
        <!-- Bill Detail Ends -->

        <!-- Net total starts -->
        <div class="calculation">
            <div class="grand-detail">
                <p>Grand Total</p>
                <p>Advance Amount</p>
                <p>Due Amount</p>
            </div>
            <div>
                <p>: रु{{ $bill->grand_total }}/-</p>
                <p>: {{ $bill->paid_amount === 0 ? 'Unpaid' : 'रु' . $bill->paid_amount . '/-' }}</p>
                <p>: {!! $bill->due_amount === 0 ? 'Paid' : 'रु' . $bill->due_amount . '/-' !!}</p>
                </p>
            </div>
        </div>
        <!-- Net total End -->

        <div class="service-container">
            <h4>
                <ul>
                    Our Services
                </ul>
            </h4>
            <ul>
                <ol>
                    <li>Photography and Videography service in Wedding, Mehendi, Baby Shower etc.</li>
                    <li>Urgent Photo and Frames can be printed in 5 mins.</li>
                    <li>Color Print, Lamination, Photocopy.</li>
                    <li>Wedding Malas, Cup Prints.</li>
                </ol>
            </ul>
        </div>

        <div class="remember-us">
            <p>"Loosing your old photos is equal to destroying your history"</p>
        </div>

        <footer>
            <div class="contact">
                <i class="fas fa-phone-alt"></i>
                <p>9844044750</p>
            </div>
            <div class="contact">
                <i class="fas fa-map-marker"></i>
                <p>Tikathali, Lalitpur</p>
            </div>
            <div class="contact">
                <i class="far fa-envelope"></i>
                <p>rajphotopasal@gmail.com</p>
            </div>
            <div class="contact">
                <i class="fas fa-globe"></i>
                <p>www.rajphotopasal.com</p>
            </div>
        </footer>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    /*  $(document).ready(function() {
        window.print();
    }) */
</script>

</html>
