
# Why 2 .sql files
When exporting the database 'and_action' with the tables and records,
a Linux only collation (utf8mb4_0900_ai_ci) was exported with it.

Since Windows does not support this collation type, another collation has been created
for Windows systems (utf8mb4_general_ci)

--- 
The .sql file can be directly imported, it will create a

* Database (if not exists)
* Multiple Tables
* Multiple Columns within the tables, together with relations between primary and foreign keys
* Column values


