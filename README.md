# Avatar-support

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/luuhai48/avatar-support.svg)](https://packagist.org/packages/luuhai48/avatar-support)

A [Flarum](http://flarum.org) extension. Support others type of image when uploading avatar

------
### Installation

**Setup HEIC converter server**

You will need to setup a node server to convert the heic image to png.

You can clone and run the docker image from below, or use the code inside, deploy to AWS lambda or somewhere else.

[https://github.com/luuhai48/node-heic](https://github.com/luuhai48/node-heic)

------
**Install the extension**

```sh
composer require luuhai48/avatar-support
```

- Enter the **processor_url** inside the setting modal and start upload your avatar. It will be the url to your **HEIC converter server**.


### Updating

```sh
composer update luuhai48/avatar-support
```
------
### Links
- [Github](https://github.com/luuhai48/avatar-support)
- [Packagist](https://packagist.org/packages/luuhai/avatar-support)
