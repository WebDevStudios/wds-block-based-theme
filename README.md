# WDS Block Based Theme

An experimental block based theme, which supports full site editing. Learn more about building [Block Based Themes](https://developer.wordpress.org/block-editor/tutorials/block-based-themes/) for WordPress.

*Note: the following features are still experimental, and should not be used in a production environment.*

<a href="https://webdevstudios.com/contact/"><img src="https://webdevstudios.com/wp-content/uploads/2018/04/wds-github-banner.png" alt="WebDevStudios. Your Success is Our Mission."></a>

## Table of Contents
- [WDS Block Based Theme](#wds-block-based-theme)
  - [Requirements](#requirements)
  - [Theme Installation](#theme-installation)
  - [Glossary](#glossary)
  - [Site Editor as Page Builder](#site-editor-as-page-builder)
    - [Export (Optional)](#export-optional)
  - [Global Styles via Theme JSON](#global-styles-via-theme-json)
  - [Theme Support](#theme-support)

## Requirements

1. The [Gutenberg Plugin](https://wordpress.org/plugins/gutenberg/) must be installed and activated.
2. Enable "Full Site Editing" under "Experiments":

![screenshot](https://dl.dropbox.com/s/9oj24opmbkvbfvh/Screen%20Shot%202020-08-18%20at%2011.36.50%20AM.png?dl=0)

## Theme Installation

Clone this repo into `/wp-content/themes`:

```bash
git clone git@github.com:WebDevStudios/wds-block-based-theme.git
```

Activate the theme:

![screenshot](https://dl.dropbox.com/s/f372jqm7xtvmcnm/Screen%20Shot%202020-08-18%20at%2011.43.21%20AM.png?dl=0)

## Glossary

**Structure** - Block based themes follow this structure:

```text
theme
|__ style.css
|__ functions.php
|__ index.php
|__ experimental-theme.json
|__ block-templates
    |__ index.html
    |__ single.html
    |__ archive.html
    |__ ...
|__ block-template-parts
    |__ header.html
    |__ footer.html
    |__ sidebar.html
    |__ ...
```

**Block & Block Grammar** - An [HTML comment](https://developer.wordpress.org/block-editor/principles/key-concepts/#blocks) containing information about a Block or Template Part. The following grammar creates a centered `<p>` tag in the block editor:

```html
<!-- wp:paragraph {"align":"center"} -->
    <p>I am a centered paragraph tag</p>
<!-- /wp:paragraph -->
```

**Template Parts** - An HTML container for block grammar, which is displayed in Templates. To call a Template Part in a template, use this block grammar:

```html
<!-- wp:template-part {"slug":"header","theme":"yourtheme"} /-->
```

**Templates** - An HTML container that displays Template Parts and Block Grammar. They follow the WordPress [template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/):

```html
<!-- wp:template-part {"slug":"header","theme":"yourtheme"} /-->
<!-- wp:paragraph {"align":"center"} -->
    <p>I am a centered paragraph tag</p>
<!-- /wp:paragraph -->
<!-- wp:template-part {"slug":"footer","theme":"yourtheme"} /-->
```
---

## Site Editor as Page Builder

**Use the Site Editor** to build your site:

![screenshot](https://dl.dropbox.com/s/9e26iy1dlvn2bva/Screen%20Shot%202020-08-18%20at%2012.06.47%20PM.png?dl=0)

As you build, your Templates and Template Part block grammar **are saved to the database**, which can be accessed under the Appearance menu:

![screenshot](https://dl.dropbox.com/s/bgo15p7xmt8pdt4/Screen%20Shot%202020-08-18%20at%2012.15.57%20PM.png?dl=0)

You can even edit Templates and Template Parts individually from the Appearance menu:

![screenshot](https://dl.dropbox.com/s/irxr0m3ztmswc2l/Screen%20Shot%202020-08-18%20at%2012.17.53%20PM.png?dl=0)

---

### Export (Optional)

When you're finished building your site, you can **export the your changes from the "Tools" menu**:

![screenshot](https://dl.dropbox.com/s/xhimdjroyrgih9a/Screen%20Shot%202020-08-18%20at%2012.05.09%20PM.png?dl=0)

This action will export all of the Block Grammar into their respective Template and Template Part files. This feature is similar to ACF's [Local JSON](https://www.advancedcustomfields.com/resources/local-json/).

Place the exported Templates and Template Parts files into your theme:

![screenshot](https://dl.dropbox.com/s/vd40hcty2668bq6/kapture%202020-08-18%20at%2012.10.41.gif?dl=0)

Everything you built in the Site Editor, is now available as code in your theme, which could be checked into version control or shipped to a client.

![screenshot](https://dl.dropbox.com/s/w6mwivtu36cv7px/Screen%20Shot%202020-08-18%20at%2012.21.16%20PM.png?dl=0)

If you look close, you'll see an additional `postID` paramenter in the Template Part grammar:

```html
<!-- wp:template-part {"postID":94,"slug":"header","theme":"yourtheme"} /-->
```

This informs WordPress that the Header is also saved in the database, under `postID: 94`.

---

## Global Styles via Theme JSON

Block based themes support an `experimental-theme.json` file. This feature feels similar to [Theme UI](https://theme-ui.com/home).

This file:

* Creates CSS variables (also called CSS custom properties) that can be used to style blocks both on the front and in the editor.
* Sets global styles.
* Sets styles for individual block types.

```json
{
  "global": {
    "presets": {
      "color": [
        {
          "slug": "strong-magenta",
          "value": "#a156b4"
        }
      ]
    }
  },

  "core/heading/h2": {
    "styles": {
      "color": {
        "text": "var( --wp--preset--color--strong-magenta )"
      }
    }
  }
}
```

The settings above would set a global CSS variable for all  `<h2>` Blocks. WordPress parses this file and makes these CSS variables availabl, without you needed to write any actual CSS.

![screenshot](https://dl.dropbox.com/s/265wcfzsuls9vz6/Screen%20Shot%202020-08-18%20at%201.38.40%20PM.png?dl=0)

Learn more about [Theme JSON](https://developer.wordpress.org/block-editor/developers/themes/theme-json/).

---

## Theme Support

Block based themes will continue to leverage `add_theme_support()` as an opt-in, to extend and customize Core WordPress features.

* `wp-block-styles`
* `align-wide`
* `block-nav-menus`
* `editor-color-palette`
* `editor-gradient-presets`
* `editor-font-sizes`
* `custom-line-height`
* `custom-units`
* `dark-editor-style`
* `responsive-embeds`
* `experimental-custom-spacing`
* `experimental-link-color`

The following example sets default colors in the Block Editor:

```php
function yourtheme_setup_theme_supported_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'strong magenta', 'yourtheme' ),
            'slug'  => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name'  => __( 'very light gray', 'yourtheme' ),
            'slug'  => 'very-light-gray',
            'color' => '#f1f1f1',
        ),
    ) );
}

add_action( 'after_setup_theme', 'yourtheme_setup_theme_supported_features' );
```
This would be helpful if you needed to set your client's colors as defaults for branding purposes:

![screenshot](https://dl.dropbox.com/s/qyucddgsub2skn4/Screen%20Shot%202020-08-19%20at%208.06.49%20AM.png?dl=0)

Learn more about available [Theme Support](https://developer.wordpress.org/block-editor/developers/themes/theme-support/) options.

---

Learn more https://developer.wordpress.org/block-editor/tutorials/block-based-themes/
