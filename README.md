# SSQL
### Version 2.0
````
PHP connect to MySQL / Microsoft SQL Server / MongoDB / Oracle / PostgreSQL by a easy way!
````
<!--ts-->
   * [Json configure file Keys](#c_config)
      * [type](#c_type)
      * [host](#c_host)
      * [username](#c_username)
      * [password](#c_password)
      * [schema](#c_schema)
      * [report_error](#c_report_error)
      * [port](#c_port)
      * [timeout](#c_timeout)
      * [charset](#c_charset)
      * [SSL](#c_SSL)
      * [verify_certificate](#c_verify_certificate)
      * [use_cursor](#c_use_cursor)
      * [mysql_auth](#c_mysql_auth)
      * [mysql_ca_file](#c_mysql_ca_file)
      * [mssql_auth](#c_mssql_auth)
      * [mongodb_auth](#c_mongodb_auth)
      * [mongodb_auth_db](#c_mongodb_auth_db)
      * [mongodb_sql_mode](#c_mongodb_sql_mode)
      * [mongodb_ssl_ca_dir](#c_mongodb_ssl_ca_dir)
      * [mongodb_ssl_ca_file](#c_mongodb_ssl_ca_file)
      * [mongodb_ssl_ca_crl_file](#c_mongodb_ssl_ca_crl_file)
      * [mongodb_ssl_allow_self_signed](#c_mongodb_ssl_allow_self_signed)
      * [mongodb_ssl_pem_file](#c_mongodb_ssl_pem_file)
      * [mongodb_ssl_pem_pwd](#c_mongodb_ssl_pem_pwd)
      * [postgresql_ssl](#c_postgresql_ssl)
      * [postgresql_ca_file](#c_postgresql_ca_file)
      * [postgresql_language](#c_postgresql_language)
   * [SSL Settings](#ssl_settings)
      * [MySQL](#mysql_ssl_detial)
      * [Microsoft SQL Server(MSSQL)](#mssql_ssl_detial)
      * [MongoDB](#mongodb_ssl_detial)
      * [PostgreSQL](#postgresql_ssl_detial)
        * [SSL Mode Descriptions](#postgresql_ssl_mode_descriptions)
   * [Functions](#Functions)
      * [constructor](#constructor)
      * [query](#query)
        * [Execute SQL](#execute_sql)
        * [Execute SQL with placeholders](#execute_sql_placeholders)
          * [MySQL](#execute_sql_placeholders_mysql)
          * [MongoDB](#execute_sql_placeholders_mongodb)
          * [Microsoft SQL Server(MSSQL)](#execute_sql_placeholders_mssql)
          * [Oracle](#execute_sql_placeholders_oracle)
          * [PostgreSQL](#execute_sql_placeholders_postgresql)
      * [oracle_placeholder](#oracle_placeholder)
      * [get_result](#get_result)
      * [get_prev](#get_prev)
      * [get_next](#get_next)
      * [get_skip](#get_skip)
      * [move_prev](#move_prev)
      * [move_next](#move_next)
      * [skip](#skip)
      * [html_var_dump](#html_var_dump)
      * [version](#version)
      * [has_error](#has_error)
      * [get_errors](#get_errors)
      * [get_last_error](#get_last_error)
      * [clear_errors](#clear_errors)
      * [mongodb_query](#mongodb_query)
      * [mongodb_insert](#mongodb_insert)
      * [mongodb_update](#mongodb_update)
      * [mongodb_delete](#mongodb_delete)
      * [mongodb_id](#mongodb_id)
      * [free_cursor](#free_cursor)
      * [ping](#ping)

   * [MongoDB SQL Supporting](#MongoDB_SQL)
   * [Error data structure](#error_structure)
<!--te-->

----

<span id="c_config"></span>
# Json configure file Keys
````
Configure file is json format, key name is case sensitive.
````

<span id="c_type"></span>
## type
<details>
  <summary>Database type.</summary>

Value: `MySQL` or `MSSQL` or `Oracle` or `MongoDB` or `PostgreSQL`
<br>
Required: :heavy_check_mark:
````
Case insensitive, MSSQL means Microsoft SQL Server
````
</details>

<span id="c_host"></span>
## host
<details>
  <summary>Host address.</summary>

Value: `IP address` or `domain address`
<br>
Required: :heavy_check_mark:
````
Server host address, it can be IP address or domain name.
If you want to use SSL, it should be domain name.
````
</details>

<span id="c_username"></span>
## username
<details>
  <summary>Username for databse login.</summary>

Value: `Username`
<br>
Required: :heavy_check_mark:(`MongoDB` and `Microsoft SQL Server(MSSQL)` may excepted)
````
If you are using MongoDB, username can be empty or not set.
````
</details>

<span id="c_password"></span>
## password
<details>
  <summary>Password for databse login.</summary>

Value: `Password`
<br>
Required: :heavy_check_mark:(`MongoDB` and `Microsoft SQL Server(MSSQL)` may excepted)
````
If you are using MongoDB, password can be empty or not set.
````
</details>

<span id="c_schema"></span>
## schema
<details>
  <summary>Schema or database of using.</summary>

Value: `Schema name` or `Database name`
<br>
Required: :heavy_check_mark:
````
The database name of using.
````
</details>

<span id="c_report_error"></span>
## report_error
<details>
  <summary>Print errors to stand output.</summary>

Value: `TRUE` or `FALSE`
<br>
Required: :heavy_multiplication_x:
<br>
Default value: `FALSE`

````
Print errors to stand output.
````
</details>

<span id="c_port"></span>
## port
<details>
  <summary>The port number of databse using.</summary>

Value: `Integer [1-65535]`
<br>
Required: :heavy_multiplication_x:
<br>
Default value: `DEFAULT PORT NUMBER`(Based on database)

````
If it is not set, the under table port number will be using as default.
````
Databse|Default port number|Description
:----|:-----:|:-----
 MySQL | 3306 or 33060 | Based on authenticate mode and SSL. 
 MongoDB | 27017 | 
 Microsoft SQL Server(MSSQL) | 1433 | 
 Oracle | 1521 | 
 PostgreSQL | 5432 |
</details>

<span id="c_timeout"></span>
## timeout
<details>
  <summary>Timeout of connection.</summary>

Value: `Integer`
<br>
Required: :heavy_multiplication_x:
<br>
Default value: `10`

````
Default value is 10.
````
</details>

<span id="c_charset"></span>
## charset
<details>
  <summary>Charset of databse.</summary>

Value: `String`
<br>
Required: :heavy_multiplication_x:
<br>
Default value: `utf-8`

````
Not support for MongoDB and PostgreSQL.
````
</details>

<span id="c_SSL"></span>
## SSL
<details>
  <summary>Use SSL to connect database.</summary>

Value: `TRUE` or `FALSE`
<br>
Required: :heavy_multiplication_x:
<br>
Default value: `FALSE`

````
If value is TRUE, some keys may need be set.
````
[SSL Settgings](#ssl_settings)
</details>

<span id="c_verify_certificate"></span>
## verify_certificate
<details>
  <summary>Verify SSL certificate is valid or not.</summary>

Value: `TRUE` or `FALSE`
<br>
Required: :heavy_multiplication_x:
<br>
Default value: `FALSE`

````
If value is TRUE, some keys may need be set.
````
[SSL Settgings](#ssl_settings)
</details>

<span id="c_use_cursor"></span>
## use_cursor
<details>
  <summary>Use cursor or table to store result.</summary>

Value: `TRUE` or `FALSE`
<br>
Required: :heavy_multiplication_x:
<br>
Default value: `TRUE`
````
This setting will not effect get result summary values.
MongoDB only can use table to store result.
````
</details>

<span id="c_mysql_auth"></span>
## mysql_auth
<details>
  <summary>Use cursor or table to store result.</summary>

Value: `native` or `sha256` or `caching_sha2`
<br>
Required: :heavy_multiplication_x:

Default value is `native`.
```` 
This setting will not effect get result summary values.
MongoDB only can use table to store result.
````
</details>

<span id="c_mysql_ca_file"></span>
## mysql_ca_file
<details>
  <summary>Certificate Authority file.</summary>

Value: `Path of certificate Authority file`
<br>
Required: :heavy_multiplication_x:
```` 
Path of certificate Authority file, if [verify_certificate] and [SSL] are TRUE, then the CA file will be use verify the SSL certificate.
````
</details>

<span id="c_mssql_auth"></span>
## mssql_auth
<details>
  <summary>Microsoft SQL Server(MSSQL) authentication mode.</summary>

Value: `u` or `windows`
<br>
Required: :heavy_multiplication_x:
<br>
Default value is `u`.
<br>
`u`: Use username and password for authentication.
<br>
`windows`: Use current windows account for authentication.
````
Case insensitive.
For [windows] mode with IIS or some others, the service account will be use.
If use [windows] mode, [username] and [password] can be empty or unset.
````
</details>

<span id="c_mongodb_auth"></span>
## mongodb_auth
<details>
  <summary>MongoDB authentication mode.</summary>

Value: `none` or `u` or `u256` or `ldap` or `x509`
<br>
Required: :heavy_check_mark:(If using MongoDB)

Value|Authentication Mechanisms
:----|:----
`none`|No Login need.
`u`|SCRAM-SHA-1
`u256`|SCRAM-SHA-256 for authentication.
`ldap`|LDAP for authentication.
`x509`|x.509 for authentication.

````
Case insensitive.
````
</details>

<span id="c_mongodb_auth_db"></span>
## mongodb_auth_db
<details>
  <summary>MongoDB authentication databse.</summary>

Value: `Datbase Name`
<br>
Required: :heavy_multiplication_x:
<br>
Default value is `admin`.
````
You can specific database name for login.
This is only use for login, not access database.
````
</details>

<span id="c_mongodb_sql_mode"></span>
## mongodb_sql_mode
<details>
  <summary>Use SQL to access MongoDB or not.</summary>

Value: `TRUE` or `FALSE`
<br>
Required: :heavy_multiplication_x:
<br>
Default value is `FALSE`.
````
If you want to execute SQL statement, you can set this be [TRUE]
````
More details, please check [MongoDB SQL Supporting](#MongoDB_SQL)
</details>

<span id="c_mongodb_ssl_ca_dir"></span>
## mongodb_ssl_ca_dir
<details>
  <summary>SSL Certificate Authority Directory.</summary>

Value: `Certificate Authority Directory`
<br>
Required: :heavy_multiplication_x:
````
The full path of the directory containing the certification files that you use to verify the server. This setting enables the driver to access multiple certification files for SSL verification.
````
More details, please check [SSL Settings(MongoDB)](#mongodb_ssl_detial)
</details>

<span id="c_mongodb_ssl_ca_file"></span>
## mongodb_ssl_ca_file
<details>
  <summary>SSL Certificate Authority File.</summary>

Value: `Certificate Authority File`
<br>
Required: :heavy_multiplication_x:
````
Specifies the certification file that contains the root certificate chain from the Certificate Authority. Specify the file name of the certification file using relative or absolute paths.
````
More details, please check [SSL Settings(MongoDB)](#mongodb_ssl_detial)
</details>

<span id="c_mongodb_ssl_ca_crl_file"></span>
## mongodb_ssl_ca_crl_file
<details>
  <summary>The the file that contains the Certificate Revocation List.</summary>

Value: `Certificate Revocation List (CRL) File`
<br>
Required: :heavy_multiplication_x:
````
The the file that contains the Certificate Revocation List. Specify the file name of the file using relative or absolute paths.
````
More details, please check [SSL Settings(MongoDB)](#mongodb_ssl_detial)
</details>

<span id="c_mongodb_ssl_allow_self_signed"></span>
## mongodb_ssl_allow_self_signed
<details>
  <summary>Allow self signed certification or not.</summary>

Value: `TRUE` or `FALSE`
<br>
Required: :heavy_multiplication_x:
<br>
Default value is `FALSE`.
<br>
More details, please check [SSL Settings(MongoDB)](#mongodb_ssl_detial)
</details>

<span id="c_mongodb_ssl_pem_file"></span>
## mongodb_ssl_pem_file
<details>
  <summary>Specifies the certification file that contains both the TLS/SSL certificate and key.</summary>

Value: `Certification File Path`
<br>
Required: :heavy_multiplication_x:
````
Specifies the certification file that contains both the TLS/SSL certificate and key. Specify the file name of the certification file using relative or absolute paths.
````
<br>
More details, please check [SSL Settings(MongoDB)](#mongodb_ssl_detial)
</details>

<span id="c_mongodb_ssl_pem_pwd"></span>
## mongodb_ssl_pem_pwd
<details>
  <summary>The password to de-crypt the certificate-key file.</summary>

Value: `Password`
<br>
Required: :heavy_multiplication_x:
````
The password to de-crypt the certificate-key file, if the certificate-key file is encrypted. 
````
</details>

<span id="c_postgresql_ssl"></span>
## postgresql_ssl
<details>
  <summary>PostgreSQL SSL mode.</summary>

Value: `disable` or `allow` or `prefer` or `require` or `verify-ca` or `verify-full`
<br>
Required: :heavy_multiplication_x:
<br>
Default value is `prefer`.
````
Case insensitive.
````
More details, please check [SSL Settings(PostgreSQL)](#postgresql_ssl_detial)
</details>

<span id="c_postgresql_ca_file"></span>
## postgresql_ca_file
<details>
  <summary>Specifies the name of the file containing the SSL server certificate authority (CA).</summary>

Value: `Certificate Authority File`
<br>
Required: :heavy_check_mark:(If mode is `verify-ca` or `verify-full`)
````
Specifies the name of the file containing the SSL server certificate authority (CA). The default is empty, meaning no CA file is loaded, and client certificate verification is not performed. (In previous releases of PostgreSQL, the name of this file was hard-coded as root.crt.) Relative paths are relative to the data directory. This parameter can only be set at server start.
````
<br>
More details, please check [SSL Settings(PostgreSQL)](#postgresql_ssl_detial)
</details>

<span id="c_postgresql_language"></span>
## postgresql_language
<details>
  <summary>PostgreSQL Language.</summary>

Value: `PostgreSQL Language code`
<br>
Required: :heavy_multiplication_x:
<br>
Default value: `en_US.UTF-8`
<br>
More detials, please check <a href="https://www.postgresql.org/docs/9.4/locale.html" target="_blank">Locale Support</a>
</details>

---

<span id="ssl_settings"></span>
# SSL Settgings
Oracle SSL is not Supported.
The keys `SSL` and `verify_certificate` can be use for all of databases.

<span id="mysql_ssl_detial"></span>
### MySQL
<details>
  <summary>MySQL SSL Key.</summary>

Key|Value|Description
:----|:----:|:----
mysql_ca_file|`Path of Certificate Authority file`|The CA file will be use verify the SSL certificate.

</details>

<span id="mssql_ssl_detial"></span>
### Microsoft SQL Server(MSSQL)
````Not need other settings, Only `SSL` and `verify_certificate` need to set.````

<span id="mongodb_ssl_detial"></span>
### MongoDB
<details>
  <summary>MongoDB SSL Keys.</summary>

Key|Value|Description
:----|:----:|:----
mongodb_ssl_ca_dir|`Certificate Authority Directory`|The full path of the directory containing the certification files that you use to verify the server. This setting enables the driver to access multiple certification files for SSL verification.
mongodb_ssl_ca_file|`Certificate Authority File`|Specifies the certification file that contains the root certificate chain from the Certificate Authority. Specify the file name of the certification file using relative or absolute paths.
mongodb_ssl_ca_crl_file|`Certificate Revocation List (CRL) File`|Certificate Revocation List (CRL) file will be using for verification.
mongodb_ssl_allow_self_signed|`TRUE` or `FALSE`|Allow self signed certification or not.
mongodb_ssl_pem_file|`Certification File Path`|Specifies the certification file that contains both the TLS/SSL certificate and key. Specify the file name of the certification file using relative or absolute paths.
mongodb_ssl_pem_pwd|`Password`|The password to de-crypt the certificate-key file, if the certificate-key file is encrypted. 

</details>

<span id="postgresql_ssl_detial"></span>
### PostgreSQL
<details>
  <summary>PostgreSQL SSL Keys.</summary>

  Key|Value|Description
  :----|:----:|:----
  postgresql_ssl|`disable` or `allow` or `prefer` or `require` or `verify-ca` or `verify-full`|PostgreSQL SSL mode
  postgresql_ca_file|`Certificate Authority File`|Specifies the name of the file containing the SSL server certificate authority (CA).

  <span id="postgresql_ssl_mode_descriptions">
  </span>
  <details>
    <summary>SSL Mode Descriptions.</summary>

  Mode|Eavesdropping protection|MITM protection|Statement
  :---|:---|:---|:---
  disable|No|No|I don't care about security, and I don't want to pay the overhead of encryption.
  allow|Maybe|No|I don't care about security, but I will pay the overhead of encryption if the server insists on it.
  prefer|Maybe|No|I don't care about encryption, but I wish to pay the overhead of encryption if the server supports it.
  require|Yes|No|I want my data to be encrypted, and I accept the overhead. I trust that the network will make sure I always connect to the server I want.
  verify-ca|Yes|Depends on CA-policy|I want my data encrypted, and I accept the overhead. I want to be sure that I connect to a server that I trust.
  verify-full|Yes|Yes|I want my data encrypted, and I accept the overhead. I want to be sure that I connect to a server I trust, and that it's the one I specify.
  
  </details>
</details>


---
<span id="Functions"></span>
# Functions

<span id="constructor"></span>
## constructor
### Using:
<details>
    <summary>Load configuration from a json file.</summary>

Example:
```php
    $ssql = new SSQL($CONFIG_FILE_NAME);
```
</details>

<details>
    <summary>Configure by array.</summary>

Example:
```php
  $ssql = new SSQL($CONFIG_ARRAY);
```
</details>

<span id="query"></span>
## query
````
Execute a SQL statement.
````
### Using:
<b>return</b>: `Boolean`
````
Execute SQL statement successful or not.
````

<span id="execute_sql"></span>
<details>
  <summary>Execute SQL only</summary>

  Example:
  ```php
    $ssql->query("SELECT * FROM test_table");
  ```
</details>


<span id="execute_sql_placeholders"></span>
<details>
  <summary>Execute SQL with placeholders.</summary>

  ````
  Different database have different using. 
  ````

  <span id= "execute_sql_placeholders_mysql"></span>
  <details>
    <summary>MySQL</summary>

   query(`SQL statement`, `type`, `value1`, `value2` ...)
   ````
   A string that contains one or more characters which specify the types for the corresponding bind variables:
   ````
   #### Type specification chars

   Character|Description
   :----|:----
   i|corresponding variable has type integer.
   d|corresponding variable has type double.
   s|corresponding variable has type string.
   b|corresponding variable is a blob and will be sent in packets.

   <a href="https://secure.php.net/manual/en/mysqli-stmt.bind-param.php" target="_blank">More details</a>
   <details>
     <summary>Example 1</summary>

   ```php
   $ssql->query("SELECT * FROM test_table WHERE id=?", "i", 1);
   ```
   </details>
   <details>
     <summary>Example 2</summary>

   ```php
   $ssql->query("SELECT * FROM test_table WHERE id=? AND data=?", "is", 1, "data1");
   ```
   </details>
   <details>
     <summary>Example 3</summary>

   ```php
   $ssql->query("INSERT INTO test_table(id, data) VALUES(?, ?)", "is", 1, "data1");
   ```
   </details>
  </details>

  <span id= "execute_sql_placeholders_mongodb"></span>
  
  <details>
    <summary>MongoDB</summary>

   ````
   MongoDB SQL mode not support placeholders.
   ````
  </details>

  <span id= "execute_sql_placeholders_mssql"></span>
  <details>
    <summary>Microsoft SQL Server(MSSQL)</summary>

   query(`SQL statement`, `NULL`, `value1`, `value2` ...)
   ````
   The second parameter must be supply, and it can be anything. 
   It will not effect the SQL execute, it just a format.
   ````
   <details>
    <summary>Example 1</summary>

   ```php
   $ssql->query("SELECT * FROM test_table WHERE id=?", NULL, 1);
   ```
   </details>
   <details>
    <summary>Example 2</summary>

   ```php
   $ssql->query("INSERT INTO test_table(id, data) VALUES(?, ?)", NULL, 1, "data");
   ```
   </details>
  </details>

  <span id= "execute_sql_placeholders_oracle"></span>
  <details>
    <summary>Oracle</summary>

   query(`SQL statement`, `type`, `value1`, `value2` ...)
   <br>
   `type` should be a string of `"i"` or `"o"`
   <details>
     <summary>type "i"</summary>

   `i` means `index`.
   <br>
   The placeholders should be `colon`+`number`, such as `:0` `:1` and so on.
   <br>
   The number should be start as `0`.
   <br>
   <details>
     <summary>Example 1</summary>

   ```php
   $ssql->query("SELECT * FROM test_table WHERE id=:0", "i", 1);
   ```
   </details>
   <details>
     <summary>Example 2</summary>

   ```php
   $ssql->query("INSERT INTO test_table(id) VALUES(:0, :1)", "i", 1, "data1");
   ```
   </details>
   </details>
   <details>
     <summary>type "o"</summary>

   `o` means `oracle`.
   <br>
   The `placeholders` should be `colon`+`string`, such as `:id` `:data` and so on.
   <br>
   The value should be an array.
   <br>
   The value array should be as the table, you also can use [oracle_placeholder](#oracle_placeholder) function to build the array
   #### oracle value structure
   ```php
   array("key" => key, 
      "value" => value,
      "maxlength" => maxlength,
      "type" => type);
   ```
   Key|Value|Description
   :---|:---|:---
   key|`placeholder`|The placeholder name, such as `:id`.
   value|`value`|The value for binding.
   maxlength|`maximum`|Sets the maximum length for the data. If you set it to -1, this function will use the current length of variable to set the maximum length.

   `type` list

   Type|Description
   :---|:-----
   SQLT_BFILEE|for BFILEs
   SQLT_CFILEE|for CFILEs
   SQLT_CLOB|for CLOBs
   SQLT_BLOB|for BLOBs
   SQLT_RDD|for ROWIDs
   SQLT_NTY|for named datatypes
   SQLT_INT|for integers
   SQLT_CHR|for VARCHARs
   SQLT_BIN|for RAW columns
   SQLT_LNG|for LONG columns
   SQLT_LBI|for LONG RAW columns
   SQLT_RSET|for cursors created with oci_new_cursor()
   SQLT_BOL|for PL/SQL BOOLEANs (Requires OCI8 2.0.7 and Oracle Database 12c)

   <a href="https://secure.php.net/manual/en/function.oci-bind-by-name.php" target="_blank">Get more details</a>
   <details>
     <summary>Example 1</summary>

   ```php
   $ssql->query("SELECT * FROM test_table WHERE id=:id", "o", array("key" => ":id", "value" => 1, "maxlength" => -1, "type" => SQLT_INT));
   ```
   </details>
   <details>
     <summary>Example 2</summary>

   ```php
   $ssql->query("SELECT * FROM test_table WHERE id=:id", "o", $ssql->oracle_placeholder(":id", 1, -1, SQLT_INT));
   ```
   </details>
   <details>
     <summary>Example 3</summary>

   ```php
   $ssql->query("SELECT * FROM test_table WHERE id=:id", "o", $ssql->oracle_placeholder(":id", 1));
   ```
   </details>
   </details>
  </details>

  <span id= "execute_sql_placeholders_postgresql"></span>
  <details>
    <summary>PostgreSQL</summary>

   query(`SQL statement`, `NULL`, `value1`, `value2` ...)
   <br>
   The `placeholders` should be dollar+number, such as `$1` `$2` and so on.
   ````
   The number should be start as 1. 
   The second parameter must be supply, and it can be anything.
   It will not effect the SQL execute, it just a format.
   ````
   <details>
    <summary>Example 1</summary>

   ```php
   $ssql->query("SELECT * FROM test_table WHERE id=$1", NULL, 1);
   ```
   </details>
   <details>
    <summary>Example 2</summary>

   ```php
   $ssql->query("INSERT INTO test_table(id, data) VALUES($1, $2)", NULL, 1, "data");
   ```
   </details>
  </details>
</details>

<span id="oracle_placeholder"></span>
## oracle_placeholder
````
Build a oracle placeholders set.
````
### Using:
<b>return</b>: `Array`
````
Return an oracle placeholders set.
````
<details>
  <summary>Only KEY and VALUE</summary>

  oracle_placeholder(`KEY`, `VALUE`)
  ````
  Only set KEY and VALUE, maximum length will be using, type will be SQLT_CHR.
  ````
  <details>
    <summary>Example 1</summary>

   ```php
   $ssql->oracle_placeholder(":key", "value");
   ```
  </details>

  <details>
    <summary>Example 2</summary>

   ```php
   $ssql->oracle_placeholder(":id", 3);
   ```
  </details>

  <details>
    <summary>Example 3</summary>

   ```php
   $ssql->oracle_placeholder(":data", "data3");
   ```
  </details>
</details>

<details>
  <summary>Full settings</summary>

  oracle_placeholder(`KEY`, `VALUE`, `MAXLENGTH`, `TYPE`)
  ````
  Set KEY, VALUE, MAXLENGTH, and TYPE.
  ````
  <details>
    <summary>Example 1</summary>

   ```php
   $ssql->oracle_placeholder(":data", "data5", 5, SQLT_CHR);
   ```
  </details>
  <details>
    <summary>Example 2</summary>

   ```php
   $ssql->oracle_placeholder(":id", 12, 2, SQLT_INT);
   ```
  </details>
</details>


<span id="get_result"></span>
## get_result
````
Get current result.
Only working with cursor mode enabled.
````
### Using:
```php
get_result()
```
<b>return</b>: `Boolean` or `Array`
````
If have error, FALSE will be return, otherwise will return result.
````

<span id="get_prev"></span>
## get_prev
````
Get previous result.
Only working with cursor mode enabled.
````
### Using:
```php
get_prev()
```
<b>return</b>: `Boolean` or `Array`
````
If have error, FALSE will be return, otherwise will return result.
````

<span id="get_next"></span>
## get_next
````
Get next result.
Only working with cursor mode enabled.
````
### Using:
```php
get_next()
```
<b>return</b>: `Boolean` or `Array`
````
if have error, FALSE will be return.
Only working with cursor mode enabled.
````

<span id="get_skip"></span>
## get_skip
````
If have error, FALSE will be return, otherwise will return result.
````
### Using:
```php
get_skip($offset)
```
<b>return</b>: `Boolean` or `Array`
````
If have error, FALSE will be return, otherwise will return result.
````

<span id="move_prev"></span>
## move_prev
````
Move cursor to previous one. 
````
### Using:
```php
move_prev()
```
<b>return</b>: `Boolean`
````
If have error, FALSE will be return.
Only working with cursor mode enabled.
````

<span id="move_next"></span>
## move_next
````
Move cursor to next one.
````
### Using:
```php
move_next()
```
<b>return</b>: `Boolean`
````
If have error, FALSE will be return.
Only working with cursor mode enabled.
````

<span id="skip"></span>
## skip
````
Move cursor to specify one. 
````
### Using:
```php
skip()
```
<b>return</b>: `Boolean`
````
If have error, FALSE will be return.
Only working with cursor mode enabled.
````

<span id="html_var_dump"></span>
## html_var_dump
````
Convert dumped information about a variable to html format.
````
### Using
```php
html_var_dump($VARIABLE);
```
<b>return</b> `String`


<span id="version"></span> 
## version
````
Get current SSQL version.
Result should be 2.0 in this version
````
### Using
```php
version();
```
<b>return</b>: `String`

<span id="has_error"></span> 
## has_error
````
Check have error or not.
````
### Using
```php
has_error();
```
<b>return</b> `Boolean`

<span id="get_errors"></span>
## get_errors
````
Get all errors.
````
### Using
```php
get_errors($detial, $json)
```
`detial` should be `Boolean` type, only return `error code` or full detials.
<br>
`json` should be `Boolean` type, too. Return value should be json format or an array.
<br>
<b>return</b>: `Array` or `String` or `NULL`
````
If no errors, will return `NULL`.
````
More details please check [Error data structure](#error_structure)


<span id="get_last_error"></span> 
## get_last_error
````
Get last error.
````
### Using
```php
get_last_error($detial, $json)
```
`detial` should be `Boolean` type, only return `error code` or full detials.
<br>
`json` should be `Boolean` type, too. Return value should be json format or an array.
<br>
<b>return</b>: `Array` or `String` or `NULL`
<br>
````
If no errors, will return `NULL`.
````
More details please check [Error data structure](#error_structure)

<span id="clear_errors"></span> 
## clear_errors
### Using
```php
clear_errors()
```
````
Remove all errors.
````

<span id="mongodb_query"></span> 
## mongodb_query
````
Query data from MongoDB.
Only use for without SQL mode.
````
### Using
```php
mongodb_query($collection, $filter, $queryOptions)
```
`collection`: `string`
<br>
A fully qualified namespace (e.g. "databaseName.collectionName").
<br>
`filter`: `array` or `object`
<br>
An empty predicate will match all documents in the collection.
<br>
`queryOptions`: `array` _[Optional]_
<br>
Get <a href="https://secure.php.net/manual/en/mongodb-driver-query.construct.php" target="_blank">More details</a>.
<br>
<details>
  <summary>Query options</summary>

  Option | Type | Description
  :---|:---|:---
  allowPartialResults | `boolean` | For queries against a sharded collection, returns partial results from the mongos if some shards are unavailable instead of throwing an error.<br>Falls back to the deprecated "partial" option if not specified.
  awaitData | `boolean` | Use in conjunction with the "tailable" option to block a getMore operation on the cursor temporarily if at the end of data rather than returning no data. After a timeout period, the query returns as normal.
  batchSize | `integer` | The number of documents to return in the first batch. Defaults to 101. A batch size of 0 means that the cursor will be established, but no documents will be returned in the first batch.<br>In versions of MongoDB before 3.2, where queries use the legacy wire protocol OP_QUERY, a batch size of 1 will close the cursor irrespective of the number of matched documents.
  collation | `array` or `object` | Collation allows users to specify language-specific rules for string comparison, such as rules for lettercase and accent marks. When specifying collation, the "locale" field is mandatory; all other collation fields are optional. For descriptions of the fields, see » Collation Document. <br> If the collation is unspecified but the collection has a default collation, the operation uses the collation specified for the collection. If no collation is specified for the collection or for the operation, MongoDB uses the simple binary comparison used in prior versions for string comparisons. <br> This option is available in MongoDB 3.4+ and will result in an exception at execution time if specified for an older server version.
  comment | `string` | A comment to attach to the query to help interpret and trace query profile data. <br> Falls back to the deprecated "$comment" modifier if not specified.
  exhaust | `boolean` | Stream the data down full blast in multiple "more" packages, on the assumption that the client will fully read all data queried. Faster when you are pulling a lot of data and know you want to pull it all down. Note: the client is not allowed to not read all the data unless it closes the connection. <br> This option is not supported by the find command in MongoDB 3.2+ and will force the driver to use the legacy wire protocol version (i.e. OP_QUERY).
  explain | `boolean` | If TRUE, the returned MongoDB\Driver\Cursor will contain a single document that describes the process and indexes used to return the query. <br> Falls back to the deprecated "$explain" modifier if not specified. <br> This option is not supported by the find command in MongoDB 3.2+ and will only be respected when using the legacy wire protocol version (i.e. OP_QUERY). The » explain command should be used on MongoDB 3.0+.
  hint | `string` or `array` or `object` | Index specification. Specify either the index name as a string or the index key pattern. If specified, then the query system will only consider plans using the hinted index. <br> Falls back to the deprecated "hint" option if not specified.
  limit | `integer` | The maximum number of documents to return. If unspecified, then defaults to no limit. A limit of 0 is equivalent to setting no limit. <br> A negative limit is will be interpreted as a positive limit with the "singleBatch" option set to TRUE. This behavior is supported for backwards compatibility, but should be considered deprecated.
  max | `array` or `object` | The exclusive upper bound for a specific index. <br> Falls back to the deprecated "$max" modifier if not specified.
  maxAwaitTimeMS | `integer` | Positive integer denoting the time limit in milliseconds for the server to block a getMore operation if no data is available. This option should only be used in conjunction with the "tailable" and "awaitData" options.
  maxScan | `integer` | <b>Warning:</b>This option is deprecated and should not be used.<br>Positive integer denoting the maximum number of documents or index keys to scan when executing the query. <br> Falls back to the deprecated "$maxScan" modifier if not specified.
  maxTimeMS | `integer` | The cumulative time limit in milliseconds for processing operations on the cursor. MongoDB aborts the operation at the earliest following interrupt point. <br> Falls back to the deprecated "$maxTimeMS" modifier if not specified.
  min | `array` or `object` | The inclusive lower bound for a specific index. <br> Falls back to the deprecated "$min" modifier if not specified.
  modifiers | `array` | Meta operators modifying the output or behavior of a query. Use of these operators is deprecated in favor of named options.
  noCursorTimeout | `boolean` | Prevents the server from timing out idle cursors after an inactivity period (10 minutes).
  oplogReplay | `boolean` | Internal use for replica sets. To use oplogReplay, you must include the following condition in the filter: <br> <b> [ 'ts' => [ '$gte' => <timestamp> ] ]</b>
  projection | `array` or `object` | The » projection specification to determine which fields to include in the returned documents. <br>If you are using the ODM functionality to deserialise documents as their original PHP class, make sure that you include the __pclass field in the projection. This is required for the deserialization to work and without it, the driver will return (by default) a stdClass object instead.
  readConcern | `MongoDB\Driver\ReadConcern` | A read concern to apply to the operation. By default, the read concern from the MongoDB Connection URI will be used. <br> This option is available in MongoDB 3.2+ and will result in an exception at execution time if specified for an older server version.
  returnKey | `boolean` | If TRUE, returns only the index keys in the resulting documents. Default value is FALSE. If TRUE and the find command does not use an index, the returned documents will be empty. <br> Falls back to the deprecated "$returnKey" modifier if not specified.
  showRecordId | `boolean` | Determines whether to return the record identifier for each document. If TRUE, adds a top-level "$recordId" field to the returned documents. <br> Falls back to the deprecated "$showDiskLoc" modifier if not specified.
  singleBatch | `boolean` | Determines whether to close the cursor after the first batch. Defaults to FALSE.
  skip | `integer` | Number of documents to skip. Defaults to 0.
  slaveOk | `boolean` | Allow query of replica set secondaries
  snapshot | `boolean` | <b>Warning:</b> This option is deprecated and should not be used.<br>Prevents the cursor from returning a document more than once because of an intervening write operation. <br> Falls back to the deprecated "$snapshot" modifier if not specified.
  sort | `array` or `object` | The sort specification for the ordering of the results. <br>Falls back to the deprecated "$orderby" modifier if not specified.
  tailable | `boolean` | Returns a tailable cursor for a capped collection.

</details>

<b>return</b>: `Boolean`
````
Execute successful or not.
````

<span id="mongodb_insert"></span> 
## mongodb_insert
````
Adds an insert operation to the database.
Only use for without SQL mode.
````
### Using
```php
mongodb_insert($collection, $documents)
```
`collection`: `string`
<br>
A fully qualified namespace (e.g. "databaseName.collectionName").
<br>
`document`: `array` or `object`
<br>
A document to insert.
<br>
<b>return</b>: `Boolean`
````
Insert successful or not.
````

<span id="mongodb_update"></span> 
## mongodb_update
````
Update MongoDB document.
Only use for without SQL mode.
````
### Using
```php
mongodb_update($collection, $filter, $newObj, $updateOptions)
```
`collection`: `string`
<br>
A fully qualified namespace (e.g. "databaseName.collectionName").
<br>
`filter`: `array` or `object`
<br>
An empty predicate will match all documents in the collection.
<br>
`newObj`: `array` or `object`
<br>
A document containing either update operators (e.g. $set) or a replacement document (i.e. only field:value expressions).
<br>
`updateOptions`: `array` _[Optional]_
<br>
Get <a href="https://secure.php.net/manual/en/mongodb-driver-bulkwrite.update.php" target="_blank">More details</a>.
<details>
  <summary>updateOptions</summary>

  Option | Type | Description | Default
  :---|:---|:-----|:---
  arrayFilters | `array` or `object` | An array of filter documents that determines which array elements to modify for an update operation on an array field. See » Specify arrayFilters for Array Update Operations in the MongoDB manual for more information.<br> This option is available in MongoDB 3.6+ and will result in an exception at execution time if specified for an older server version.
  collation | `array` or `object` | » Collation allows users to specify language-specific rules for string comparison, such as rules for lettercase and accent marks. When specifying collation, the "locale" field is mandatory; all other collation fields are optional. For descriptions of the fields, see » Collation Document. <br> If the collation is unspecified but the collection has a default collation, the operation uses the collation specified for the collection. If no collation is specified for the collection or for the operation, MongoDB uses the simple binary comparison used in prior versions for string comparisons. <br> This option is available in MongoDB 3.4+ and will result in an exception at execution time if specified for an older server version.
  multi | `boolean` | Update only the first matching document if FALSE, or all matching documents TRUE. This option cannot be TRUE if newObj is a replacement document. | FALSE
  upsert | `boolean` | If filter does not match an existing document, insert a single document. The document will be created from newObj if it is a replacement document (i.e. no update operators); otherwise, the operators in newObj will be applied to filter to create the new document. | FALSE

</details>

<b>return</b>: `Boolean`
````
Update successful or not.
````

<span id="mongodb_delete"></span> 
## mongodb_delete
````
Delete MongoDB document.
Only use for without SQL mode.
````
### Using
```php
mongodb_delete($collection, $filter, $deleteOptions)
```
`collection`: `string`
<br>
A fully qualified namespace (e.g. "databaseName.collectionName").
<br>
`filter`: `array` or `object`
<br>
An empty predicate will match all documents in the collection.
<br>
`deleteOptions`: `array` _[Optional]_
<br>
Get <a href="https://secure.php.net/manual/en/mongodb-driver-bulkwrite.update.php" target="_blank">More details</a>.
<details>
  <summary>deleteOptions</summary>

  Option | Type | Description | Default
  :---|:---|:-----|:---
  collation | `array` or `object` | » Collation allows users to specify language-specific rules for string comparison, such as rules for lettercase and accent marks. When specifying collation, the "locale" field is mandatory; all other collation fields are optional. For descriptions of the fields, see » Collation Document. <br> If the collation is unspecified but the collection has a default collation, the operation uses the collation specified for the collection. If no collation is specified for the collection or for the operation, MongoDB uses the simple binary comparison used in prior versions for string comparisons. <br> This option is available in MongoDB 3.4+ and will result in an exception at execution time if specified for an older server version.
  limit | `boolean` | Delete all matching documents (FALSE), or only the first matching document (TRUE) | FALSE

</details>

<b>return</b>: `Boolean`

````
Delete successful or not.
````

<span id="mongodb_id"></span> 
## mongodb_id
````
Create a MongoDB ID object.
````
### Using
```php
mongodb_id($id)
```

`id`: `String`
<br>
A 24-character hexadecimal string. If not provided, the driver will generate an ObjectId.

<span id="free_cursor"></span> 
## free_cursor
````
Free using cursor.
````
### Using
```php
free_cursor();
```
````
New query or destruct will call this function, too.
````

<span id="ping"></span> 
## ping
````
Test database connection or not.
````
### Using
```php
ping();
```
<b>return</b>: `Boolean`
````
Database connection is good or not.
````

---
<span id="MongoDB_SQL"></span>
# MongoDB SQL Supporting
Example:
```sql
INSERT INTO table_a(a) VALUES(SELECT a FROM table_b WHERE b=(SELECT b FROM table_C WHERE c=1));
SELECT * FROM table_a WHERE a=(SELECT a FROM table_b WHERE b=(SELECT b FROM table_C WHERE c=1));
UPDATE table_a SET a = 1, b=2 WHERE a=(SELECT a FROM table_b WHERE b=(SELECT b FROM table_C WHERE c=1));
DELETE FROM table_a WHERE a=(SELECT a FROM table_b WHERE b=(SELECT b FROM table_C WHERE c=1));
```

SSQL is support run SQL on MongoDB, just set the conifgure `mongodb_sql_mode` be `TRUE`.
<br>
Although SSQL support SQL, but there is some limitation.
<br>
`INSERT`, `UPDATE`, `DELETE` is fully support, but only can run <b>one</b> statement in a query.
<br>
`INSERT`, `UPDATE`, `DELETE` can working with `SELECT`, such as the example;
<br>
Complex `SELECT` statement is supported, such as the example;
<br>
Sub `SELECT` statment must have parentheses, same as the example;
<br>
Alias is <b>NOT</b> supported.
<br>
Only the key words in the table is supported.
<br>
<details>
  <summary>Key words table</summary>

  Key word
  :---
  JOIN
  LEFT JOIN
  RIGHT JOIN
  INNER JOIN
  FULL JOIN
  FULL OUTER JOIN
  SELECT
  UPDATE
  DELETE
  FROM
  WHERE
  AND
  OR
  NOT
</details>

---
<span id="error_structure"></span>
# Error data structure
````
Error data array have special structure.
There are 4 fields will beset, the table shows the detail of the structure.
````

Key | value | Description
:---|:---:|:-----
defined_error| `Boolean` | Is a defined error or not. Undefined error caused by exception.
error_code | `String` | The code marks where is the error happend.
error_string | `String` | The description of error.
original_error_code | `String` | This only use for Microsoft SQL Server(MSSQL), the original error code of MSSQL will be store here.