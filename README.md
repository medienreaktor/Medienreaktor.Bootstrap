# Medienreaktor.Bootstrap
Bootstrap Components for Neos CMS (Fusion Components and AFX) – based on Bootstrap 4.1 (https://getbootstrap.com/)

## How to use

Map your content NodeTypes to the presentational components like this:

```
prototype(Medienreaktor.Site:Content.Button) < prototype(Neos.Neos:ContentComponent) {
    renderer = Medienreaktor.Bootstrap:Component.Button {
        content = Neos.Neos:Editable {
            property = 'text'
            block = false
        }
        href = ${q(node).property('link')}
        href.@process.convertUris = Neos.Neos:ConvertUris {
            forceConversion = true
        }
        theme = ${q(node).property('theme')}
    }
}
```

The resulting HTML is a Bootstrap button component:

```
<a href="http://" class="btn btn-primary">Your Button Text</a>
```

See the component fusion files for the complete API of all properties. In case of the button component, there are e.g. ```outline``` and ```size``` properties you can set either using NodeType properties or in your ContentComponent definition.

## Included components

### Layout
+ Container
+ Grid (rows and cols)
+ Media

### Component
+ Alert
+ Badge
+ Breadcrumb
+ Button
+ Button group
+ List group
+ Nav
+ Navbar
+ Pagination

### Utility
+ Close icon
+ Embed responsive

## Work in progress

This is work-in-progress. More components will be added from time to time.
