About Cool Console
=====

This is a module that helps building a more nice interface when the ZF2 application is running in console view.
At this stage it's still in the beta stage and need a lot of improvements, like more advanced selectors lists and more.

Installation
-----

### Main Setup


#### With composer

1. Add this project and [KryuuCoolConsole](https://github.com/KatsuoRyuu/KryuuCoolConsole) in your composer.json:

    ```json
    "require": {
        "katsuo-ryuu/kryuu-cool-console": "dev-master"
    }
    ```

2. Now tell composer to download KryuuCoolConsole by running the command:

    ```bash
    $ php composer.phar update
    ```
Creating a simple view
-------------------------------------

**NOTICE** The system currently only have one view type "grid"

    ```
    <?php
        
        // Create a new view
        $view = new Grid();
        
        // Create a nice box with a padding of 1 and a margin of 1
        // and make it with double borders
        $box = new Box(1,1, Border::BORDER_DOUBLE);
        
        // Setting the background color  of the box
        $box->setBgColor(Color::BC_MARINE);
        
        // Create a selection list
        $choiseList = new ChoiceList();
        // Setting the items in the selection list
        $choiseList->setItems(['item 1', 'item 2', 'item 3']);
        // Adding a nice headline to the list
        $choiseList->setHeadline('Please select an item');
             
        // Add the choice list to the box container
        $box->addChild($choiseList);
        // Add the box to the grid view
        $view->addChild($box);
        // show the actual view in the terminal
        $view->show();
    ```
