# Thunderbird

Thunderbird is a fast and lightweight Static Site Generator (SSG) built in PHP.

# Documentation

## Installation

1. You'll need to install [PHP](http://php.net/downloads.php) and the [Composer package manager](https://getcomposer.org/download/).
2. Next, clone thunderbird from Git `git clone https://github.com/damccclean/Thunderbird.git your-site`
3. Change into your site directory `cd your-site`
4. Install composer dependencies `composer install`
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

## Commands

### Build

In order to build your site, you need to run `php thunderbird build`. The command usually takes a few seconds on a small site.

By default, your site will be built to the `dist` directory. You can change this in your enviroment variables.

## Local Dev Servers

We currently recommend using a Local Web Server like Laravel Valet, for Mac. Although, Valet also has unofficial ports for Windows and Linux too.

### Laravel Valet

Once you've completed the installation instructions, head into your site directory and go into the `dist` directory in a Terminal. Run the following command `valet link [subdomain]`. This will allow you to visit your Thunderbird site at `[subdomain].test`.

## Deploying

We recommend using Netlify for hosting your Thunderbird site.

### Netlify

By default, we have a `netlify.toml` file in the repository which has all of the settings pre-configured to make it simple to deploy.

However, if you've deleted that file, here are the settings you'll want to configure to get started on Netlify.

1. Upload your site to Github
2. Login to Netlify and create a site.
3. Link the site up to your Github repository.
4. Set your build command as `composer install | php thunderbird build`
5. Set your publish directory as `dist`
6. Once you've done that, you'll want to go Build and Deployment settings.
7. Now, setup enviroment variables, for Thunderbird to work you'll need the following: `PHP_VERSION` => `7.2`.
    * `PHP_VERSION` => `7.2`
    * `SITE_NAME` => your chosen site name
    * `SITE_URL` => your chosen site url, we recommend just using `/`.
    * `OUTPUT_DIR` => The directory where you wish for your build site files to go, we recommend the `dist` directory. (If you change this from `dist`, you'll need to change your publish directory - step 5)
    * `CONTENT_DIR` => The directory where your content lives. Basically, your markdown files. We recommend using the `content` directory.
8. Deploy your site again, and you should be good!

**Even if you're using our provided `netlify.toml` file, you may still need to follow Steps 7 and 8 to set the version of PHP used by Netlify.**

## Assets

We've got everything setup so that any files within the `assets` directory will be copied over to the `dist` directory at build time.

We recommand you put all of your images, scripts and styles in this directory.

## Content

All content should be in markdown files within the `content` directory. At build time they will be converted to HTML files and accessible by their slugs.

For example: a `content/hello-world.md` file would be converted to `dist/hello-world.html`. 

Depending on your web server, you may need to specify the `.html` file extentions. 