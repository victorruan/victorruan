<?php
/**
 * Created by PhpStorm.
 * User: victorruan
 * Date: 16/8/20
 * Time: 下午5:51
 */

namespace VictorRuan\lib;


class Router
{
    const CtrlNameSpace = 'VictorRuan\app\ctrls';
    public function getCtrl(){
        if(!isset(explode('/',$_SERVER['REQUEST_URI'])[1]) or empty(explode('/',$_SERVER['REQUEST_URI'])[1])){
            $ctrl = 'index';
        }else{
            $ctrl = explode('/',$_SERVER['REQUEST_URI'])[1];
        }
        $ctrls = explode('_',$ctrl);
        foreach($ctrls as &$value){
            $value = ucfirst($value);
        }
        $ctrl = implode('',$ctrls);
        try{
            $ctrl = Factory::getInstance($this::CtrlNameSpace.'\\'.$ctrl);
        }catch(\Exception $e){
            printf_info($ctrl.' is not a ctrl!');
        }
       return $ctrl;
    }

    public function getAction(){
        return explode('/',$_SERVER['REQUEST_URI'])[2]??'index';
    }
}