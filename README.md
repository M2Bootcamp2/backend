# backend

Form module created for the FRISSR Webdev bootcamp

Installation notes:

- make directory in (magento root)/app/code called Frissrmod
- clone repository in this folder
- in magento root:
    - php bin/magento setup:upgrade
    - php bin/magento setup:di:compile
    
Module should be visible under http://example.com/evaluation-form/

Module configuration can be done in the admin backend
  - mail template can be created in the menu marketing>email templates
  - module configuration can be modified under stores>configuration>general>frissr formulier
