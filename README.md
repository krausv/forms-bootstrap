Forms bootstrap renderer for Nette Framework
=============================

Installation
------------

```sh
composer require krausv/forms-bootstrap
```

Usage
-----

```php
use Krausv\Form\Renderer\BootstrapRenderer;
use Nette\Application\UI\Form;

$form = new Form;
$form->setRenderer(new BootstrapRenderer);
