<?php 

    if($url[1] == 'dashboard'){
        $dashboard = 'active';
        echo "<title>Dashboard | I Hope In Christ </title>";
    }
    else if($url[1] == 'account'){
        $account = 'active';
        echo "<title>My Account | I Hope In Christ </title>";
    }
    else if($url[1] == 'earnings'){
        $earnings = 'active';
        echo "<title>My Earnings | I Hope In Christ </title>";
    }
    else if($url[1] == 'payment'){
        $payment = 'active';
        echo "<title>Make Payment | I Hope In Christ </title>";
    }
    else if($url[1] == 'payments'){
        $payments = 'active';
        echo "<title>My Payments | I Hope In Christ </title>";
    }
    else if($url[1] == 'withdraws'){
        $withdraws = 'active';
        echo "<title>My Withdraws | I Hope In Christ </title>";
    }
    else if($url[1] == 'setting'){
        $setting = 'active';
        echo "<title>My Setting | I Hope In Christ </title>";
    }