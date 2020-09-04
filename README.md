# UB Arbeitsplatzbuchung

[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://github.com/tuub/platzbuchung/graphs/commit-activity)

This tool was written for handling restricted access during the COVID-19 pandemic and to support 
the booking of working spaces per location for clients.

It supports:
- different resources, e.g. locations, floors, each with their own possible capacity numbers
- different time slots per resource
- display of a configurable date range
- booking limits per user
- a rolling opening for new bookings (which is the current date + a configurable value from configuration)

## DISCLAIMER
**This tool might not work for you out-of-the-box!** 

Due to the tight schedule, we were not able to turn it into a full-featured and polished shiny end product.
Especially the authentication system is tailored to serve the needs of our institution. The underlying 
framework - [Laravel](https://laravel.com/) - makes it pretty easy though to roll your own authentication or even go 
with the built-in solution. See "Authentication" for details.

Also, some things in the JavaScript part are a bit cumbersome and there should be some more cleanup in files and code structure.

## See it in action
https://services.ub.tu-berlin.de/platzbuchung/

## Requirements
- PHP 7.2
- Database
- npm
- the will and time to adjust some things ;)

## Webserver
Entry point for the application is `public/index.php`. Your webserver config should point to this location.

## Migration from 1.0 to 1.1
In order to use the introduced locations in version 1.1, you have to add your
* locations
* resources
* time slots

via administration and then run `php artisan platzbuchung:upgrade` from the application root path.

## Installation
First you install the application by running: `composer install`.

You will then need to add an `.env` file with your configuration. A boilerplate config file is provided as `.env.example`. Just do a simple `cp .env.example .env
` and tweak it to your needs.

### Configuration options
| Option | Purpose| Example |
|---|---|---|
| APP_NAME | The title of the app | "Buchungssystem für Arbeitsplätze" |
| APP_OWNER | The owner of the app, used in confirmation mail | "Universitätsbibliotheken der TU und UdK" |
| APP_ENV | Whether the app shows detailed errors or not | local/production |
| APP_KEY | Leave empty. Set by the application in the next installation step | Hash value |
| APP_DEBUG | Whether the app shows detailed errors or not | false |
| APP_URL | The base URL of the application | https://example.org/platzbuchung |
| APP_VERSION | The current version of the app  | 1.1 |
| APP_LOGO | The path to the logo file | images/logo.svg (points to public/images directory) |
| TELESCOPE_ENABLED | Whether the debug tool Telescope" should be available under &lt;APP_URL&gt;/telescope | false
| AUTH_ENDPOINT | Our external authentication server | "https://external.auth.webservice"
| AUTH_METHOD | Authentication type | possible: "alma", "paia" (GBV), "eloquent" (laravel built-in authentication system)
| REPORT_PROCESS_SERVER_HOST | Remote processing server host without protocol, for SCPing the user report (see below) | "remote.process.server" |
| REPORT_PROCESS_SERVER_USER | Remote processing server SSH user, for SCPing the user report (see below) | "remote.process.server.ssh.user" |
| REPORT_PROCESS_SERVER_FILE_PATH | Remote processing server file path, for SCPing the user report (see below) | "/filepath/at/remote/process/server.txt" |
| STATS_REPORT_SUBJECT | Mail subject for daily statistics (see below) | "Tagesstatistik Buchungssystem" |
| STATS_REPORT_RECIPIENT | Mail recipient(s) for daily statistics (separate multiple with comma) | info@example.org |
| LOG_CHANNEL | The default channel, pointing to &lt;APP_DIR&gt;/storage/logs/laravel.log | stack |
| DB_CONNECTION | Your database engine, check out [supported drivers](https://laravel.com/docs/7.x/database) | mysql |
| DB_HOST | Your database host | 127.0.0.1 |
| DB_PORT | Your database port | 3306 |
| DB_DATABASE | Your database name | platzbuchung |
| DB_USERNAME | Your dedicated database user | groot |
| DB_PASSWORD | Your dedicated database user's password  | gr00t! |
| MAIL_MAILER | Your mail driver, check out [supported drivers](https://laravel.com/docs/7.x/mail) | smtp |
| MAIL_HOST | Your mail server | localhost  |
| MAIL_PORT | Your mail server port | 587 |
| MAIL_USERNAME | Your mail server user | groot |
| MAIL_PASSWORD | Your mail server user's password | gr00t! |
| MAIL_ENCRYPTION | Your mail server encryption type | tls |
| MAIL_FROM_ADDRESS | Sender email address for confirmation mails | info@example.org |
| MAIL_FROM_NAME | Sender name for confirmation mails | "Buchungssystem" |

After setting everything up, do this:
````
php artisan key:generate
php artisan jwt:secret
php artisan migrate

npm install
npm run prod
````

## Authentication
We query an external webservice for authentication via TLS-secured CURL. Due to GDPR 
we only save the user data that is absolutely needed for running the application in the 
application database. Custom authentication drivers are 
* [app/Auth/AlmaUserProvider.php](app/Auth/AlmaUserProvider.php)
* [app/Auth/PaiaUserProvider.php](app/Auth/PaiaUserProvider.php) (contributed by [Tobias Zeumer](https://github.com/tzeumer))

Chances are big that you'll use another road here. Laravel framework 
provides a convenient way for adding custom-tailored authentication 
[which is described here](https://laravel.com/docs/7.x/authentication). 

Even Shibboleth authentication is possible. We've already done it successfully in the past and
in another project with [this library](https://github.com/razorbacks/laravel-shibboleth).

### Built-in authentication
You could also use the built-in authentication system with local database 
tables as the main source. This even provides scaffolding so you should be 
ready to go in no time.

1. In [.env](.env.example), set `AUTH_METHOD` to 'eloquent'
2. You will need to put back the password field to the users table (which we removed). Just create a new migration:
    ````
    php artisan make:migration add_password_to_users
    ````
    This creates a new file inside [database/migrations](database/migrations) directory, where you put the following:
    ````
    [...]
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password');    
        });
    }
    [...]
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
    ````
3. [Check out the documentation for scaffolding](https://laravel.com/docs/7.x/authentication)

## Frontend assets compilation

### JavaScript
The frontend is written in Vue2, a reactive JavaScript framework which interacts via API methods with the Laravel backend.
- The entry point for development is [resources/js/app.js](resources/js/app.js)
- After compilation you have one target file: [public/js/app.js](public/js/app.js)

### CSS
The styles are written in SASS, a CSS pre-processor.

- The entry point for development is [resources/sass/app.scss](resources/sass/app.scss)
- After compilation you have one target file: [public/css/app.css](public/css/app.css)

### Compilation
Fire up the following command:
````
npm run [dev/prod]
````
The `dev` option compiles the files to rather verbose target versions. The `prod` option generates minified target versions for better performance.  

For convenient development you can also use `npm run watch` which detects changes on the source files and compiles it on-the-fly.

## Logo
Your logo should go to `public/images`. We use a SVG version for better scaling. After placing your logo file you have to reference it in the `.env`file with the `APP_LOGO`option.

## i18n
All texts are defined in  in form of a PHP array.

* German: [resources/lang/de/app.php](resources/lang/de/app.php)
* English: [resources/lang/en/app.php](resources/lang/en/app.php). 

But: There is currently no switcher in the frontend. You can switch the language app-wide in 
[config/app.php](config/app.php) with the config option `lang`.

Since the frontend also relies on these you have to run the following after making adjustments to the texts:
````
php artisan vue-i18n:generate
npm run prod
````

## Checkin / Checkout
There are 2 screens prepared for usage on dedicated screens:

- <YOUR_APPLICATION_URL>/checkin/<LOCATION_UID>
- <YOUR_APPLICATION_URL>/checkout/<LOCATION_UID>

In our institution they run in 2 workstations with kiosk browser installed and a hand scanner attached
which scans the barcode of the library card. Of course, The screens can also be used on a regular helpdesk 
computer in a browser, operated by a staff member.

The check-in validates if there is a currently valid booking present. The check-out validates if 
there was an check-in before.

## Administration
There is an administration panel available for configured users. For now, you have to alter the
database user record and set the `is_admin` column value to `true`. The admin area is then available via `<APP_DOMAIN>/#/admin/locations`. 

In a future release, it will be included in the navigation for configured users.

The booking system relies on 
1. Location(s)
2. Resources within each location
3. Time slots within each resource for each day

This allows for granular access control. You start with the locations and then progress to resources and time slots.

You can date-constraint time slots to support successive extension of opening times.

You can also specify closings: Single dates or date ranges are possible.

## Maintenance Commands

### User report
In case of a COVID-19 infected client or a zombie apocalypse, this is the command to run:
````
php artisan platzbuchung:user-report <LOCATION_UID> <DATE>
````
In our case, it assembles a separated list of checked-in users for a given location UID (e.g. 'zb', see administration) and a given date 
from the application database which is then sent to another server for enrichment with
other personal data (which we don't store due to privacy reasons). Check out 
[app/Console/Commands/GenerateUserReport.php](app/Console/Commands/GenerateUserReport.php) 
for adjustments.

### Daily stats
````
php artisan platzbuchung:daily-stats <LOCATION_UID>
````
Uses the internal scheduler. Always uses the current date and a given location UID (e.g. 'zb', see administration). Sends a mail to the configured recipient(s), see above. Best used with a cron job like this:
````
* * * * * cd /your/application/directory && php artisan schedule:run >> /dev/null 2>&1
````

## To Do
- Auto delete of checkins an booking data after x weeks
- Webpack optimizations for smaller frontend asset files
- Docker version

## Shout outs
- [Tobias Zeumer](https://github.com/tzeumer) for providing the PAIA authentication
