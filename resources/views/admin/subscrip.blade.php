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
                <div class="mt-3">
                    <h3>
                        Subscription
                    </h3>
                    <div class="subscription-detail row">
                        
                        <div class="col-md-8">
                            You are current on the {{ $currentPlan }} plan.
                        </div>
                        
                        <div class="col-md-4 text-right">
                    
                            <a href = {{ route('subscrip.add')}} type="button" class="btn btn-primary">
                                Manage
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3 mb-3">
                    <h3>Receipts</h3>
                </div>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap text-center"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">Paid</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Price</th>                      
                            <th class="text-center">Status</th>
                            <th class="text-center">Download</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($subscrips as $subscrip)
                            <tr>
                                <td>{{$subscrip->created_at}}</td>
                                <td>{{$subscrip->plan}}</td>
                                <td>{{$subscrip->price}} &#163;</td>
                                <td> {{$subscrip->subscription_status}} </td>
                                <td>
                                    @isset ($invoices)                                                               
                                        @foreach ($invoices->autoPagingIterator() as $invoice)
                                            @if ($subscrip->stripe_subscription_id == $invoice->subscription)
                                                <div>
                                                    Invoice Number: {{ $invoice->number }}
                                                    <a href="{{ route('subscrip.invoice', ['invoiceId' => $invoice->id]) }}" target="_blank">
                                                        <i class=" ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach                                                                                                          
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
                
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

        <script>
            $(document).ready(function () {
              
            });
        </script>
        
    @endsection
