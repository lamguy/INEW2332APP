CREATE TABLE ref_device_status (
  id INT NOT NULL,
  device_status_description VARCHAR(50) NOT NULL,
PRIMARY KEY (id));

CREATE TABLE ref_device_type (
  id INT NOT NULL,
  device_type_description VARCHAR(50) NOT NULL,
PRIMARY KEY (id));

CREATE TABLE ref_os_system (
  id INT NOT NULL,
  os_system_description VARCHAR(50) NOT NULL,
PRIMARY KEY (id));



INSERT INTO ref_device_status VALUES (1, "Active");
INSERT INTO ref_device_status VALUES (2, "Deactive");
INSERT INTO ref_device_status VALUES (3, "Revoke");

INSERT INTO ref_device_type VALUES (1, "Phone");
INSERT INTO ref_device_type VALUES (2, "Laptop");
INSERT INTO ref_device_type VALUES (3, "Other");

INSERT INTO ref_os_system VALUES (1, "Android");
INSERT INTO ref_os_system VALUES (2, "IOS");
INSERT INTO ref_os_system VALUES (3, "Windows");










