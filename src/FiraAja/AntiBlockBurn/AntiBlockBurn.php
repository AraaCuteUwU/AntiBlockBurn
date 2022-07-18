<?php

namespace FiraAja\AntiBlockBurn;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBurnEvent;

class AntiBlockBurn extends PluginBase implements Listener {
	
	public function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
	}
	
	public function onBurn(BlockBurnEvent $event){
		$block = $event->getBlock();
		if(empty($this->getConfig()->get("antiburn-worlds", []))){
			$event->cancel();
		}else{
			foreach($this->getConfig()->getAll() as $key){
				$from = $block->getPosition()->getWorld()->getFolderName();
				if($key == $from){
					$event->cancel();
				}
			}
		}
	}
}
