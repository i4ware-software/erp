# erp

This an ERP solution.

INSTALL:

On Windows

Copy/paste zf/application/configs/session.dist.ini to senssion.ini and zf/application/configs/config.dist.xml to config.xml

Modify config.xml like set database password

Create folders:

zf/application/reports
zf/application/reports/maksatus
zf/application/reports/payments
zf/application/uploads
zf/application/uploads/agreements
zf/application/uploads/certificates
zf/application/uploads/courseagreements
zf/application/uploads/cvs
zf/application/uploads/ostolaskut
zf/application/uploads/taxcards
zf/application/uploads/timesheets

Run erp.sql to MySQL database and then login with username admin@yourdomain.tld and password admin

On Linux

Copy/paste zf/application/configs/session.dist.ini to senssion.ini and zf/application/configs/config.dist.xml to config.xml

Chmod 777 folder application/log

Create/chmod 777 folowing folders

zf/application/reports
zf/application/reports/maksatus
zf/application/reports/payments
zf/application/uploads
zf/application/uploads/agreements
zf/application/uploads/certificates
zf/application/uploads/courseagreements
zf/application/uploads/cvs
zf/application/uploads/ostolaskut
zf/application/uploads/taxcards
zf/application/uploads/timesheets

Run erp.sql to MySQL database and then login with username admin@yourdomain.tld and password admin
