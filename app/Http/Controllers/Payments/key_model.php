<?php
    //Log
    $id = (int) $key;

    $billing = \App\Models\Billing::find($id);
    if (!empty($billing)) {
        if ($billing->status == 'waiting') {
            return $billing;
        }
    }
    
    
    return null;