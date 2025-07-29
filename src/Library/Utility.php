<?php

namespace Liteslim\Library;

class Utility
{
    const ENV_DEV = "dev";
    const ENV_QA = "qa";
    const ENV_PRO = "pro";

    public static function test() : string
    {
        return "this is a Utility Test";
    }
}