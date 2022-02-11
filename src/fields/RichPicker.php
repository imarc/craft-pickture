<?php

namespace Imarc\CraftRichPicker\fields;

use Craft;
use craft\helpers\ArrayHelper;
use craft\base\ElementInterface;
use craft\helpers\Cp;
use craft\fields\data\SingleOptionFieldData;
use Imarc\CraftRichPicker\assets\RichPickerAsset;

class RichPicker extends \craft\fields\RadioButtons
{
    public static function displayName(): string
    {
        return Craft::t('rich-picker', 'Radio Buttons (Rich Picker)');
    }

    public function optionsSettingLabel(): string
    {
        return Craft::t('rich-picker', 'Rich Picker Options');
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        if (empty($this->options)) {
            // Give it a default row
            $this->options = [['label' => '', 'template' => '', 'color' => '', 'value' => '']];
        }

        $cols = [];
        if ($this->optgroups) {
            $cols['isOptgroup'] = [
                'heading' => Craft::t('app', 'Optgroup?'),
                'type' => 'checkbox',
                'class' => 'thin',
                'toggle' => ['!value', '!default'],
            ];
        }
        $cols['label'] = [
            'heading' => Craft::t('app', 'Option Label'),
            'type' => 'singleline',
            'autopopulate' => 'value',
        ];
        $cols['template'] = [
            'heading' => Craft::t('rich-picker', 'Template'),
            'type' => 'singleline',
            'class' => 'code',
        ];
        $cols['color'] = [
            'heading' => Craft::t('rich-picker', 'Color'),
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
            'radioMode' => !$this->multi,
            'class' => 'thin',
        ];

        $rows = [];
        foreach ($this->options as $option) {
            if (isset($option['optgroup'])) {
                $option['isOptgroup'] = true;
                $option['label'] = ArrayHelper::remove($option, 'optgroup');
            }
            $rows[] = $option;
        }

        return Cp::editableTableFieldHtml([
            'label' => $this->optionsSettingLabel(),
            'instructions' => Craft::t('app', 'Define the available options.'),
            'id' => 'options',
            'name' => 'options',
            'addRowLabel' => Craft::t('app', 'Add an option'),
            'cols' => $cols,
            'rows' => $rows,
            'errors' => $this->getErrors('options'),
        ]);
    }

    protected function translatedOptions(): array
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
                    'color' => $option['color'],
                    'value' => $option['value'],
                ];
            }
        }

        return $translatedOptions;
    }

    protected function inputHtml($value, ElementInterface $element = null): string
    {
        Craft::$app->getView()->registerAssetBundle(RichPickerAsset::class);

        /** @var SingleOptionFieldData $value */
        if (!$value->valid) {
            Craft::$app->getView()->setInitialDeltaValue($this->handle, null);
        }

        return Craft::$app->getView()->renderTemplate('rich-picker/forms/radioGroup', [
            'describedBy' => $this->describedBy,
            'name' => $this->handle,
            'value' => $value,
            'options' => $this->translatedOptions(),
        ]);
    }
}
