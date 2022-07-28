##Resource management system

### How to setup
- Create a database for resource management e.g: resources.
- Rename ```.env.example``` to ```.env``` and make necessary changes for database connection.
- Run ```composer install``` command from terminal to install composer packages.
- Run ```php artisan key:generate``` command from terminal.
- Run ```php artisan storage:link``` for upload purpose.
- Run ```npm install``` command from terminal to install npm dependencies.

Finally, if everything is okay we are ready to use our application. From the project directory run ```php artisan serve``` and ``` npm run dev```. Now get back to the browser enter ```APP_URL``` you are done.

Run the tests by ```php artisan test```

Note: You can see env.example for ```.env``` configurations. 
