<?php

namespace xBibouMsg;

use pocketmine\plugin\PluginBase;
use xBibouMsg\Command\MsgCommand;

class Main extends PluginBase
{
    protected function onEnable(): void
    {
        $this->getServer()->getCommandMap()->register("",new MsgCommand());
    }
}
