/* Create the database. */
/* CREATE DATABASE inew2332; */


/* Create the Users table. */
CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT,
  employee_id VARCHAR(25) NOT NULL,
  first_name VARCHAR(25) NOT NULL,
  last_name VARCHAR(35) NOT NULL,
  password VARCHAR(30) NOT NULL,
  create_date DATETIME,
  modify_date DATETIME,
PRIMARY KEY (user_id));


/* Create the Devices table. */
CREATE TABLE devices (
  device_id INT NOT NULL AUTO_INCREMENT,
  user_id INT,
  mac_address VARCHAR(50) NOT NULL,
  device_name VARCHAR(50) NOT NULL,
  device_status INT NOT NULL,
  register_date DATE,
  deactive_date DATE,
  deregister_date DATE,
  device_type INT NOT NULL,
  device_type_specify VARCHAR(25),
  os_system INT,
  os_version VARCHAR(25),
  create_date DATETIME,
  modify_date DATETIME,
PRIMARY KEY (device_id),
INDEX user_indx (user_id),
FOREIGN KEY (user_id) 
  REFERENCES users(id)
  ON DELETE CASCADE,
INDEX dev_stat_indx (device_status),
FOREIGN KEY (device_status) 
  REFERENCES ref_device_status(id)
  ON DELETE CASCADE,
INDEX dev_typ_indx (device_type),
FOREIGN KEY (device_type) 
  REFERENCES ref_device_type(id)
  ON DELETE CASCADE,
INDEX os_sys_indx (os_system),
FOREIGN KEY (os_system) 
  REFERENCES ref_os_system(id)
  ON DELETE CASCADE);

DELIMITER $$

/* Create the Triggers. */
CREATE TRIGGER t_bi_users_ts
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
   SET new.create_date = CURRENT_TIMESTAMP();
   SET new.modify_date = CURRENT_TIMESTAMP();
END$$

CREATE TRIGGER t_bi_devices_ts
BEFORE INSERT ON devices
FOR EACH ROW
BEGIN
   SET new.create_date = CURRENT_TIMESTAMP();
   SET new.modify_date = CURRENT_TIMESTAMP();
END$$

CREATE TRIGGER t_bu_users_ts
BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
   SET new.modify_date = CURRENT_TIMESTAMP();
END$$

CREATE TRIGGER t_bu_devices_ts
BEFORE UPDATE ON devices
FOR EACH ROW
BEGIN
   SET new.modify_date = CURRENT_TIMESTAMP();
END$$
DELIMITER ;


/* Create the Reference tables. */
CREATE TABLE ref_device_status (
  id INT NOT NULL,
  device_status_description VARCHAR(50) NOT NULL,
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id));

CREATE TABLE ref_device_type (
  id INT NOT NULL,
  device_type_description VARCHAR(50) NOT NULL,
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id));

CREATE TABLE ref_os_system (
  id INT NOT NULL,
  os_system_description VARCHAR(50) NOT NULL,
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id));



/* Insert data to the Reference tables. */
INSERT INTO ref_device_status VALUES (1, "Active");
INSERT INTO ref_device_status VALUES (2, "Deactive");
INSERT INTO ref_device_status VALUES (3, "Deregister");
INSERT INTO ref_device_status VALUES (4, "Pending");

INSERT INTO ref_device_type VALUES (1, "Phone");
INSERT INTO ref_device_type VALUES (2, "Laptop");
INSERT INTO ref_device_type VALUES (3, "Other");

INSERT INTO ref_os_system VALUES (1, "Android");
INSERT INTO ref_os_system VALUES (2, "IOS");
INSERT INTO ref_os_system VALUES (3, "Windows");



