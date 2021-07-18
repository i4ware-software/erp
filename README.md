# erp

This an ERP solution.

INSTALL:

On Windows

Copy/paste application/configs/session.dist.ini to senssion.ini and application/configs/config.dist.xml to config.xml

Modify config.xml like set database password

Create folders:

application/reports
application/reports/maksatus
application/reports/payments
application/uploads
application/uploads/agreements
application/uploads/certificates
application/uploads/courseagreements
application/uploads/cvs
application/uploads/ostolaskut
application/uploads/taxcards
application/uploads/timesheets

Run erp.sql to MySQL database and then login with username admin@yourdomain.tld and password admin

On Linux

Copy/paste application/configs/session.dist.ini to senssion.ini and application/configs/config.dist.xml to config.xml

Chmod 777 folder application/log

Create/chmod 777 folowing folders

application/reports
application/reports/maksatus
application/reports/payments
application/uploads
application/uploads/agreements
application/uploads/certificates
application/uploads/courseagreements
application/uploads/cvs
application/uploads/ostolaskut
application/uploads/taxcards
application/uploads/timesheets

Run erp.sql to MySQL database and then login with username admin@yourdomain.tld and password admin