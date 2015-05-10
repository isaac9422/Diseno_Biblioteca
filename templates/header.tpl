<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="{$gvar.l_global}favicon.ico" />
        <title>{$title}</title>
        <style>
                table#busqueda {
                 
                  border: 1px solid black;
                } 

                table#busqueda td {
                  border: 1px solid black;
                }   
        </style>
        {literal} 
            <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/styles.css); </style>
            <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/bootstrap.css); </style>
            <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/bootstrap-responsive.css); </style>
            <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/bootstrap-theme.css); </style>
            <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/bootstrap-min.css); </style>
            <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/styles.css); </style>
            <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/t_dark.css); </style>
            <script type='text/javascript'>l_global = '{/literal}{$gvar.l_global}{literal}';</script>
            <script src="{/literal}{$gvar.l_global}{literal}js/jquery-1.11.2.min.js" language="Javascript"></script>
            <script src="{/literal}{$gvar.l_global}{literal}js/bootstrap.js" language="Javascript"></script>
            
        {/literal}
    </head>

    <body>
        
        <header id="header">
            <div id="top-background">
                <!-- Begin Container -->
                <div class=" container" style="height: auto">
                    <!-- Begin Menu Header -->
{*                    <div class="navbar navbar-inverse">*}
                        <div class="navbar" style="display: block">
                            <div class="container" style="width: auto;">
                                <a class="brand" href="{$gvar.l_index}"><img src="{$gvar.l_global}images/logo.png" width="180px" height="30px"/></a>
                                <ul class="nav">

                                </ul>

                                <ul class="nav pull-right">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Begin End Header -->
                    </header>
                    <!-- Begin Content -->
                    <div id="content" class="container-fluid"> 

                        <!-- Begin Navigation -->

                        <!-- End Navigation -->

                        <table id="contenido" cellpadding="20" cellspacing="10">
                            <tr><td align="center" width="150px" valign="top">
                                    {include file='login.tpl'}
                                </td>
                                <td align="left" valign="top">