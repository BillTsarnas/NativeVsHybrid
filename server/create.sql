DROP DATABASE if exists NativeVsHybrid;
CREATE DATABASE NativeVsHybrid DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE NativeVsHybrid;

CREATE TABLE IF NOT EXISTS user_pool(
id int(6) NOT NULL AUTO_INCREMENT,
name VARCHAR(50) collate utf8_unicode_ci,
pwd VARCHAR(50) collate utf8_unicode_ci,
PRIMARY KEY (id)
) DEFAULT CHARSET=utf8 DEFAULT COLLATE=utf8_unicode_ci 
  CHARSET=utf8 COLLATE=utf8_unicode_ci;
  
  CREATE TABLE IF NOT EXISTS native(
id int(6) NOT NULL AUTO_INCREMENT,
task VARCHAR(50) collate utf8_unicode_ci,
execution VARCHAR(50) collate utf8_unicode_ci,
os_version VARCHAR(50) collate utf8_unicode_ci,
PRIMARY KEY (id)
) DEFAULT CHARSET=utf8 DEFAULT COLLATE=utf8_unicode_ci 
  CHARSET=utf8 COLLATE=utf8_unicode_ci;
  
  CREATE TABLE IF NOT EXISTS hybrid(
id int(6) NOT NULL AUTO_INCREMENT,
task VARCHAR(50) collate utf8_unicode_ci,
execution VARCHAR(50) collate utf8_unicode_ci,
os_version VARCHAR(50) collate utf8_unicode_ci,
PRIMARY KEY (id)
) DEFAULT CHARSET=utf8 DEFAULT COLLATE=utf8_unicode_ci 
  CHARSET=utf8 COLLATE=utf8_unicode_ci;