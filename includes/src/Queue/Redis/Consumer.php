<?php

namespace Swift\Queue\Redis;

interface Consumer
{
    public function consume($data);
}