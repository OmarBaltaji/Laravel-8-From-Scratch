## Start Project

Here are the steps to setup the project locally:<br>
- Install the dependencies
  <pre>
    <code>composer install</code>
  </pre>
- Create database on your local machine. example name "blog"
- Copy .env.example and rename it to .env and then place your credentials and database name in it
- Set up mailchimp by:
  - Registering for a free mailchimp account on https://mailchimp.com/pricing/marketing/ 
  - Login to mailchimp and go to Account & Billing -> Extras -> API Keys -> Create New Key
  - Copy the API key and paste it into the .env variable: <code>MAILCHIMP_KEY</code>
  - Next go to Audience -> Settings -> Audience name and defaults.<br>
    Copy the Audience ID and paste it into the .env variable: <code>MAILCHIMP_LIST_SUBSCRIBERS</code>
- In the command line, cd to project directory and run migration with seed using command: <br>
  <pre>
    <code>php run migration -seed</code>
  </pre>

- On the same command line, serve the project by running: <br>
  <pre>
    <code>php artisan serve</code>
  </pre>