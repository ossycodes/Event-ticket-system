@extends('layouts.adminLayout.admin_design')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Receipt</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Receipt</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fa fa-info"></i> Note:</h5>
                Click the print button at the bottom of the Receipt to print your receipt.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fa fa-globe"></i> Cinemaxii, Inc.
                    <small class="float-right">Date: {{ today()->toFormattedDateString() }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Cinemaxii, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@Cinemaxii.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ Auth::user()->name }}</strong><br>
                    {{ Auth::user()->profile->location ?? 'Not provided' }}<br>
                    {{ Auth::user()->profile->phonenumber ?? 'Not provided' }}<br>
                    Email: {{ Auth::user()->email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Reference Id {{  $receipt->reference_id }}</b><br>
                  <br>
                  <b>Transaction ID:</b> {{  $receipt->tran_id }} <br>
                  <b>Payment Date:</b> {{    $receipt->created_at->toFormattedDateString() }} <br>
                  <b>Amount Paid:</b>  {{    $receipt->amount }} Naira
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Transaction Status</th>
                      <th>Event Name</th>
                      <th>Reference Id</th>
                      <th>Paid Via</th>
                      <th>Amount Paid (Naira)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>{{  $receipt->status }}</td>
                      <td>{{  $receipt->event_name }}</td>
                      <td>{{  $receipt->reference_id }}</td>
                      <td>{{  $receipt->paid_through }}</td>
                      <td>{{  $receipt->amount }}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Method:</p>
                  
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Work on This Later (check the type of card from paystack response,  display the image for type of card)
                  </p>
                </div>
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" class="btn btn-primary float-right" onclick="window.print();" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Print Receipt
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
 

@endsection