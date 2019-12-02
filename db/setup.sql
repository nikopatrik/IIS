DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS user_item;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS businesses;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS user_item;

CREATE TABLE businesses(
                           business_id INT PRIMARY KEY AUTO_INCREMENT,
                           business_name VARCHAR (100),
                           business_street VARCHAR (100),
                           business_street_number VARCHAR (10),
                           business_city VARCHAR (100),
                           business_zip VARCHAR (10),
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
                      user_phone_number VARCHAR(20),
                      user_street VARCHAR(100),
                      user_street_number VARCHAR (10),
                      user_city VARCHAR(100),
                      user_zip_code VARCHAR (5),
                      user_type VARCHAR (1),
                      CHECK (user_type IN ('A','O','D','C','N')), -- Admin Operator Driver Customer Nonregistrated
                      CONSTRAINT email_constraint CHECK ( REGEXP_LIKE( user_email, '.+@(.+\..+)+' ))
);

CREATE TABLE orders(
                       order_id INT PRIMARY KEY AUTO_INCREMENT,
                       order_date DATE,
                       order_time TIME,
                       order_price INT,
                       order_state BOOLEAN,
                       order_owner VARCHAR (100),
                       order_driver VARCHAR (100),
                       order_street VARCHAR(100),
                       order_street_number VARCHAR (10),
                       order_city VARCHAR(100),
                       order_zip_code VARCHAR (5),

                       CONSTRAINT order_owner_constraint
                           FOREIGN KEY (order_owner)
                               REFERENCES users(user_email),
                       CONSTRAINT order_driver_constraint
                           FOREIGN KEY (order_driver)
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

CREATE TABLE user_item (
                           user_id VARCHAR(100),
                           item_id_cart INT,
                           cart_quantity INT,
                           CONSTRAINT user_item_user FOREIGN KEY (user_id) REFERENCES users(user_email),
                           CONSTRAINT user_item_item FOREIGN KEY (item_id_cart) REFERENCES items(item_id)
);
