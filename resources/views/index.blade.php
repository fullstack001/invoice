@extends('layouts.main')
@section('title')
    Home
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <body data-sidebar="colored">
@endsection
@section('content')
    <section class="landing-hero">        
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="hero-title">
                        Welcome to Reconsol
                    </div>
                    <div class="hero-subTitle">
                        The invoice reconciliation tool to identify accounting errors from your suppliers.
                    </div>
                    <div class="hero-text">
                        We automatically help spot incorrectly sold products, errors in accounting and identify consolidations to help save your company money.
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hero-img">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="landing-product">
        <div class="container">
            <div class="row">
                <div class="col-md-4 landing-product-detail">
                    <div class="landing-product-img">

                    </div>

                    <div class="landing-product-title">
                        Automatic Invoice Recongnition
                    </div>
                    <div class="landing-product-description">
                        Upload your invoices from suppliers to automatically extract the line items
                    </div>
                </div>

                <div class="col-md-4 landing-product-detail">
                    <div class="landing-product-img">

                    </div>

                    <div class="landing-product-title">
                        Supplier Pricing Agreements
                    </div>
                    <div class="landing-product-description">
                        Enter your agreed prices and dates and consolidate skus across suppliers
                    </div>
                </div>

                <div class="col-md-4 landing-product-detail">
                    <div class="landing-product-img">

                    </div>

                    <div class="landing-product-title">
                        Instant Alerts
                    </div>
                    <div class="landing-product-description">
                        Alerts when wrong skus are used or incorrect prices is spotted.
                    </div>
                </div>     
            </div>       
        </div>
    </section>

    <section class="landing-how">
        <div class="container">
            <div class="landing-how-title">
                How it Works
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="landing-how-detail">
                        <span class="landing-how-step">
                            1.
                        </span>
                        <span class="landing-how-description">
                            Enter your suppliers,  products and agreed pricing.
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="landing-how-detail">
                        <span class="landing-how-step">
                            2.
                        </span>
                        <span class="landing-how-description">
                            Upload or manually enter your  supplier invoices.
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="landing-how-detail">
                        <span class="landing-how-step">
                            3.
                        </span>
                        <span class="landing-how-description">
                            Generate reports on discrepancies and errors in accounting.
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="landing-how-detail">
                        <span class="landing-how-step">
                            4.
                        </span>
                        <span class="landing-how-description">
                            Renegotiate pricing with suppliers to secure the best rates
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="landing-how-detail">
                        <span class="landing-how-step">
                            5.
                        </span>
                        <span class="landing-how-description">
                            Raise invoice queries to claw back over payments increasing revenue on your bottom line.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END ROW -->
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
