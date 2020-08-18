# WDS Block Based Theme

An experimental block based theme, which supports full site editing.

Learn more https://developer.wordpress.org/block-editor/tutorials/block-based-themes/

<a href="https://webdevstudios.com/contact/"><img src="https://webdevstudios.com/wp-content/uploads/2018/04/wds-github-banner.png" alt="WebDevStudios. Your Success is Our Mission."></a>

## Requirements

The [Gutenberg Plugin](https://wordpress.org/plugins/gutenberg/) must be installed and activated.

Enable "Full Site Editing" under "Experiments".

![screenshot](https://dl.dropbox.com/s/9oj24opmbkvbfvh/Screen%20Shot%202020-08-18%20at%2011.36.50%20AM.png?dl=0)

## Theme Installation

Clone the repo into `/wp-content/themes`

```bash
git clone git@github.com:WebDevStudios/wds-block-based-theme.git
```

Activate the theme

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

**Templates** - An HTML container that displays Template Parts and Block Grammar. They follow the WordPress [template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)

```html
<!-- wp:template-part {"slug":"header","theme":"yourtheme"} /-->
<!-- wp:paragraph {"align":"center"} -->
    <p>I am a centered paragraph tag</p>
<!-- /wp:paragraph -->
<!-- wp:template-part {"slug":"footer","theme":"yourtheme"} /-->
```

## The Site Editor as a Page Builder

**Use the Site Editor** to build your theme:

![screenshot](https://dl.dropbox.com/s/9e26iy1dlvn2bva/Screen%20Shot%202020-08-18%20at%2012.06.47%20PM.png?dl=0)

---

As you build, your Templates and Template Parts are also saved to the database, and can be access under the Appearance menu:

![screenshot](https://dl.dropbox.com/s/bgo15p7xmt8pdt4/Screen%20Shot%202020-08-18%20at%2012.15.57%20PM.png?dl=0)

---

You can even edit Templates and Template Parts individually from the Appearance menu:

![screenshot](https://dl.dropbox.com/s/irxr0m3ztmswc2l/Screen%20Shot%202020-08-18%20at%2012.17.53%20PM.png?dl=0)

---

When finished in the Site Editor, **export the site from the "Tools" menu**:

![screenshot](https://dl.dropbox.com/s/xhimdjroyrgih9a/Screen%20Shot%202020-08-18%20at%2012.05.09%20PM.png?dl=0)

*This action will export all of the Block Grammar into their respective Template and Template Part files.*

---

Place the exported Templates and Template Parts files into your theme:

![screenshot](https://dl.dropbox.com/s/vd40hcty2668bq6/kapture%202020-08-18%20at%2012.10.41.gif?dl=0)

---

Everything you just created in the Site Editor, is now available in your theme as Block Grammar:

![screenshot](https://dl.dropbox.com/s/w6mwivtu36cv7px/Screen%20Shot%202020-08-18%20at%2012.21.16%20PM.png?dl=0)

Learn more https://developer.wordpress.org/block-editor/tutorials/block-based-themes/
