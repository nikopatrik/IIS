
insert into businesses ( business_id, business_name, business_city, business_street, business_street_number, business_zip, business_closing_time,business_picture_path) values (1, 'Bucheck'      , 'Brno'    , 'Grohova', '14'   ,'62800', '23:11:00','img/bucheck.jpg');
insert into businesses ( business_id, business_name, business_city, business_street, business_street_number, business_zip, business_closing_time,business_picture_path) values (2, 'McDonalds'    , 'Brno'    , 'Česká', '15'     ,'64200', '23:41:00','img/mcdonalds.jpg');
insert into businesses ( business_id, business_name, business_city, business_street, business_street_number, business_zip, business_closing_time,business_picture_path) values (3, 'AMICI'        , 'Tišnov'  , 'Hezká', '8'      ,'64300', '21:00:00','img/amici.jpg');
insert into businesses ( business_id, business_name, business_city, business_street, business_street_number, business_zip, business_closing_time,business_picture_path) values (4, 'Roburrito'    , 'Olomouc' , 'Univerzitní','54','61540', '20:40:00','img/roburrito.jpeg');

insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (1, 'Hamburger', 'Hovädzie mäso, Žemľa, Olej, Cibuľa',             '6.50',     'O' ,'N' ,NULL, 1);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (2, 'Cheesburger', 'Hovädzie mäso, Žemľa, Olej, Cibuľa, Syr',      '9.30',     'D' ,'N' ,200, 1);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (3, 'Chilli Burger', 'Hovädzie mäso, Žemľa, Olej, Cibuľa,Chilli',  '9.50',     'D' ,'N' ,100, 1);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (4, 'Veggie BURGER', 'Soja,Žemľa, Olej, Cibuľa,Chilli,Tajna prisada', '15.50', 'O' ,'V' ,NULL, 1);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (5, 'Quatro formagi Burger', 'Zemla, 4 druhy syra,',               '4.20',     'O' ,'W' ,NULL, 1);

insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (6, 'Avengers pizza', 'Cesto, Rajcina, Orechy ',                   '5.20',     'O', 'V',NULL,4);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (7, 'Party Pizza', 'Cesto, Rajcina, Orechy, Karfiol',              '3.20',     'O', 'V',NULL,4);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (8, 'Burrito Extra', 'Placka,Kuracie maso,Zelenia',                '4.30',     'D', 'N',120,4);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (10, 'Burrito Chilli', 'Placka,Kuracie maso,Zelenia, Chilli',       '12.20'    ,'D', 'N',130,4);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (11, 'Burrito Party', 'Placka,Kuracie maso,Zelenia, Party Ingrediencia', '4.40','D','N',150,4);

insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (12, 'BigMac', 'Hovädzie mäso, Žemľa, Olej, Cibuľa',               '6.60',     'O' ,'N' ,NULL, 2);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (13, 'McRoyale','Hovädzie mäso, Žemľa, Olej, Cibuľa, Royale Sauce','6.50',     'O' ,'N' ,NULL, 2);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (14, 'Hranolky', 'Zemiaky Olej',                                   '2.50',     'O' ,'V' ,NULL, 2);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (15, 'McWrap', 'Vajce, Olej, Tortila, Cibuľa, Zelenina',    '6.50',     'O' ,'W' ,NULL, 2);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (16, 'Kyblik 5ks', 'Kuracie mäso, Olej',                           '4.40',     'D' ,'N' ,150, 2);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (17, 'Kyblik 10ks', 'Kuracie mäso, Olej',                          '7.50',     'D' ,'N' ,200, 2);

insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (18, 'Grinder', 'Placka,Hovädzie mäso,Zelenia',            '5.50'      ,'O','N',NULL,3);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (19, 'Zinger', 'Placka,Kuracie mäso,Zelenia',              '4.60'      ,'D','N',100,3);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (20, 'Chicken Chorizo', 'Chorizo salama, Cesto, Syr, Olivy','7.30'     ,'D','N',200,3);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (21, 'Quatro Americano', 'Kuracie mäso, Zelenina, Syr, Olivy','5.30'   ,'O','N',NULL,3);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (22, 'Gucci Flaco', 'Tajomstvo, Šéfkuchára','12.40'                    ,'D','W',200,3);

insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (23, 'Cola',NULL,'1.30','O' ,'D' ,NULL, 1);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (24, 'Voda', NULL,'1.00','O' ,'D' ,NULL, 1);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (25, 'Fanta',NULL, '1.10','O' ,'D' ,NULL, 2);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (26, 'Sprite', NULL,'1.10','O' ,'D' ,NULL, 2);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (27, 'Káva', NULL,'3.30','O' ,'D' ,NULL, 3);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (28, 'Čaj', NULL,'0.50','O' ,'D' ,NULL, 3);
insert into items (item_id, item_name, item_description, item_price, item_category, item_type, item_limit, item_business) values (29, 'Pepsi',NULL, '1.20','O' ,'D' ,NULL, 3);

insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('achaney0@squarespace.com', 'f91IX3pXtJWM', 'C','Nikolas Patrik','904032213');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('ffoottit1@ftc.gov', 'GI7H1fihs3J', 'O','Róbert Hubinák','9036789543');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('aboarer2@shinystat.com', '7RYWo9ZzS', 'D','Matej Janček','940329393');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('amelmore3@about.me', '59aCD4Q', 'D','Lukáš Chmelo','904654420');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('klonghorne4@issuu.com', 'b5ChaWBlLcyo', 'D', 'Jozef Novák','653908453');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('chexter5@yandex.ru', 'M8bHUkB', 'C', 'Peter Ondrík','980789567');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('ndomek6@deliciousdays.com', 'MW31fE', 'C', 'Vlasto Depeš','234967098');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('eastbery7@cbc.ca', 'zPqinC5NbPQ', 'C', 'Dano Drevo','560432098');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('admin@admin.com', 'admin', 'A', 'Starý Jano','955908344');
insert into users (user_email, user_password, user_type, user_name, user_phone_number) values ('dfarre9@dion.jp', 'DTAjuWf2Jlzz', 'O','Onder Opic','2908796432');


insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner,order_driver) values (0,1, '2017-02-19', '3:44:00', 55, 'chexter5@yandex.ru','amelmore3@about.me');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner,order_driver) values (0,2, '2019-12-03', '17:18:00', 81, 'amelmore3@about.me','amelmore3@about.me');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner,order_driver) values (0,3, '2019-12-03', '17:18:00', 81, 'aboarer2@shinystat.com','amelmore3@about.me');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner,order_driver) values (0,4, '2019-04-21', '14:52:00', 78, 'aboarer2@shinystat.com','klonghorne4@issuu.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner,order_driver) values (0,5, '2019-12-05', '4:02:00', 51, 'dfarre9@dion.jp','klonghorne4@issuu.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner,order_driver) values (0,6, '1209-09-30', '17:29:00', 49, 'amelmore3@about.me','klonghorne4@issuu.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,7, '2019-07-13', '19:51:00', 65, 'dfarre9@dion.jp');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,8, '1219-12-14', '13:10:00', 40, 'eastbery7@cbc.ca');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,9, '2019-11-10', '15:52:11', 39, 'aboarer2@shinystat.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,10, '2019-03-06', '23:16:22', 83, 'eastbery7@cbc.ca');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,11, '1219-03-06', '18:15:00', 63, 'klonghorne4@issuu.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,12, '2019-03-06', '12:54:00', 53, 'klonghorne4@issuu.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,13, '2019-03-06', '14:15:00', 95, 'ffoottit1@ftc.gov');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,14, '2019-03-06', '13:32:00', 37, 'amelmore3@about.me');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,15, '2019-03-06', '12:56:00', 44, 'ndomek6@deliciousdays.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,16, '2019-03-06', '5:49:00', 66, 'ffoottit1@ftc.gov');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,17, '2019-03-06', '3:48:00', 90, 'ndomek6@deliciousdays.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,18, '2019-03-06', '7:07:00', 82, 'achaney0@squarespace.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,19, '2019-03-06', '5:13:00', 40, 'dfarre9@dion.jp');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,20, '2019-03-06', '5:33:00', 65, 'achaney0@squarespace.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,21, '4219-03-06', '5:52:00', 31, 'ndomek6@deliciousdays.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,22, '2019-03-06', '9:31:00', 95, 'eastbery7@cbc.ca');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,23, '2019-03-06', '9:59:00', 98, 'chexter5@yandex.ru');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,24, '2019-03-06', '4:55:00', 36, 'achaney0@squarespace.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,25, '1219-03-06', '10:21:00', 64, 'achaney0@squarespace.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,26, '1219-03-06', '8:30:00', 32, 'amelmore3@about.me');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,27, '2019-03-06', '4:54:00', 77, 'klonghorne4@issuu.com');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,28, '2019-03-06', '2:17:00', 38, 'ffoottit1@ftc.gov');
insert into orders (order_state,order_id, order_date, order_time, order_price, order_owner) values (0,29, '2019-03-06', '11:48:00', 91, 'achaney0@squarespace.com');

