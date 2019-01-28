<img src="./dist/assets/images/thunderbird.svg" width="100px">

# Thunderbird

Thunderbird is a Fast and Lightweight Static Site Generator built on PHP. With a few install steps, you'll be ready to go! Behind the scenes, Thunderbird is using many different packages to make everything work the way it does. Some of these include:

* Symfony Console
* Parsedown
* Laravel Blade
* Symfony Filesystem

## Useful Links
* [Website](https://thunderbird.netlify.com/)
* [Discord](https://discord.gg/sxkrycQ)

# Documentation

## Installation

1. You'll need to install [PHP](http://php.net/downloads.php) and the [Composer package manager](https://getcomposer.org/download/).
2. Next, clone thunderbird from Git `git clone https://github.com/ThunderbirdSSG/Thunderbird.git your-site`
3. Change into your site directory `cd your-site`
4. Install composer and node dependencies `composer install && npm install`
5. Copy `sample.env` to `.env`. Change any settings which you need to change
6. Build the site `php thunderbird build`

*Currently, you'll need to use your own web server, like Laravel Valet in order to see your site.*

## Community

If you want to ask any questions about Thunderbird, we'd love it if you'd join our [Discord server](https://discord.gg/QVYkSGs).

### Contributions

If you find something in Thunderbird you want to change, feel free to fork the project, make your change and then make a pull request to merge your changes.

#### Pull requests

* If you'd like to make propose two different changes, please submit two pull requests.
* Please include reasoning for your change in your pull request.

#### Issue tracking

If you find a bug within Thunderbird or something that's not best practice, feel free to create an issue. We'll hopefully get round to adding it.

## Enviroment Variables

We allow you to set enviroment variables on your site. This helps you set settings which change enviroment to enviroment. At the moment, these files also act as your settings file.

At installation, you will be required to copy the `sample.env` file to `.env`. Then you can change your site settings. Thunderbird currently has the below enviroment variables.

* `SITE_NAME` => your chosen site name
* `SITE_URL` => your chosen site url, we recommend just using `/`.
* `OUTPUT_DIR` => The directory where you wish for your build site files to go, we recommend the `dist` directory. (If you change this from `dist`, you'll need to change your publish directory - step 5)
* `CONTENT_DIR` => The directory where your content lives. Basically, your markdown files. We recommend using the `content` directory.
* `VIEWS_DIR` => The directory where your Blade views should be. Out of the box we use `resources/views`.

**If you don't create your own `.env` file, then we will just use the `sample.env` file. This means that if you don't have either the `.env` or `sample.env` files then Thunderbird won't function.**

## Commands

### Build

In order to build your site, you need to run `php thunderbird build`. The command usually takes a few seconds on a small site.

By default, your site will be built to the `dist` directory. You can change this in your enviroment variables.

## Local Dev Servers

We currently recommend using a Local Web Server like Laravel Valet, for Mac. Although, Valet also has unofficial ports for Windows and Linux too.

### Laravel Valet

Once you've completed the installation instructions, head into your site directory and go into the `dist` directory in a Terminal. Run the following command `valet link [subdomain]`. This will allow you to visit your Thunderbird site at `[subdomain].test`.

## Assets

We refer to images, videos etc as 'Assets'.

We recommend that your assets are stored in the `dist/assets` directory. You can arrage this however you want, it's up to you!

### Styles and Scripts

Stylesheets and Javascript files should be kept inside the `resources` directory. 

We've setup Laravel Mix, which is a popular wrapper for Webpack to compile your CSS and JS files and put them in your `dist` directory. You'll need to compile these assets seperatly using one of these commands.

* `npm run dev` - Produces unminified files
* `npm run watch` - Watches for changes to files and produces unminified files
* `npn run prodiction` - Produces minified files

We've also setup PurgeCSS which will look out for any un-used classes and remove them from the stylesheet. This helps your site's preformance.

TailwindCSS and Vuejs are pre-installed with Thunderbird. If that's not what you want to use, feel free to rip out all of the front-end stuff and replace it with whatever you want to use.

## Content

All content should be in markdown files within the `content` directory. At build time they will be converted to HTML files and accessible by their slugs.

For example: a `content/hello-world.md` file would be converted to `dist/hello-world.html`. 

Depending on your web server, you may need to specify the `.html` file extentions. 