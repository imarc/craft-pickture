<?php

namespace Imarc\CraftRichPicker;

use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use Imarc\CraftRichPicker\fields\RichPicker;
use yii\base\Event;

class Plugin extends \craft\base\Plugin
{
	public function init()
	{
		Event::on(
			Fields::class,
			Fields::EVENT_REGISTER_FIELD_TYPES,
			function(RegisterComponentTypesEvent $event) {
				$event->types[] = RichPicker::class;
			}
		);
		parent::init();
	}
}
