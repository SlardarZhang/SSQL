# SSQL
### Version 1.0
Use MySQLi to connect MySQL database by a easy way.
# Functions
## Construct
### Using:
1. new SSQL("FILENAME"); 
````
Load configuration from file.
````
2. new SSQL(DATABASE_SERVER_ADDRESS, USERNAME, PASSWORD, SCHEMA);
```` 
Configure by variable.
````
## Set_charset
### Using:
```
SSQL->set_charset("CHARSET"); Set charset for reading and writing data.
```
## Query
### Using:
```
SSQL->query("SQL"); Execute SQL statement.
```
# Configure file
````
Configure file should have 4 lines
````
1. Database server address(IP address or domain)
2. Username
3. Password
4. Schema
# Using Example
* SSQL->query("INSERT INTO table_name(a,b,c,d) VALUES(?,?,?,?);" , "idsb", 32, 1.23, "String", NULL );
- SSQL->query("SELECT * FROM table_name");
* SSQL->query("UPDATE table_name SET a=? WHERE b=?" , "id", 32, 64.64);
- SSQL->query("DELETE * FROM table_name WHERE c=?" , "s" , "String");

## Description
```
For the secound arguments bind character(EX1)
Character	Description
i	corresponding variable has type integer
d	corresponding variable has type double
s	corresponding variable has type string
b	corresponding variable is a blob and will be sent in packets
```
* Any DELETE, UPDATE, INSERT can use SSQL->affected_rows get affected rows.
- SSQL->datatable[x][y];
````
Get result of SELECT.
X means the row.
Y means the column. Y also can use column name replace.
````
* SSQL->columnnames
````
Get all the columns of the SELECT result.
````
- SSQL->row_num
````
Get the row number of SELECT result.
````
- SSQL->column_num
````
Get the column number of SELECT result.
````
## Error
* SSQL->error(TRUE);/SSQL->error(FALSE);
````
Get the error of any step.
TRUE will return the detail of the error.
````
## Reconnect
* SSQL->reconnect(DATABASE_SERVER_ADDRESS, USERNAME, PASSWORD, SCHEMA);
````
Reconnect by new arguments. It can change SSQL connect to another server or schema.
````
## Error Codes
```
0x0000 Construct error, number of arguments error.
0x0001 Database connect error.
0x0002 Query error.
0x00020 Unknow SQL.
0x00021 Something wrong while execute the SQL(SQL without any bind arguments).
0x00022 SQL bind arguments error.
0x00023 Arguments type error.
0x00024 Something wrong while execute the SQL(SQL with any bind arguments).
0x00025 All kinds of exception will cause this error.
```
