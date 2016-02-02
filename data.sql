INSERT INTO commands (command,description,cat_id)
VALUES ('usermod -c "Mr Anderson"','Modify the GECOS field of an account','7'),
       ('usermod -L neo','Lock the account','7'),
       ('usermod -U neo','Unlock the account','7'),
       ('userdel -r neo','Delete the user including the home directory','7'),
       ('chfn neo','Change real username and information','7'),
       ('chsh neo','Change the login shell','7'),
       ('passwd neo','Change the user password','7'),
       ('passwd -l neo','Another way to lock the account','7'),
       ('passwd -S neo','`Get information about a user account.
Prints username and account status (L=locked, P=password, NP=no password), date of last password change, min age, max age, warning period, inactivity period in days`','7');
