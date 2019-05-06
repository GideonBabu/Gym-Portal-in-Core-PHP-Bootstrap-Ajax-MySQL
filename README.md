# Gym-Portal-in-Core-PHP-Bootstrap-Ajax-MySQL
This is a online portal for Gym members to use their daily workout plans. Written in core PHP/Bootstrap/AJAX and MySQL

On the interactive web page, gym member can:
- create
- load
- Edit
- Delete

his/her workout plans

A plan has a name and consists of several (workout) days
A day can have multiple exercises that you should perform that day.
A plan can be assigned to one or more user(s)

A user is an entity with personal data (firstname, lastname and email)
A user can be added/edited/deleted.

Whenever an user is assigned to a workout plan, (s)he should receive an email confirmation.
Whenever a plan is modified/deleted, the user(s) connected should be notified of the change by email.

Saving on each mutation (AJAX calls to RESTful JSON API's, when users adds/removes an exercise to a day, changes the name of the day, etc.,
