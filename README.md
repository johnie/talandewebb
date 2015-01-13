# Talande Webb Plus

> WordPress plugin for Funka Nu screen reader application Talande Webb Plus

## Getting started

Download the [latest zip](https://github.com/johnie/talandewebb/archive/master.zip) and upload it via the plugins page in WordPress or unzip it in the `plugins` directory.

### Usage

**Shortcode**

`[talandewebb class="optional-class"]Aktivera Talande Webb[/talandewebb]`

**Link**

`<a href="#" onclick="toggleBar();">Aktivera Talande Webb</a>`

**JavaScript**

```javascript
;(function () {
  var btn = document.getElementById('tw-btn');

  btn.addEventListener('click', toggleBar());
})();
```

**jQuery**

```javascript
;(function () {
  var btn = $(#'tw-btn');

  btn.on('click', toggleBar());
})();
```

## Languages

Currently supported languages are:

* Swedish
* English
* Norwegian
* Finnish
* German

## Support

If the plugin can't load the script files, then that might be because you haven't been added to the list of accessible sites. If that is the case, please contact [Funka Nu](http://www.funkanu.com/sv/Om-Funka/Funka-Nu-AB/Kontakta-oss/)

### Licence

GPL2 © [Funka Nu](http://www.funkanu.com/)
