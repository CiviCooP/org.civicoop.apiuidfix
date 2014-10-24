org.civicoop.apiuidfix
======================

When a rest call is made the User ID is not stored into the session. Altough we have User ID from the api_key parameter. Usually this is not a big deaul but when you want to update a contribution status from pending to completed CiviCRM will try to create an Activity, however there is no user in the session so it is unclear who the activity created (source contact).

This extension is an API wrapper which checks wether it is a rest call and wether the user isn't set yet. It will then lookup the user by the given api key and stores that Contact ID into the session.
