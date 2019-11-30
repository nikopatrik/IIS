DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS driver_business;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS businesses;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;

CREATE TABLE businesses(
                           business_id INT PRIMARY KEY AUTO_INCREMENT,
                           business_name VARCHAR (100),
                           business_street VARCHAR (100),
                           business_street_number INT,
                           business_city VARCHAR (100),
                           business_zip INT,
                           business_closing_time TIME,
                           business_picture_path VARCHAR (1000)
);

CREATE TABLE items(
                      item_id INT PRIMARY KEY AUTO_INCREMENT,
                      item_name VARCHAR (100) NOT NULL,
                      item_description VARCHAR (10000),
                      item_price VARCHAR(10),
                      item_category VARCHAR (1),
                      CHECK (item_category IN ('O','D')),
                      item_type VARCHAR (1),
                      CHECK (item_type IN ('V','W','G','N','D')), -- V-Vegan W-Vegetarian G-Glutenfree N-Normal D-Drink
                      item_image_path VARCHAR (1000),
                      item_limit INT,
                      item_business INT,

                      CONSTRAINT item_business_constraint
                          FOREIGN KEY (item_business)
                              REFERENCES businesses(business_id)
);

CREATE TABLE users(
                      user_email VARCHAR(100) PRIMARY KEY,
                      user_password VARCHAR(60) NOT NULL,
                      user_name VARCHAR (100),
                      user_phone_number VARCHAR(100),
                      user_street VARCHAR(100),
                      user_street_number INT,
                      user_city VARCHAR(100),
                      user_zip_code INT,
                      user_type VARCHAR (1),
                      CHECK (user_type IN ('A','O','D','C')), -- Admin Operator Driver Customer
                      CONSTRAINT email_constraint CHECK ( REGEXP_LIKE( user_email, '.+@(.+\..+)+' ))
);

CREATE TABLE orders(
                       order_id INT PRIMARY KEY AUTO_INCREMENT,
                       order_date DATE,
                       order_time TIME,
                       order_price INT,
                       order_state BOOLEAN,
                       order_owner VARCHAR (100),

                       CONSTRAINT order_owner_constraint
                           FOREIGN KEY (order_owner)
                               REFERENCES users(user_email)
);

CREATE TABLE order_items(
                            order_of_item INT,
                            item_in_order INT,
                            number_of_items INT,
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