Responsive wordpress theme built for the biannual Arts & Sciences Magazine.

It runs off the Foundation v5 libsass template.


## Requirements

You'll need to have the following items installed before continuing.

  * [Node.js](http://nodejs.org): Use the installer provided on the NodeJS website.
  * [Grunt](http://gruntjs.com/): Run `[sudo] npm install -g grunt-cli`
  * [Bower](http://bower.io): Run `[sudo] npm install -g bower`

## Installation
  * Clone this repository
  * cd into repo and run `npm install`
  * Run `cd assets && bower install` to install the latest version of Foundation
  
Then when you're working on your project, just run the following command:

```bash
grunt
```

## Upgrading

If you'd like to upgrade to a newer version of Foundation down the road just run:

```bash
bower update
```