insert into order_items (order_of_item, item_in_order, number_of_items) values (15, 24, 3);
insert into order_items (order_of_item, item_in_order, number_of_items) values (24, 27, 26);
insert into order_items (order_of_item, item_in_order, number_of_items) values (24, 22, 10);
insert into order_items (order_of_item, item_in_order, number_of_items) values (22, 10, 27);
insert into order_items (order_of_item, item_in_order, number_of_items) values (26, 25, 12);
insert into order_items (order_of_item, item_in_order, number_of_items) values (23, 6, 24);
insert into order_items (order_of_item, item_in_order, number_of_items) values (16, 10, 6);
insert into order_items (order_of_item, item_in_order, number_of_items) values (12, 14, 27);
insert into order_items (order_of_item, item_in_order, number_of_items) values (13, 14, 6);
insert into order_items (order_of_item, item_in_order, number_of_items) values (25, 26, 21);
insert into order_items (order_of_item, item_in_order, number_of_items) values (1, 29, 23);
insert into order_items (order_of_item, item_in_order, number_of_items) values (13, 2, 17);
insert into order_items (order_of_item, item_in_order, number_of_items) values (3, 20, 13);
insert into order_items (order_of_item, item_in_order, number_of_items) values (28, 3, 18);
insert into order_items (order_of_item, item_in_order, number_of_items) values (4, 7, 4);
insert into order_items (order_of_item, item_in_order, number_of_items) values (12, 4, 8);
insert into order_items (order_of_item, item_in_order, number_of_items) values (6, 23, 6);
insert into order_items (order_of_item, item_in_order, number_of_items) values (13, 15, 26);
insert into order_items (order_of_item, item_in_order, number_of_items) values (28, 18, 25);
insert into order_items (order_of_item, item_in_order, number_of_items) values (7, 3, 14);
insert into order_items (order_of_item, item_in_order, number_of_items) values (8, 12, 27);
insert into order_items (order_of_item, item_in_order, number_of_items) values (9, 12, 12);
insert into order_items (order_of_item, item_in_order, number_of_items) values (28, 8, 21);
insert into order_items (order_of_item, item_in_order, number_of_items) values (3, 24, 25);
insert into order_items (order_of_item, item_in_order, number_of_items) values (26, 27, 17);
insert into order_items (order_of_item, item_in_order, number_of_items) values (26, 4, 10);
insert into order_items (order_of_item, item_in_order, number_of_items) values (16, 4, 29);
insert into order_items (order_of_item, item_in_order, number_of_items) values (12, 3, 29);
insert into order_items (order_of_item, item_in_order, number_of_items) values (18, 2, 26);
insert into order_items (order_of_item, item_in_order, number_of_items) values (1, 7, 20);
insert into order_items (order_of_item, item_in_order, number_of_items) values (16, 13, 12);
insert into order_items (order_of_item, item_in_order, number_of_items) values (16, 18, 23);
insert into order_items (order_of_item, item_in_order, number_of_items) values (22, 25, 4);
insert into order_items (order_of_item, item_in_order, number_of_items) values (2, 25, 7);
insert into order_items (order_of_item, item_in_order, number_of_items) values (7, 19, 16);
insert into order_items (order_of_item, item_in_order, number_of_items) values (19, 17, 1);
insert into order_items (order_of_item, item_in_order, number_of_items) values (10, 23, 16);
insert into order_items (order_of_item, item_in_order, number_of_items) values (18, 20, 29);
insert into order_items (order_of_item, item_in_order, number_of_items) values (1, 6, 1);
insert into order_items (order_of_item, item_in_order, number_of_items) values (12, 6, 12);
insert into order_items (order_of_item, item_in_order, number_of_items) values (15, 10, 8);
insert into order_items (order_of_item, item_in_order, number_of_items) values (19, 20, 22);
insert into order_items (order_of_item, item_in_order, number_of_items) values (5, 18, 14);
insert into order_items (order_of_item, item_in_order, number_of_items) values (25, 2, 16);
insert into order_items (order_of_item, item_in_order, number_of_items) values (3, 6, 25);
insert into order_items (order_of_item, item_in_order, number_of_items) values (29, 25, 14);
insert into order_items (order_of_item, item_in_order, number_of_items) values (28, 17, 15);
insert into order_items (order_of_item, item_in_order, number_of_items) values (15, 3, 15);
insert into order_items (order_of_item, item_in_order, number_of_items) values (21, 14, 17);
insert into order_items (order_of_item, item_in_order, number_of_items) values (29, 11, 12);


insert into user_item(user_id, item_id_cart, cart_quantity) values ('aboarer2@shinystat.com', 11, 3);
insert into user_item(user_id, item_id_cart, cart_quantity) values ('aboarer2@shinystat.com', 13, 3);
insert into user_item(user_id, item_id_cart, cart_quantity) values ('aboarer2@shinystat.com', 1, 3);
insert into user_item(user_id, item_id_cart, cart_quantity) values ('aboarer2@shinystat.com', 15, 3);
insert into user_item(user_id, item_id_cart, cart_quantity) values ('aboarer2@shinystat.com', 20, 3);
insert into user_item(user_id, item_id_cart, cart_quantity) values ('aboarer2@shinystat.com', 4, 3);