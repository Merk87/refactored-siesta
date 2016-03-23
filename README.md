# GoustoAPI
Author: Victor Moreno Alhambra (AKA Merkury)

Creation of an API to manage the different recipes stored in a CSV file.
This file contains all the necessary information to test satisfactorily the solution

# Why, how, whaaaaaat?

To develop the proposed test I decided to use **Symfony2** for several reasons, the most relevant are:

* I feel really, really confortable working with Symfony2, so I know what to do, where and how faster than if I were using any other framework.
* Symfony2 offers out-of-the-box all the necessary tools and resources to build nice APIs.
* Also Symfony2 has a lot of potential to keep working if some day I want to reuse this same exercise to do something funnier or experimental
* Because, why not?

About the question how my solution will cater for different API consumers, well I think that I'm not going to say anything new, but I probably 
I will implement an autodetection of the used device to do the request, and then adapt the content to the client.
Also to improve the performance and the response speed I will create a cache (based on redis most likely) with the recipe information.

# Requirements
* PHP v5.6
* Composer

# Installed bundles:
* Symfony Finder.
    * Used to manage the csv files.
* PHPUnit Testing
* Symfony VarDumper
   
To run the project, first run `composer install` to get all the vendor bundles
    
# Application routes:

* Fetch a recipe by id
    *`/api/get/id/{id}`*
* Fetch all recipes for a specific cuisine (should paginate)
    *`/api/get/id/{id}`*
* Rate an existing recipe between 1 and 5
    * **GET** Version: `/api/set/rating/{id}/{rating}`
    * **POST** Version: `/api/set/rating`
* Store a new recipe
    *`/api/add/recipe`*
        *If you pass the id property to this function, it will be ignored*
* Update an existing recipe
    *`/api/update/recipe`*

## Consideration for the post functions.

This CSVModel that controll the interaction between the Entity Model and the CSV file, 
was designed with the intention of keeping certain amount of abstraction so, basically 
in order to create/update recipes you should provide an associative array matching 
properties with snake_case naming on it.

This will be a full valid array for updating:
```
    array (
      'id' => '1',
      'created_at' => '30/06/2015 17:58:00',
      'updated_at' => '20/03/2016 16:31:19',
      'box_type' => 'vegetarian',
      'title' => 'Sweet Chilli and Lime Beef on a Crunchy Fresh Noodle Salad',
      'slug' => 'sweet-chilli-and-lime-beef-on-a-crunchy-fresh-noodle-salad',
      'short_title' => '',
      'marketing_description' => 'Here we've used onglet steak which is an extra flavoursome...' 
      'calories_kcal' => '401',
      'protein_grams' => '12',
      'fat_grams' => '35',
      'carbs_grams' => '0',
      'bulletpoint1' => '',
      'bulletpoint2' => '',
      'bulletpoint3' => '',
      'recipe_diet_type_id' => 'meat',
      'season' => 'all',
      'base' => 'noodles',
      'protein_source' => 'beef',
      'preparation_time_minutes' => '35',
      'shelf_life_days' => '4',
      'equipment_needed' => 'Appetite',
      'origin_country' => 'Great Britain',
      'recipe_cuisine' => 'asian',
      'in_your_box' => '',
      'gousto_reference' => '59',
      'rating' => 144,
      'display_rating' => 4,
      'total_ratings' => '36',
    );
```

# Testing
The solution implements a really, really basic set of unit test, can be executed from the app folder.

# Final considerations

I hope you found satisfactory this solution, and we can have a chat soon!

Thanks.

Victor Moreno.


