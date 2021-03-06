<?php

namespace Imarc\Pickture;

use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use Imarc\Pickture\fields\PicktureField;
use yii\base\Event;

class Plugin extends \craft\base\Plugin
{
	public function init()
	{
		Event::on(
			Fields::class,
			Fields::EVENT_REGISTER_FIELD_TYPES,
			function(RegisterComponentTypesEvent $event) {
				$event->types[] = PicktureField::class;
			}
		);
		parent::init();
	}
}
