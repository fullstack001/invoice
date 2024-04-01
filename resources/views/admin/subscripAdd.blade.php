@extends('layouts.master')
@section('title')
    Billing
@endsection
@section('page-title')
    Billing
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="content-description mb-3">
                    You can managed your subscription and download invoices from here.
                </div>

                <div class="subscription-detail row">
                    <div class="col-md-8">
                        You are current on the {{ $currentPlan }} plan.
                    </div>
                </div>
                <div class="mt-3">
                    <h3>
                        Subscription
                    </h3>
                    <div class="row">
                        <form action="{{ route('subscrip.subscribe') }}" method="POST" id="payment-form">
                            @csrf

                            <div class="form-group">
                                <label for="plan_id">Select a Plan:</label>
                                <select name="plan_id" id="plan_id" class="form-control">
                                    <option value="0">Free Plan - 0 &#163;</option>
                                    <option value="24.99">Essential Plan - 24.99 &#163;</option>
                                    <option value="69.99">Premium Plan - 69.99 &#163;</option>
                                    <option value="99.99">Unlimited Plan - 99.99 &#163;</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="card-holder-name">Cardholder Name</label>
                                <input type="text" id="card-holder-name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="card-element">Credit or Debit Card</label>
                                <div id="card-element"></div>
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary ">Subscribe</button>
                            </div>
                                                        
                        </form>
                       
                    </div>
                </div>             
            </div>        

        </div>

        

        
    @endsection
  
    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> 

         <!-- Sweet Alerts js -->
         <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

         <!-- Sweet alert init js-->
         <script src="{{ URL::asset('build/js/pages/sweet-alerts.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            $(document).ready(function () {

                var stripe = Stripe('{{ config('services.stripe.key') }}');
               
                var elements = stripe.elements();
                var cardElement = elements.create('card');
                cardElement.mount('#card-element');

                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    stripe.createToken(cardElement).then(function(result) {
                        if (result.error) {
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            stripeTokenHandler(result.token);
                        }
                    });
                });

                function stripeTokenHandler(token) {
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
                
              
            });
        </script>
        
    @endsection
