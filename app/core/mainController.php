<?php
class mainController
{
    public function callView($module,$method,$params=[])
    {
        return view::frontView($module,$method,$params);
    }

    public function  callLayout($area,$layout,$module,$method,$params=[])
    {
        return view::frontLayout($area,$layout,$module,$method,$params);
    }
}