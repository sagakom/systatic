# Contributor Guide

We welcome all contributions from anyone. You can contribute to anything, the code, the documentation, issues.

## How to Get Started

There's lots of things you could contribute to:

* Submitting new feature requests
* Submitting bug reports 🐛
* [Helping with the documentation](https://github.com/damcclean/systatic.netlify.com) - adding new features, making design changes, fix spelling/grammar mistakes
* Writing tests
* Contributing on issues
* Helping other people (Github Issues, Discord)
* Telling others about it
* Blogging about Systatic

## 💻 Getting Systatic Setup locally for Contributing

1. **Clone the project**

```
git clone git@github.com:damcclean/systatic.git
cd systatic
```

2. **Install Composer dependencies**

```
composer install
```

3. **Create another directory to test the dev version**

```
mkdir systatic-dev && cd systatic-dev
```

4. **Use the local dependency** by creating a new `composer.json` file with the following contents.

```
{
    "require": {
        "damcclean/systatic": "@dev"
   },
   "repositories": [
        {
            "type": "path",
            "url": "../systatic"
        }
   ]
}
```

5. **Install composer dependencies again**

```
composer install
```

## Code Standard

* Must follow **PSR-2 Coding Standard**
* If you can, **write tests** to cover the code you've written!
* **Update [the documentation](https://github.com/damcclean/systatic.netlify.com)** if you change how things work or add any features.
* **Don't make any breaking changes** unless you're contributing to a new version.
* **One feature per PR** - Please only make one pull request for each of the features/bug fixes you're making