# DISCOEAT

- Install dependencies (composer install)
- Rename .env file
- There is a postman collection with the route provided to send e-mails
- start server (php -S localhost:8000 -t public)
- I've provided 2 different templates, 'Default' and 'Another'

**Bonus questions:**

- sometimes email delivery can take a long time (> 5 seconds), what can be done to make
 it faster?
 > There are some options: 
 > - Use a well defined queue system.
 > - Use a dedicated smtp server.
 
 - What are the downsides of your solution?
 > - I'm not using a proper queue driver
 > - Should be more testable
 > - Should use a full customized theme builder
 > - Should create a "mail" validator to cover all expected parameters
 > - Better error handling
 > - Not implemented the attachment handler
 > - Could dockerize the entire application
 
 - We’d like to add as many product themes as possible, how would you structure a service
   with this requirement?
 > I can imagine 2 better ways to handle this (since the templates should not stay inside this service):
 > - Create a tagged lib (like disco-mailer) and install it via composer. So, every time you need a new template, just commit on disco-mailer master and you will download it on your jenkins pipeline.
 > - Use a DB to store the templates (with cache), just passing the variables you gonna use on it.
 
 
 **Considerations:**
 I've tried to stick to this 1-2 hours "rule" of my time. I hope you guys like it and if you have any suggestions/comments or just want to know more about the solution, please do let me know.  