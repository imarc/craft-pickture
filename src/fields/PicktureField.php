<?php

namespace Imarc\Pickture\fields;

use Craft;
use craft\helpers\ArrayHelper;
use craft\base\ElementInterface;
use craft\helpers\Cp;
use craft\fields\data\SingleOptionFieldData;
use Imarc\Pickture\assets\PicktureAsset;

class PicktureField extends \craft\fields\RadioButtons
{
    public static function displayName(): string
    {
        return Craft::t('pickture', 'Pickture (Radio Buttons)');
    }

    public function optionsSettingLabel(): string
    {
        return Craft::t('pickture', 'Pickture Options');
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml(): ?string
    {
        if (empty($this->options)) {
            // Give it a default row
            $this->options = [['label' => '', 'template' => '', 'background' => '', 'value' => '']];
        }

        $cols = [];
        $cols['label'] = [
            'heading' => Craft::t('app', 'Label'),
            'type' => 'singleline',
            'autopopulate' => 'value',
        ];
        $cols['template'] = [
            'heading' => Craft::t('pickture', 'Image URL'),
            'type' => 'singleline',
            'class' => 'code',
            'placeholder' => 'https://',
        ];
        $cols['background'] = [
            'heading' => Craft::t('pickture', 'CMS Block Background'),
            'type' => 'singleline',
            'class' => 'code',
        ];

        $cols['value'] = [
            'heading' => Craft::t('app', 'Value'),
            'type' => 'singleline',
            'class' => 'code',
        ];
        $cols['default'] = [
            'heading' => Craft::t('app', 'Default?'),
            'type' => 'checkbox',
            'class' => 'thin',
        ];

        return Cp::editableTableFieldHtml([
            'label' => $this->optionsSettingLabel(),
            'instructions' => Craft::t('app', 'Define the available options.'),
            'id' => 'options',
            'name' => 'options',
            'addRowLabel' => Craft::t('app', 'Add an option'),
            'allowAdd' => true,
            'allowReorder' => true,
            'allowDelete' => true,
            'cols' => $cols,
            'rows' => $this->options,
            'errors' => $this->getErrors('options'),
        ]);
    }

    protected function translatedOptions(bool $encode = false, mixed $value = null, ?craft\base\ElementInterface $element = null): array
    {
        $translatedOptions = [];

        foreach ($this->options() as $option) {
            if (isset($option['optgroup'])) {
                $translatedOptions[] = [
                    'optgroup' => Craft::t('site', $option['optgroup']),
                ];
            } else {
                $translatedOptions[] = [
                    'label' => Craft::t('site', $option['label']),
                    'template' => $option['template'],
                    'background' => $option['background'],
                    'value' => $option['value'],
                ];
            }
        }

        return $translatedOptions;
    }

    protected function inputHtml($value, ElementInterface $element = null, bool $inline = false): string
    {
        Craft::$app->getView()->registerAssetBundle(PicktureAsset::class);

        /** @var SingleOptionFieldData $value */
        if (!$value->valid) {
            Craft::$app->getView()->setInitialDeltaValue($this->handle, null);
        }

        return Craft::$app->getView()->renderTemplate('pickture/forms/picktureGroup', [
            'describedBy' => $this->describedBy,
            'name' => $this->handle,
            'value' => $value,
            'options' => $this->translatedOptions(),
        ]);
    }
}
