<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin/print.css') }}">
    <title>Document</title>
</head>
<body class="@yield('type')">

    <div class="container-fluid">
        <div id="header" class='row'>
            <div class="col-xs-12">
                <div class="col-xs-6">
                <img src="{{ asset('img/logo.png') }}" class="img-responsive" alt="Logo">
                </div>

                @if($invoice)
                <div class="col-xs-6">
                    <div class="col-xs-12">Name : {{ $invoice->customer->name }}</div>
                    <div class="col-xs-12">Phone : {{ $invoice->customer->phone }}</div>
                    <div class="col-xs-12">Date : {{ $invoice->created_at }}</div>
                    <div class="col-xs-12">Creator : {{ Auth::user()->name }}</div>
                    <div class="col-xs-12">Invoice ID : {{ $invoice->id }}</div>
                </div>
                @endif
            </div>
        </div>
    @if($invoice)
    <h5>
    </h5>
    
    @else
    <h3>Public Report</h3>
    @endif
    
        <div class="row">
           <div class="col-xs-12">
                @yield('data')
            </div> 
        </div>
        @if($invoice)
        <div class="row">
            <div class="col-xs-12">
                <h4>Terms and conidtions</h4>
                <p>
                    <ul>
                        <li>Warrany is valid if this recipt and Item box is available with it is original status</li>
                        <li>Warranty applies against industry defects</li>
                        <li>Warrany is not valid on Adapter , IR Lens</li>
                        <li>We are not responsible for damages caused by the customer</li>
                    </ul>
                    
                </p>
            </div> 
            <div class="col-xs-12">
                <p><strong>Electronics Home</strong></p>
                <p><strong>Phone :</strong> 040-22240050</p>
                <p><strong>Address :</strong> 12 , 6th October St. Almahalla Alkubra Elgharbeya</p>
            </div> 
         </div>
         @endif

        </div>
</body>
</html>
