/* Create the Users table. */
CREATE TABLE users (
  user_id INT NOT NULL,
  employee_id VARCHAR(25) NOT NULL,
  first_name VARCHAR(25) NOT NULL,
  last_name VARCHAR(35) NOT NULL,
  password VARCHAR(25) NOT NULL,
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  modify_date DATETIME ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (user_id));




/* Create the Devices table. */
CREATE TABLE devices (
  device_id INT NOT NULL,
  user_id INT,
  mac_address VARCHAR(50) NOT NULL,
  device_name VARCHAR(50) NOT NULL,
  device_status INT NOT NULL,
  register_date DATE,
  deactive_date DATE,
  revoke_date DATE,
  device_type INT NOT NULL,
  device_type_specify VARCHAR(25),
  os_system INT,
  os_version VARCHAR(25),
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  modify_date DATETIME ON UPDATE CURRENT_TIMESTAMP,
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



/* Create the Reference tables. */
CREATE TABLE ref_device_status (
  id INT NOT NULL,
  device_status_description VARCHAR(50) NOT NULL,
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id));

CREATE TABLE ref_device_type (
  id INT NOT NULL,
  device_type_description VARCHAR(50) NOT NULL,
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id));


CREATE TABLE ref_os_system (
  id INT NOT NULL,
  os_system_description VARCHAR(50) NOT NULL,
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id));








