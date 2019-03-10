<?php
namespace App\Models\Helpers;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4/004
 * Time: 22:08
 */
class DateHelper extends Model{
    /**
     * 获取指定日期段内每一天的日期
     * @param  string  $startdate 开始日期
     * @param  string  $enddate   结束日期
     * @return array
     */
    public static function  getDateFromRange($startdate, $enddate){

        $stimestamp = strtotime($startdate);
        $etimestamp = strtotime($enddate);

        // 计算日期段内有多少天
        $days = ($etimestamp-$stimestamp)/86400+1;

        // 保存每天日期
        $date = array();

        for($i=0; $i<$days; $i++){
            $date[] = date('Y-m-d', $stimestamp+(86400*$i));
        }

        return $date;
    }
}