DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS driver_business;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS businesses;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS drivers;
DROP TABLE IF EXISTS users;

CREATE TABLE businesses(
                           business_id INT PRIMARY KEY,
                           business_name VARCHAR (100),
                           business_street VARCHAR (100),
                           business_city VARCHAR (100),
                           business_zip INT,
                           business_closing_time TIME
);

CREATE TABLE items(
                      item_id INT PRIMARY KEY,
                      item_name VARCHAR (100),
                      item_description VARCHAR (10000),
                      item_price INT,
                      item_category VARCHAR (1),
                      CHECK (item_category IN ('O','D')),
                      item_type VARCHAR (100),
                      item_image_path VARCHAR (100),
                      item_limit INT,
                      item_business INT,

                      CONSTRAINT item_business_constraint
                          FOREIGN KEY (item_business)
                              REFERENCES businesses(business_id)
);

CREATE TABLE users(
                      user_email VARCHAR(100) PRIMARY KEY,
                      user_password VARCHAR(40) NOT NULL,
                      user_type VARCHAR (1),
                      CHECK (user_type IN ('A','O','D','C')),
                      CONSTRAINT email_constraint CHECK ( REGEXP_LIKE( user_email, '.+@(.+\..+)+' ))
);

CREATE TABLE orders(
                       order_id INT PRIMARY KEY,
                       order_date DATE,
                       order_time TIME,
                       order_price INT,
                       order_owner VARCHAR (100),

                       CONSTRAINT order_owner_constraint
                           FOREIGN KEY (order_owner)
                               REFERENCES users(user_email)
);

CREATE TABLE order_items(
                            order_of_item INT,
                            item_in_order INT,
                            CONSTRAINT order_constraint
                                FOREIGN KEY (order_of_item)
                                    REFERENCES orders (order_id),

                            CONSTRAINT item_constraint
                                FOREIGN KEY (item_in_order)
                                    REFERENCES items(item_id)
);

CREATE TABLE driver_business(
                                driver VARCHAR(100),
                                business INT,
                                CONSTRAINT driver_constraint
                                    FOREIGN KEY (driver)
                                        REFERENCES users(user_email),

                                CONSTRAINT business_constraint
                                    FOREIGN KEY (business)
                                        REFERENCES businesses(business_id)
);

