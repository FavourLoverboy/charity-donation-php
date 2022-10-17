<?php 

    if($url[1] == 'dashboard'){
        $dashboard = 'active';
        echo "<title>Dashboard | I Hope In Christ </title>";
    }
    else if($url[1] == 'accounts'){
        $accounts = 'active';
        echo "<title>User Accounts | I Hope In Christ </title>";
    }
    else if($url[1] == 'user_account'){
        $$accounts = 'active';
        echo "<title>View Account | I Hope In Christ </title>";
    }
    else if($url[1] == 'earners'){
        $earners = 'active';
        echo "<title>Earners | I Hope In Christ </title>";
    }
    else if($url[1] == 'members'){
        $members = 'active';
        echo "<title>All Members | I Hope In Christ </title>";
    }
    else if($url[0] == 'admin' AND $url[1] == 'payments'){
        $payments = 'active';
        echo "<title>All Payments | I Hope In Christ </title>";
    }
    else if($url[1] == 'p_withdrawals' OR $url[1] == 'all_p_withdrawals'){
        $p_withdrawals = 'active';
        echo "<title>All Pending Withdrawals | I Hope In Christ </title>";
    }
    else if($url[1] == 'withdrawals' OR $url[1] == 'all_withdrawals'){
        $withdrawals = 'active';
        echo "<title>All Withdrawals | I Hope In Christ </title>";
    }