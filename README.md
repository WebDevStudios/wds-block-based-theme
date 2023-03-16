# WDS Block Based Theme

A block based theme, which supports full site editing. Learn more about building [Block Based Themes](https://developer.wordpress.org/themes/block-themes/) for WordPress.

> **Note**
> With the release of WordPress 5.9, Site Editing is available as part of WordPress without installing Gutenberg. However, this theme started when these features were still experimental, and should not (yet) be used in a production environment.

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

---

## Requirements

> **Note**
> The previous version of these notes included enabling Full Site Editing under Gutenberg settings, that is no longer necessary (or available, since it is not an experiment anymore).

1. _(Optionally)_ The [Gutenberg Plugin](https://wordpress.org/plugins/gutenberg/) can be installed and activated. Gutenberg is no longer required but can be installed for the latest features regarding Site Editing.

---

## Theme Installation

Clone this repo into `/wp-content/themes`:

```bash
git clone git@github.com:WebDevStudios/wds-block-based-theme.git
```

Activate the theme:

![screenshot](https://dl.dropbox.com/s/f372jqm7xtvmcnm/Screen%20Shot%202020-08-18%20at%2011.43.21%20AM.png?dl=0)

---

## Glossary

**Structure** - Block based themes follow this structure:

```text
theme
|__ style.css
|__ functions.php
|__ index.php
|__ experimental-theme.json
|__ templates
    |__ index.html
    |__ single.html
    |__ archive.html
    |__ ...
|__ parts
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

![screenshot](https://dl.dropbox.com/s/mvmfh7k6db9mazw/Screenshot%202023-03-10%20at%2012.43.02%20PM.png?dl=0)

As you build, your Templates and Template Part block grammar **are saved to the database**, which can be accessed on the `Editor` under the `Template Parts` section:

![screenshot](https://dl.dropbox.com/s/d923uukrexvlmll/Screenshot%202023-03-10%20at%2012.44.33%20PM.png?dl=0)

You can even edit Templates and Template Parts individually from the `Editor`:

![screenshot](https://dl.dropbox.com/s/5lq5tuidu1ah6es/Screenshot%202023-03-10%20at%2012.48.17%20PM.png?dl=0)

---

### Export (Optional)

When you're finished building your site, you can **export the your changes from the "Tools" menu**:

![screenshot](https://dl.dropbox.com/s/p9j44ao48wtd3pq/Screenshot%202023-03-10%20at%2012.54.47%20PM.png?dl=0)

This action will export all of the Block Grammar into their respective Template and Template Part files. This feature is similar to ACF's [Local JSON](https://www.advancedcustomfields.com/resources/local-json/).

After updating Templates or Template Parts, the whole theme can be exported:

![screenshot](https://dl.dropbox.com/s/ywmhndvcmxwqq7b/Screenshot%202023-03-10%20at%2012.58.57%20PM.png?dl=0)

Everything you built in the Site Editor, is now available as code in your theme, which could be checked into version control or shipped to a client.

![screenshot](https://dl.dropbox.com/s/w6mwivtu36cv7px/Screen%20Shot%202020-08-18%20at%2012.21.16%20PM.png?dl=0)

> **Note**
> A previous version of this document mentioend that `postID` was part of an exported Template Part, which does not seem the case anymore. ref: <https://github.com/WordPress/gutenberg/pull/26812#issuecomment-830000230>

---

## Global Styles via Theme JSON

Block based themes support an `theme.json` file. WordPress parses this file and makes these CSS variables available, without any need to write CSS. This feature feels similar to [Theme UI](https://theme-ui.com).

The `theme.json` file:

- Creates CSS variables (also called CSS custom properties) that can be used to style blocks both on the front and in the editor.
- Sets global styles.
- Sets styles for individual block types.

The following example would set a global CSS variable for all  `<h2>` Blocks:

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

![screenshot](https://dl.dropbox.com/s/265wcfzsuls9vz6/Screen%20Shot%202020-08-18%20at%201.38.40%20PM.png?dl=0)

Learn more about [Theme JSON](https://developer.wordpress.org/block-editor/developers/themes/theme-json/).

---

## Theme Support

Block based themes will continue to leverage `add_theme_support()` as an "opt-in" way to extend and customize Core WordPress features.

The following features are:

- `align-wide`
- `block-nav-menus`
- `custom-line-height`
- `custom-units`
- `dark-editor-style`
- `editor-color-palette`
- `editor-gradient-presets`
- `editor-font-sizes`
- `experimental-custom-spacing`
- `experimental-link-color`
- `responsive-embeds`
- `wp-block-styles`

This example uses `editor-color-palette` to set default colors in the Block Editor:

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

This would be helpful if you needed to set your client's branding colors as defaults in the Block Editor:

![screenshot](https://dl.dropbox.com/s/qyucddgsub2skn4/Screen%20Shot%202020-08-19%20at%208.06.49%20AM.png?dl=0)

Learn more about available [Theme Support](https://developer.wordpress.org/block-editor/developers/themes/theme-support/) options.

---

Learn more <https://developer.wordpress.org/block-editor/how-to-guides/themes/>
