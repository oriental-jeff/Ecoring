<?php

namespace App\Helpers;

use App\Model\RunNumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AutoGenDoc {
    public static function generateCode($type = 'order') {

        $carbon = Carbon::now('Asia/Bangkok');
        $year = $carbon->year;
        $month = $carbon->isoFormat('MM');

        // GET : Total Run Number
        $where = [['type', $type], ['yyyy', $year], ['mm', $month]];
        $total = RunNumber::where($where)->count();

        // Make a Run Number
        $count = sprintf('%04d', $total + 1);
        $code = "{$year}{$month}{$count}";

        // Insert Run Number
        $run_number = new RunNumber;
        $run_number->type = $type;
        $run_number->yyyy = $year;
        $run_number->mm = $month;
        $run_number->last_num = $count;
        $run_number->created_by = Auth::id();
        $run_number->save();
        // $data_insert = ['type' => $type, 'yyyy' => $year, 'mm' => $month, 'last_num' => $count, ];
        // RunNumber::insert($data_insert);

        return $code;
    }
}
