//<?php

\Illuminate\Support\Facades\Mail::to(\App\Models\User::find(1))->send(new \App\Mail\SendAggregatedInfoMail([
    'followers'=>3,
    'followings'=>4,
    'username'=>'avto'
]));
