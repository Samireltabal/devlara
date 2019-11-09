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
                        <li>الضمان ساري المفعول إذا كان هذا الإيصال وكرتونة المنتج متاحه</li>
                        <li>الضمان ساري ضد عيوب الصناعه</li>
                        <li>في حالة فتح المنتج او تعديل السوفت وير او الهارد وير يعتبر المنتج خارج الضمان</li>
                        <li>نحن لسنا مسؤولين عن الأضرار الناجمة عن العميل</li>
                        <li>الضمان ساري لمدة سنتين من تاريخ الفاتورة على اجهزة السمارت هوم</li>
                        <li>الضمان ساري لمدة سنه من تاريخ الفاتورة على اجهزة كاميرات المراقبة و الدي في أر</li>                        
                    </ul>
                    
                </p>
            </div> 
            <div class="col-xs-12">
                <p><strong>{{ env("COMPANY_NAME","PLEASE EDIT IN .env File") }}</strong> <br>
                <strong>Phone :</strong> {{ env("COMPANY_PHONE","PLEASE EDIT IN .env File") }} <br>
                <strong>Address :</strong> {{ env("COMPANY_ADDRESS","PLEASE EDIT IN .env File") }}<br>
                <strong>website :</strong> {{ env("COMPANY_WEBSITE","PLEASE EDIT IN .env File") }}<br>
                <strong>Mail :</strong> {{ env("COMPANY_EMAIL","PLEASE EDIT IN .env File") }}</p>
                
            </div> 
         </div>
         @endif

        </div>
</body>
</html>
