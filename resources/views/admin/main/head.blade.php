<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | {{ Route::getFacadeRoot()->current()->getName() }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  @if(get_locale() !== "ar")
	<link rel="stylesheet" href="{{ asset('admin/app.css') }}" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  @else
  <link rel="stylesheet" href="{{ asset('admin/app-rtl.css') }}" />
  <link href="https://fonts.googleapis.com/css?family=Cairo:400,700&amp;subset=arabic" rel="stylesheet">
  <style>
    p , a , h1 , h2 , h3 , h4 , h5 , h6 , input , label , ul , li , button, table{
      font-family: 'Cairo', sans-serif ;
    }
  </style>
  @endif
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
</head>