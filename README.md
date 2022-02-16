Pickture Plugin for Craft
=========================

This plugin adds a field type to Craft, **Pickture (Radio Buttons)**, that is a
more visual alternative to radio buttons, where each radio button has an
associated thumbnail:

![Example of field when editing an entry](https://user-images.githubusercontent.com/1452/154289124-273aae32-bfd8-4c73-9b38-616449307536.jpg)



Installing Pickture
-------------------

```
composer require imarc/craft-pickture
```

Configuration
-------------

Creating Pickture fields is very similar to creating native dropdowns or radios, there's just a few extra columns:

![Example of field when editing an entry](https://user-images.githubusercontent.com/1452/154289517-cb522555-e83c-417e-8821-aae15a790234.jpg)

* **Label** – the label shown. The labels are truncated (via CSS) if they get longer than 100px (10-15 characters), so keep them short.
* **Image URL** – a URL used as the `src` attribute for the image.
  * If left blank, no thumbnail will be shown. The recommended aspect ratio is 2:1.
  * *Advanced usage:* you can optionally put arbitrary HTML in this field instead of a URL if you want to do something fancy.
* **CMS Block Background** – Optional block background.
  * If you specify a color in this field, then when this option is selected, this color is applied as the background to the closest parent matrix or neo block, or the current tab. It's meant to give CMS users a more visual way to see the block affected by a pickture field when it's used for picking background colors or images.
  * You'll likely want to stick to very light colors as the text color for labels and other elements within the block is not changed.
  * *Advanced usage:* the value is just set as the `background` property. That means not all are all CSS color formats browsers support are supported, but background images can be specified as well. For example `#f3f7fc linear-gradient(to right,red 4px, transparent 4px)` Provides a 4px red border on the left edge. Note, `#f3f7fc` is usually the default background color.
* **Value** – The value of this option.
* **Default?** – Whether this option should be the default option.
