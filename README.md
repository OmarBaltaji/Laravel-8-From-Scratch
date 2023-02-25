## Start Project

- Create database on your local machine. example name "blog"
- Place your credentials and database name in .env
- Set up mailchimp by inserting the mailchimp key and id into the following variables respectively: <br>
  <code>MAILCHIMP_KEY</code> <br>
  <code>MAILCHIMP_LIST_SUBSCRIBERS</code>
- In the command line, cd to project directory and run migration with seed using command: <br>
  <code>php run migration -seed</code>
- On the same command line, serve the project by running: <br>
  <code>php artisan serve</code>