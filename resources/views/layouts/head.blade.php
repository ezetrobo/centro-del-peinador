<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

<meta name="description" content=""/>
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{config('main.NOMBRE_SITIO')}}  @yield('title')</title>

<script type="text/javascript">
    var baseUrl = "<?php echo URL::to('/'); ?>/";
</script>